<?php
/**
 * PDFShift plugin for Craft CMS 3.x
 *
 * Easily implement PDFShift (https://pdfshift.io/) into Craft CMS.
 *
 * @link      https://graftechnology.com/
 * @copyright Copyright (c) 2019 Graf Technology, LLC
 */

namespace graftechnology\pdfshift;

use graftechnology\pdfshift\variables\PDFShiftVariable;
use graftechnology\pdfshift\models\Settings;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\web\twig\variables\CraftVariable;

use yii\base\Event;

/**
 * Class PDFShift
 *
 * @author    Graf Technology, LLC
 * @package   PDFShift
 * @since     1.0.0
 *
 */
class PDFShift extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var PDFShift
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    public $hasCpSettings = true;

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('pDFShift', PDFShiftVariable::class);
            }
        );

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );

        Craft::info(
            Craft::t(
                'pdfshift',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

    /**
     * @inheritdoc
     */
    protected function settingsHtml()
    {
        return Craft::$app->view->renderTemplate(
            'pdfshift/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }
}
