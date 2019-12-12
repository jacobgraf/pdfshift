<?php
namespace graftechnology\pdfshift\services;

use yii\base\Component;
use yii\base\Exception;

class PdfShiftApiService extends Component
{
    /**
     * @param  array  $options
     * @throws Exception
     */
    public function download($options = [])
    {
        // Set the Output Filename
        if(isset($options['filename']))
        {
            $outputFilename = $options['filename'];
            unset($options['filename']);
        } else {
            $outputFilename = 'document.pdf';
        }

        // PdfShiftApiService the PDF
        $data = $this->generate($options);

        // Download the PDF
        header("Content-Type: application/pdf");
        header("Content-Length: " . strlen($data));
        header("Content-Transfer-Encoding: binary");
        header('Content-Disposition: attachment; filename="' . $outputFilename . '"');
        header("Cache-Control: public, must-revalidate, max-age=0");
        header("Pragma: public");
        echo $data;
    }

    /**
     * @param  array  $options
     * @return mixed
     * @throws Exception
     */
    public function getLink($options = [])
    {
        // Set the Output Filename
        isset($options['filename']) ? $options['filename'] : $options['filename'] = 'document.pdf';

        // PdfShiftApiService the PDF and Return the Link
        return json_decode($this->generate($options))->url;
    }

    /**
     * @param  array  $options
     * @return bool|string
     * @throws Exception
     */
    private function generate($options = [])
    {
        // Curl Request
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.pdfshift.io/v2/convert/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($options),
            CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
            CURLOPT_USERPWD => \graftechnology\pdfshift\PdfShift::getInstance()->getSettings()->apiKey,
        ));
        $response = curl_exec($curl);
        $error = curl_error($curl);
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        // Error Handling
        if (!empty($error)) {
            throw new Exception($error);
        } elseif ($statusCode >= 400) {
            $body = json_decode($response, true);
            if (isset($body['error'])) {
                throw new Exception($body['error']);
            } else {
                throw new Exception($response);
            }
        }

        // Return Response
        return $response;
    }
}