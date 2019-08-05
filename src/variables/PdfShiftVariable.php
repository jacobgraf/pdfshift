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

use graftechnology\pdfshift\PdfShift;

use Craft;

/**
 * @author    Graf Technology, LLC
 * @package   PdfShift
 * @since     1.0.1
 */
class PdfShiftVariable
{
    // Public Methods
    // =========================================================================

    /**
     * Download generated PDF document
     *
     * @param array $options PdfShift options
     *
     * @return \yii\web\Response
     */
    public function download($options = [])
    {
        $response = json_decode($this->_generate($options));
        header("Location: " . $response->url);
    }

    /**
     * Return a link to the generated PDF document
     *
     * @param array $options PdfShift options
     *
     * @return string
     */
    public function link($options = [])
    {
        return json_decode($this->_generate($options))->url;
    }

    // Private Methods
    // =========================================================================

    /**
     * Generate the PDF using PDFShift
     * 
     * @param null $options PdfShift options
     * 
     * @return string
     */
    private function _generate($options)
    {
        isset($options['filename']) ? $options['filename'] : $options['filename'] = 'document.pdf';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.pdfshift.io/v2/convert/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($options),
            CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
            CURLOPT_USERPWD => \graftechnology\pdfshift\PdfShift::getInstance()->getSettings()->apiKey,
        ));

        return curl_exec($curl);
    }

}
