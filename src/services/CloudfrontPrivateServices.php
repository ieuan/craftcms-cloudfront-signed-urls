<?php

namespace overdog\cloudfrontprivate\services;

use overdog\cloudfrontprivate\CloudfrontPrivate;
use craft\base\Component;
use Aws\CloudFront\CloudFrontClient;
use Aws\Exception\AwsException;
use craft;


class CloudfrontPrivateServices extends Component
{

   public function getPrivateKeyFolder()
   {
      $privateKeyFolder = '/cloudfront-private';
      $storagePath = Craft::$app->path->getStoragePath();
      $pluginStoragePath = $storagePath . $privateKeyFolder;
      return $pluginStoragePath;
   }


   public function signPrivateDistribution(string $fileName, ?int $fileExpiry)
   {

      // settings and variables
      $settings = CloudfrontPrivate::getInstance()->settings;
      $cloudfrontUrl = $settings['cloudfrontDistributionUrl'];
      $keyPairId = $settings['keyPairId'];
      $resourceKey = (!empty($cloudfrontUrl) ? rtrim($cloudfrontUrl, '/') . '/' : '') . $fileName;
      // if fileExpiry is not passed when calling the twig function, use the defaultExpires setting 
      $expires = time() + ($fileExpiry !== null ? $fileExpiry : $settings['defaultExpires']);
      // getPrivateKey
      $privateKeyPath = $this->getPrivateKeyFolder();
      $privateKey = $privateKeyPath . '/' . $settings['privateKeyFileName'];

      // create aws cloudfront client
      $cloudFrontClient = new CloudFrontClient([
         'profile' => $settings['profile'],
         'version' => $settings['version'],
         'region' => $settings['region']
      ]);

      // sign the url
      try {
         $result = $cloudFrontClient->getSignedUrl([
            'url' => $resourceKey,
            'expires' => $expires,
            'private_key' => $privateKey,
            'key_pair_id' => $keyPairId
         ]);
         return $result;
      } catch (AwsException $e) {
         return 'Error: ' . $e->getAwsErrorMessage();
      }
   }
}
