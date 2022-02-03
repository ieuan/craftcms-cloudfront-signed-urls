<?php

/**
 * cloudfront-private plugin for Craft CMS 3.x
 *
 * A small plugin to sign cloudfront urls
 *
 * @link      https://www.3ejoueur.com
 * @copyright Copyright (c) 2022 3ejoueur
 */

namespace overdog\cloudfrontprivate;

use overdog\cloudfrontprivate\services\CloudfrontprivateService as CloudfrontprivateServiceService;
use overdog\cloudfrontprivate\variables\CloudfrontprivateVariable;
use overdog\cloudfrontprivate\twigextensions\CloudfrontprivateTwigExtension;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\web\twig\variables\CraftVariable;

use yii\base\Event;

/**
 * Class Cloudfrontprivate
 *
 * @author    3ejoueur
 * @package   Cloudfrontprivate
 * @since     1.0.0
 *
 * @property  CloudfrontprivateServiceService $cloudfrontprivateService
 */
class Cloudfrontprivate extends Plugin
{
   // Static Properties
   // =========================================================================

   /**
    * @var Cloudfrontprivate
    */
   public static $plugin;

   // Public Properties
   // =========================================================================

   /**
    * @var string
    */
   public $schemaVersion = '1.0.0';

   /**
    * @var bool
    */
   public $hasCpSettings = false;

   /**
    * @var bool
    */
   public $hasCpSection = false;

   // Public Methods
   // =========================================================================

   /**
    * @inheritdoc
    */
   public function init()
   {
      parent::init();
      self::$plugin = $this;


      // set the services
      $this->setComponents([
         'serviceComponent' => \overdog\cloudfrontprivate\services\CloudfrontprivateService::class,
     ]);

      Craft::$app->view->registerTwigExtension(new CloudfrontprivateTwigExtension());

      Event::on(
         CraftVariable::class,
         CraftVariable::EVENT_INIT,
         function (Event $event) {
            /** @var CraftVariable $variable */
            $variable = $event->sender;
            $variable->set('cloudfrontprivate', CloudfrontprivateVariable::class);
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
            'cloudfront-private',
            '{name} plugin loaded',
            ['name' => $this->name]
         ),
         __METHOD__
      );
   }

   // Protected Methods
   // =========================================================================

}
