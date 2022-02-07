<?php

namespace troisiemejoueur\cloudfrontsignedurls\twigextensions;

use troisiemejoueur\cloudfrontsignedurls\CloudfrontSignedUrls;

use Craft;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;


class CloudfrontSignedUrlsTwigExtension extends AbstractExtension
{

   public function getName()
   {
      return 'Cloudfront Signed Urls';
   }

   public function getFunctions()
   {
      return [
         new TwigFunction('signurl', [$this, 'getSignedUrl']),
      ];
   }

   public function getSignedUrl($fileName = null, $fileExpiry = null)
   {
      $signedUrl = CloudfrontSignedUrls::getInstance()->cloudfrontSignedUrlsServices->signPrivateDistribution($fileName, $fileExpiry);
      return $signedUrl;
   }
}
