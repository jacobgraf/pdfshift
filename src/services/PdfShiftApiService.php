<?php
/**
 * PDFShift plugin for Craft CMS
 *
 * Easily implement PDFShift (https://pdfshift.io/) into Craft CMS.
 *
 * @link      https://graftechnology.com/
 * @copyright Copyright (c) Graf Technology, LLC
 */

namespace graftechnology\pdfshift\services;

use Craft;
use craft\helpers\App;
use craft\helpers\Json;
use graftechnology\pdfshift\PdfShift;
use GuzzleHttp\Exception\RequestException;
use yii\base\Component;
use yii\base\Exception;

/**
 * @author    Graf Technology, LLC
 * @package   PdfShift
 * @since     1.1.0
 */
class PdfShiftApiService extends Component
{
    private const API_ENDPOINT = 'https://api.pdfshift.io/v3/convert/pdf';

    /**
     * Converts the source and streams the PDF to the browser as a download.
     *
     * @throws Exception
     */
    public function download(array $options = []): void
    {
        $filename = $options['filename'] ?? 'document.pdf';

        // Passing `filename` to the API returns a JSON URL instead of the
        // binary PDF, so it must never reach the conversion payload here
        unset($options['filename']);

        $pdf = $this->convert($options);

        Craft::$app->getResponse()->sendContentAsFile($pdf, $filename, [
            'mimeType' => 'application/pdf',
        ]);
        Craft::$app->end();
    }

    /**
     * Converts the source and returns a temporary URL to the hosted PDF.
     *
     * @throws Exception
     */
    public function getLink(array $options = []): string
    {
        $options['filename'] ??= 'document.pdf';

        return Json::decode($this->convert($options))['url'];
    }

    /**
     * @throws Exception
     */
    private function convert(array $options): string
    {
        $apiKey = App::parseEnv(PdfShift::getInstance()->getSettings()->apiKey);

        try {
            $response = Craft::createGuzzleClient(['timeout' => 120])->post(self::API_ENDPOINT, [
                'headers' => ['X-API-Key' => $apiKey],
                'json' => $options,
            ]);
        } catch (RequestException $e) {
            throw new Exception($this->extractErrorMessage($e), 0, $e);
        }

        return (string)$response->getBody();
    }

    private function extractErrorMessage(RequestException $e): string
    {
        if ($e->hasResponse()) {
            $body = Json::decodeIfJson((string)$e->getResponse()->getBody());

            if (is_array($body)) {
                if (!empty($body['error'])) {
                    return is_string($body['error']) ? $body['error'] : Json::encode($body['error']);
                }

                if (!empty($body['errors'])) {
                    return Json::encode($body['errors']);
                }
            }
        }

        return $e->getMessage();
    }
}
