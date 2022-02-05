<?php

/**
 * cloudfront-private plugin for Craft CMS 3.x
 *
 * A small plugin to sign cloudfront urls
 *
 * @link      https://www.3ejoueur.com
 * @copyright Copyright (c) 2022 3ejoueur
 */

namespace overdog\cloudfrontprivate\services;

use overdog\cloudfrontprivate\Cloudfrontprivate;
use Craft;
use craft\base\Component;
use Aws\CloudFront\CloudFrontClient;
use Aws\Exception\AwsException;

/**
 * @author    3ejoueur
 * @package   Cloudfrontprivate
 * @since     1.0.0
 */
class CloudfrontprivateService extends Component
{

   // Public Methods
   // =========================================================================

   public function signAPrivateDistribution()
   {
      // ian - mettre url en settings de config (url de base)
      $resourceKey = 'https://d2max5b299nmyq.cloudfront.net/overdog/idee-simplifiee.pdf';
      // ian - dans settings de fonction (en secondes)
      $expires = time() + 300; // 5 minutes (5 * 60 seconds) from now.
      // ian - en settings de config
      $privateKey = dirname(__DIR__) . '/private_key.pem';
      // ian - en settings de config
      $keyPairId = '';
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
