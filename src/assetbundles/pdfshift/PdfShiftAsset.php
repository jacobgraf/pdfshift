<?php
/**
 * PdfShift plugin for Craft CMS 3.x
 *
 * Easily implement PDFShift (https://pdfshift.io/) into Craft CMS.
 *
 * @link      https://graftechnology.com/
 * @copyright Copyright (c) 2019 Graf Technology, LLC
 */

namespace graftechnology\pdfshift\assetbundles\PdfShift;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Graf Technology, LLC
 * @package   PdfShift
 * @since     1.0.1
 */
class PdfShiftAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@graftechnology/pdfshift/assetbundles/pdfshift/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/PdfShift.js',
        ];

        $this->css = [
            'css/PdfShift.css',
        ];

        parent::init();
    }
}
