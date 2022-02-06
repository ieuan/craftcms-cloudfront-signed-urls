<?php

namespace overdog\cloudfrontprivate\models;

use craft\base\Model;

class Settings extends Model
{
    public $keyPairId = '';
    public $cloudfrontDistributionUrl = '';

    public function rules()
    {
        return [
            ['keyPairId', 'required'],
            ['cloudfrontDistributionUrl', 'required']
        ];
    }
}
