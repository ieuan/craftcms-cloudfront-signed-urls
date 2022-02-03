<?php

/**
 * cloudfront-private plugin for Craft CMS 3.x
 *
 * A small plugin to sign cloudfront urls
 *
 * @link      https://www.3ejoueur.com
 * @copyright Copyright (c) 2022 3ejoueur
 */

namespace overdog\cloudfrontprivate\variables;

use overdog\cloudfrontprivate\Cloudfrontprivate;

use Craft;

/**
 * @author    3ejoueur
 * @package   Cloudfrontprivate
 * @since     1.0.0
 */
class CloudfrontprivateVariable
{
   // Public Methods
   // =========================================================================

   /**
    * @param null $optional
    * @return string
    */
   public function exampleVariable($optional = null)
   {
      $result = "And away we go to the Twig template...";
      if ($optional) {
         $result = "I'm feeling optional today...";
      }
      return $result;
   }

   public function getSignedUrl($url = null)
   {
      //return $url;

      $urlTest = CloudfrontPrivate::getInstance()->serviceComponent->getSignedUrl($url);

     // return the getProductTableFieldArray function from service in the priceList variable
     return $urlTest;
   }
}