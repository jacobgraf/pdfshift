<?php
/**
 * PdfShift plugin for Craft CMS 3.x
 *
 * Easily implement PDFShift (https://pdfshift.io/) into Craft CMS.
 *
 * @link      https://graftechnology.com/
 * @copyright Copyright (c) 2019 Graf Technology, LLC
 */

namespace graftechnology\pdfshift\models;

use graftechnology\pdfshift\PdfShift;

use Craft;
use craft\base\Model;

/**
 * @author    Graf Technology, LLC
 * @package   PdfShift
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $apiKey = '';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['apiKey', 'string'],
            ['apiKey', 'default', 'value' => ''],
        ];
    }
}
