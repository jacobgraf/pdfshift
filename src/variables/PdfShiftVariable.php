<?php
/**
 * PDFShift plugin for Craft CMS
 *
 * Easily implement PDFShift (https://pdfshift.io/) into Craft CMS.
 *
 * @link      https://graftechnology.com/
 * @copyright Copyright (c) Graf Technology, LLC
 */

namespace graftechnology\pdfshift\variables;

use graftechnology\pdfshift\PdfShift;

/**
 * @author    Graf Technology, LLC
 * @package   PdfShift
 * @since     1.1.0
 */
class PdfShiftVariable
{
    /**
     * Converts the source and streams the PDF to the browser as a download.
     */
    public function download(array $options = []): void
    {
        PdfShift::getInstance()->api->download($options);
    }

    /**
     * Converts the source and returns a temporary URL to the hosted PDF.
     */
    public function link(array $options = []): string
    {
        return PdfShift::getInstance()->api->getLink($options);
    }
}
