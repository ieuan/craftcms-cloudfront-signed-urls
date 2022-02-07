<?php

namespace overdog\cloudfrontprivate\twigextensions;

use overdog\cloudfrontprivate\CloudfrontPrivate;

use Craft;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;


class CloudfrontPrivateTwigExtension extends AbstractExtension
{

   public function getName()
   {
      return 'Cloudfront Private';
   }

   public function getFunctions()
   {
      return [
         new TwigFunction('signurl', [$this, 'getSignedUrl']),
      ];
   }

   public function getSignedUrl($fileName = null, $fileExpiry = null)
   {
      $signedUrl = CloudfrontPrivate::getInstance()->cloudfrontPrivateServices->signAPrivateDistribution($fileName, $fileExpiry);
      return $signedUrl;
   }
}
