<?php

namespace common\components;

use yii\validators\Validator;
use libphonenumber\PhoneNumberUtil;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\NumberParseException;
use Exception;

class SmsProvider extends Validator
{

    public static function sendSms($number,$message){

        return true;
    }

    public static function generateCode(){


        return 11111;
    }

}
