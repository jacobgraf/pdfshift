<?php
/**
 * PDFShift plugin for Craft CMS
 *
 * Easily implement PDFShift (https://pdfshift.io/) into Craft CMS.
 *
 * @link      https://graftechnology.com/
 * @copyright Copyright (c) Graf Technology, LLC
 */

namespace graftechnology\pdfshift\models;

use craft\base\Model;
use craft\behaviors\EnvAttributeParserBehavior;

/**
 * @author    Graf Technology, LLC
 * @package   PdfShift
 * @since     1.0.0
 */
class Settings extends Model
{
    /**
     * @var string The PDFShift API key, or an environment variable reference (e.g. `$PDFSHIFT_API_KEY`)
     */
    public string $apiKey = '';

    public function behaviors(): array
    {
        return [
            'parser' => [
                'class' => EnvAttributeParserBehavior::class,
                'attributes' => ['apiKey'],
            ],
        ];
    }

    protected function defineRules(): array
    {
        return [
            [['apiKey'], 'string'],
        ];
    }
}
