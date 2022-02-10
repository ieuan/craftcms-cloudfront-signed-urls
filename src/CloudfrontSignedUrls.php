<?php

namespace troisiemejoueur\cloudfrontsignedurls;

use troisiemejoueur\cloudfrontsignedurls\models\Settings;
use troisiemejoueur\cloudfrontsignedurls\services\CloudfrontSignedUrlsServices as Service;
use troisiemejoueur\cloudfrontsignedurls\twigextensions\CloudfrontSignedUrlsTwigExtension;

use Craft;
use craft\base\Plugin;
use craft\helpers\FileHelper;

class CloudfrontSignedUrls extends Plugin
{

   // Public Methods
   // --------------------------------------------------------------------------

   public function init()
   {
      parent::init();

      // Services
      $this->setComponents([
         'cloudfrontSignedUrlsServices' => Service::class,
      ]);
      // Twig Extension
      Craft::$app->view->registerTwigExtension(new CloudfrontSignedUrlsTwigExtension());
   }

   // Protected Methods
   // --------------------------------------------------------------------------

   // Settings
   protected function createSettingsModel()
   {
      return new Settings();
   }

   // create folder in storage on install and remove it on uninstall
   protected function afterInstall()
   {

      FileHelper::createDirectory($this->cloudfrontSignedUrlsServices->getPrivateKeyFolder());
   }

   protected function afterUninstall()
   {
      FileHelper::removeDirectory($this->cloudfrontSignedUrlsServices->getPrivateKeyFolder());
   }
}
