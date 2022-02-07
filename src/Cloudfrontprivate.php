<?php

namespace overdog\cloudfrontprivate;

use overdog\cloudfrontprivate\models\Settings;
use overdog\cloudfrontprivate\services\CloudfrontPrivateServices as Service;
use overdog\cloudfrontprivate\twigextensions\CloudfrontPrivateTwigExtension;

use Craft;
use craft\base\Plugin;

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

      // Service
      $this->setComponents([
         'cloudfrontPrivateServices' => Service::class,
      ]);
      // Twig Extension
      Craft::$app->view->registerTwigExtension(new CloudfrontPrivateTwigExtension());
   }

   // Protected Methods
   // =========================================================================

   // Settings
   protected function createSettingsModel()
   {
      return new Settings();
   }
}
