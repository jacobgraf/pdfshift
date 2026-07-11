<?php
/**
 * PDFShift plugin for Craft CMS
 *
 * Easily implement PDFShift (https://pdfshift.io/) into Craft CMS.
 *
 * @link      https://graftechnology.com/
 * @copyright Copyright (c) Graf Technology, LLC
 */

namespace graftechnology\pdfshift;

use Craft;
use craft\base\Model;
use craft\base\Plugin;
use craft\web\twig\variables\CraftVariable;
use graftechnology\pdfshift\models\Settings;
use graftechnology\pdfshift\services\PdfShiftApiService;
use graftechnology\pdfshift\variables\PdfShiftVariable;
use yii\base\Event;

/**
 * @author    Graf Technology, LLC
 * @package   PdfShift
 * @since     1.0.1
 *
 * @property-read PdfShiftApiService $api
 * @method Settings getSettings()
 */
class PdfShift extends Plugin
{
    public static ?PdfShift $plugin = null;

    public bool $hasCpSettings = true;
    public string $schemaVersion = '1.0.1';

    public static function config(): array
    {
        return [
            'components' => [
                'api' => PdfShiftApiService::class,
            ],
        ];
    }

    public function init(): void
    {
        parent::init();
        self::$plugin = $this;

        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function(Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('pdfShift', PdfShiftVariable::class);
            }
        );
    }

    protected function createSettingsModel(): ?Model
    {
        return new Settings();
    }

    protected function settingsHtml(): ?string
    {
        return Craft::$app->getView()->renderTemplate('pdfshift/settings', [
            'settings' => $this->getSettings(),
        ]);
    }
}
