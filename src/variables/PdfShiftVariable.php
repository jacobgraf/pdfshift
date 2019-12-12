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
    /**
     * @param  array  $options
     */
    public function download($options = [])
    {
        PdfShift::getInstance()->pdfShiftApiService->download($options);
    }

    /**
     * @param  array  $options
     * @return
     */
    public function link($options = [])
    {
        return PdfShift::getInstance()->pdfShiftApiService->getLink($options);
    }

}