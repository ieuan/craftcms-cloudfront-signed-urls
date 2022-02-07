<?php

namespace overdog\cloudfrontprivate\services;

use overdog\cloudfrontprivate\CloudfrontPrivate;
use Craft;
use craft\base\Component;
use Aws\CloudFront\CloudFrontClient;
use Aws\Exception\AwsException;

class CloudfrontPrivateServices extends Component
{

   public function signAPrivateDistribution($fileName, $fileExpiry)
   {
      // settings and variables
      $settings = CloudfrontPrivate::getInstance()->settings;

      $cloudfrontUrl = $settings['cloudfrontDistributionUrl'];
      $resourceKey = (!empty($cloudfrontUrl) ? rtrim($cloudfrontUrl, '/') . '/' : '') . $fileName;
      $keyPairId = $settings['keyPairId'];
      $privateKey = dirname(__DIR__) . '/private_key.pem';
      $expires = time() + ($fileExpiry !== null && is_int($fileExpiry) ? $fileExpiry : $settings['defaultExpires']);

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
