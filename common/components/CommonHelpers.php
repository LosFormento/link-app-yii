<?php

namespace common\components;


use yii\helpers\HtmlPurifier;

class CommonHelpers
{
    const MYSQL_DATE_FORMAT = 'Y-m-d H:i:s';
    const PREVIEW_MAX_LENGTH = 120;

    public static function generatePriview($html)
    {
        $string = HtmlPurifier::process($html, [
            'HTML.Allowed'=> ''
        ]);
        if(strlen($string) < self::PREVIEW_MAX_LENGTH){
            $result = $string;
        }else{
            $bsPos=strpos($string,' ',self::PREVIEW_MAX_LENGTH);
            if($bsPos === false){
                $result = $string;
            }else{
                $result = substr($string,0,$bsPos).' ...';
            }
        }
        return $result;
    }
}
