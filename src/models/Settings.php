<?php

namespace overdog\cloudfrontprivate\models;

use craft\base\Model;

class Settings extends Model
{

   public string $keyPairId = '';
   public string $cloudfrontDistributionUrl = '';
   public string $profile = 'default';
   public string $version = '2020-05-31';
   public string $region = 'ca-central-1';
   public string $privateKeyFileName = 'private_key.pem';
   public int $defaultExpires = 3600; // 60 minutes

   public function rules()
   {
      return [
         ['keyPairId', 'required'],
         ['cloudfrontDistributionUrl', 'required'],
         ['profile', 'required'],
         ['version', 'required'],
         ['region', 'required'],
         ['privateKeyFileName', 'required'],
         ['defaultExpires', 'required']
      ];
   }
}
