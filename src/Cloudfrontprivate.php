<?php

namespace overdog\cloudfrontprivate;

use overdog\cloudfrontprivate\variables\CloudfrontPrivateVariable;
use overdog\cloudfrontprivate\twigextensions\CloudfrontPrivateTwigExtension;

use overdog\cloudfrontprivate\models\Settings;
use overdog\cloudfrontprivate\services\CloudfrontPrivateServices as Service;

use Craft;
use craft\base\Plugin;
use craft\web\twig\variables\CraftVariable;

use yii\base\Event;


class CloudfrontPrivate extends Plugin
{
   // Static Properties
   // =========================================================================


   public static $plugin;

   // Public Properties
   // =========================================================================

   public $schemaVersion = '1.0.0';
   public $hasCpSettings = false;
   public $hasCpSection = false;

   // Public Methods
   // =========================================================================

   public function init()
   {
      parent::init();
      self::$plugin = $this;

      $this->setComponents([
         'cloudfrontPrivateServices' => Service::class,
      ]);
      

      Craft::$app->view->registerTwigExtension(new CloudfrontPrivateTwigExtension());

      Event::on(
         CraftVariable::class,
         CraftVariable::EVENT_INIT,
         function (Event $event) {
            /** @var CraftVariable $variable */
            $variable = $event->sender;
            $variable->set('cloudfrontprivate', CloudfrontPrivateVariable::class);
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

   protected function createSettingsModel()
   {
       return new Settings();
   }

}
