<?php

namespace common\widgets\swiper\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class SwiperWidgetAsset extends AssetBundle
{

    public $sourcePath = '@common/widgets/swiper/assets';

    public $js = [
        'js/swiper-bundle.min.js',
        'js/slider.js'
    ];
    public $css = [
        'css/swiper-bundle.min.css'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
    public $publishOptions=[
        //'forceCopy'=>true
    ];
}
