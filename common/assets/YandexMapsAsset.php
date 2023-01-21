<?php

namespace common\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class YandexMapsAsset extends AssetBundle
{

    //public $sourcePath = '@common/assets';
    public $baseUrl = 'https://api-maps.yandex.ru/2.1/';

    public $js = [

    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
    public $publishOptions=[
        'forceCopy'=>true
    ];

    public function init()
    {
        parent::init();
        $this->js[] ='?lang=ru_RU&amp;apikey='.Yii::$app->params['yandex_maps_key'];
    }
}
