<?php

namespace overdog\cloudfrontprivate\variables;

use overdog\cloudfrontprivate\CloudfrontPrivate;
use Craft;

class CloudfrontPrivateVariable
{
    
   public function getSignedUrl($fileName = null)
   {

      $signedUrl = CloudfrontPrivate::getInstance()->cloudfrontPrivateServices->signAPrivateDistribution($fileName);

     // return the getProductTableFieldArray function from service in the priceList variable
     return $signedUrl;
   }
}