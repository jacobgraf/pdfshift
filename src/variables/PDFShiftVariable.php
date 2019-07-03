<?php
/**
 * PDFShift plugin for Craft CMS 3.x
 *
 * Easily implement PDFShift (https://pdfshift.io/) into Craft CMS.
 *
 * @link      https://graftechnology.com/
 * @copyright Copyright (c) 2019 Graf Technology, LLC
 */

namespace graftechnology\pdfshift\variables;

use graftechnology\pdfshift\PDFShift;

use Craft;

/**
 * @author    Graf Technology, LLC
 * @package   PDFShift
 * @since     1.0.0
 */
class PDFShiftVariable
{
    // Public Methods
    // =========================================================================

    /**
     * @param null $options
     * @return string
     */
    public function __construct($options = [])
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.pdfshift.io/v2/convert/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($options),
            CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
            CURLOPT_USERPWD => $this->settings()->apiKey,
        ));

        $response = curl_exec($curl);
        return file_put_contents('document.pdf', $response);

    }

}
