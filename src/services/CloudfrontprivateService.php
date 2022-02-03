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

   public function getSignedUrl($resourceUrl = null)
   {

      $cloudfront = new CloudFrontClient([
         'credentials' => [
            'key' => '[redacted]',
            'secret' => '[redacted]',
         ],
         'region' => 'eu-west-1',
         'version' => 'latest',
      ]);

      // $resourceUrl = 'https://[redacted].cloudfront.net/[redacted]';

      $expires = time() + 600;

      // $signedUrl = $cloudfront->getSignedUrl([
      //    'url' => $resourceUrl,
      //    'expires' => $expires,
      //    'key_pair_id' => '[redacted]',
      //    'private_key' => realpath(__DIR__ . '/../storage/pk-[redacted].pem'),
      // ]);

      return $resourceUrl . "gros pet";

   }



}
