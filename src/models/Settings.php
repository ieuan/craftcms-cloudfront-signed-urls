<?php

namespace overdog\cloudfrontprivate\models;

use craft\base\Model;

class Settings extends Model
{

   // default values for each setting
   public $keyPairId = '';
   public $cloudfrontDistributionUrl = '';
   public $profile = 'default';
   public $version = '2020-05-31';
   public $region = 'ca-central-1';
   public $defaultExpires = 3600; // 60 minutes

   public function rules()
   {
      return [
         ['keyPairId', 'required'],
         ['cloudfrontDistributionUrl', 'required'],
         ['profile', 'required'],
         ['version', 'required'],
         ['region', 'required'],
         ['defaultExpires', 'required']
      ];
   }
}
