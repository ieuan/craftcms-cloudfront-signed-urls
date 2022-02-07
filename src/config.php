<?php

/**
 * Cloudfront Private plugin for Craft CMS 3.x
 * Creates Signed Urls with a Twig Function
 * @link https://3ejoueur.com
 * @copyright Copyright (c) 2022 Ian Reid Langevin @3ejoueur
 * 
 * @note Each config can be stored in your ENV file. Access them with App::env('YOUR_VARIABLE_NAME').
 * 
 */

use craft\helpers\App;

return [
   
   // Cloudfront Distribution Settings
   // --------------------------------------------------

   // The keyParId created with your CloudFront distribution
   'keyPairId' => '',

   // include in the URL any subfolder if needed or add it when calling the Twig function in your template.
   // Do not fortget http or https, based on your Cloudfront distribution settings.
   'cloudfrontDistributionUrl' => '',


   // Cloudfront Client Options
   // --------------------------------------------------

   // default is 'default' - remove this line if default value is ok
   'profile' => '',
   // default is '2020-05-31' - remove this line if default value is ok
   'version' => '',
   // default is 'ca-central-1' - remove this line if default value is ok
   'region' => '',


   // Twig Function Default Settings
   // --------------------------------------------------

   // File Expiry - Integer in seconds - if not set with the twig function, fallback to this value. Default is 3600 (60 minutes)
   // The expiry time is calculated like this : now + defaultExpires
   'defaultExpires' => 300

];
