<?php
/**
 * PDFShift plugin for Craft CMS 3.x
 *
 * Easily implement PDFShift (https://pdfshift.io/) into Craft CMS.
 *
 * @link      https://graftechnology.com/
 * @copyright Copyright (c) 2019 Graf Technology, LLC
 */

namespace graftechnology\pdfshift\assetbundles\PDFShift;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Graf Technology, LLC
 * @package   PDFShift
 * @since     1.0.0
 */
class PDFShiftAsset extends AssetBundle
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
            'js/PDFShift.js',
        ];

        $this->css = [
            'css/PDFShift.css',
        ];

        parent::init();
    }
}
