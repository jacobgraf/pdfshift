<?php
/**
 * PdfShift plugin for Craft CMS 3.x
 *
 * Easily implement PDFShift (https://pdfshift.io/) into Craft CMS.
 *
 * @link      https://graftechnology.com/
 * @copyright Copyright (c) 2019 Graf Technology, LLC
 */

namespace graftechnology\pdfshift\variables;

use Exception;
use graftechnology\pdfshift\PdfShift;

use Craft;

/**
 * @author    Graf Technology, LLC
 * @package   PdfShift
 * @since     1.1.0
 */
class PdfShiftVariable
{
    // Public Methods
    // =========================================================================

    /**
     * Download generated PDF document
     *
     * @param  array  $options  PdfShift options
     *
     * @return \yii\web\Response
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

        // Generate the PDF
        $data = $this->_generate($options);

        // Download the PDF
        header("Content-Type: application/pdf");
        header("Content-Length: " . strlen($data));
        header("Content-Transfer-Encoding: binary");
        header('Content-Disposition: attachment; filename="' . $outputFilename . '"');
        header("Cache-Control: public, must-revalidate, max-age=0");
        header("Pragma: public");
        echo $data;

        exit();
    }

    /**
     * Return a link to the generated PDF document
     *
     * @param  array  $options  PdfShift options
     *
     * @return string
     * @throws Exception
     */
    public function link($options = [])
    {
        // Set the Output Filename
        isset($options['filename']) ? $options['filename'] : $options['filename'] = 'document.pdf';

        // Generate the PDF and Return the Link
        return json_decode($this->_generate($options))->url;
    }

    // Private Methods
    // =========================================================================

    /**
     * Generate the PDF using PDFShift
     *
     * @param  null  $options  PdfShift options
     *
     * @return string
     * @throws Exception
     */
    private function _generate($options)
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