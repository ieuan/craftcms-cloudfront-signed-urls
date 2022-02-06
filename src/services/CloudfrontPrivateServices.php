<?php

namespace overdog\cloudfrontprivate\services;

use overdog\cloudfrontprivate\CloudfrontPrivate;
use Craft;
use craft\base\Component;
use Aws\CloudFront\CloudFrontClient;
use Aws\Exception\AwsException;

class CloudfrontPrivateServices extends Component
{

   // Public Methods
   // =========================================================================

   public function signAPrivateDistribution($fileName)
   {
      // ian - mettre url en settings de config (url de base)
      // ian - mettre ensemble tous les settings dans une fonction
      $cloudFrontUrl = CloudfrontPrivate::getInstance()->settings->cloudfrontDistributionUrl;
      $resourceKey = $cloudFrontUrl . $fileName;
      //$resourceKey = 'https://d2max5b299nmyq.cloudfront.net/overdog/idee-simplifiee.pdf';


      // ian - dans settings de fonction (en secondes)
      $expires = time() + 300; // 5 minutes (5 * 60 seconds) from now.
      // ian - en settings de config
      $privateKey = dirname(__DIR__) . '/private_key.pem';

      
      // ian - en settings de config - faire throw error if not
      $keyPairId = CloudfrontPrivate::getInstance()->settings->keyPairId;
      // ian - region en setting de config
      $cloudFrontClient = new CloudFrontClient([
         'profile' => 'default',
         'version' => 'latest',
         'region' => 'ca-central-1'
      ]);
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
