<?php

namespace troisiemejoueur\cloudfrontsignedurls\services;

use troisiemejoueur\cloudfrontsignedurls\CloudfrontSignedUrls;

use craft;
use craft\base\Component;
use Aws\CloudFront\CloudFrontClient;
use Aws\Exception\AwsException;


class CloudfrontSignedUrlsServices extends Component
{

   // Vars
   // --------------------------------------------------------------------------

   private $privateKey;
   

   // Constructor
   // --------------------------------------------------------------------------
   
   public function __construct()
   { 
      $this->privateKey = $this->getPrivateKey(); 
   }


   // Pulic methods
   // --------------------------------------------------------------------------
   
   public function getPrivateKeyStoragePath()
   {
      $storagePath = Craft::$app->path->getStoragePath();
      $pluginStoragePath = $storagePath . '/cloudfront-signed-urls';
      return $pluginStoragePath;
   }

   public function getPrivateKey()
   {
      $settings = CloudfrontSignedUrls::getInstance()->getSettings();
      $privateKeyPath = $this->getPrivateKeyStoragePath();
      $key = $privateKeyPath . '/' . $settings->privateKeyFileName;
      return $key;
   }

   public function signPrivateDistribution(string $fileName, ?int $fileExpiry)
   {
      // settings and variables
      $settings = CloudfrontSignedUrls::getInstance()->getSettings();
      $cloudfrontUrl = $settings->cloudfrontDistributionUrl;
      $keyPairId = $settings->keyPairId;
      $resourceKey = (!empty($cloudfrontUrl) ? rtrim($cloudfrontUrl, '/') . '/' : '') . $fileName;
      // if fileExpiry is not passed when calling the twig function, use the defaultExpires setting 
      $expires = time() + ($fileExpiry !== null ? $fileExpiry : $settings->defaultExpires);

      // create aws cloudfront client
      $cloudFrontClient = new CloudFrontClient([
         'profile' => $settings->profile,
         'version' => $settings->version,
         'region' => $settings->region
      ]);

      // sign the url
      try {
         $result = $cloudFrontClient->getSignedUrl([
            'url' => $resourceKey,
            'expires' => $expires,
            'private_key' => $this->privateKey,
            'key_pair_id' => $keyPairId
         ]);
         return $result;
      } catch (AwsException $e) {
         return 'Error: ' . $e->getAwsErrorMessage();
      }
   }
}
