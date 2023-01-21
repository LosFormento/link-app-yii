<?php

namespace common\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{

    public $sourcePath = '@common/assets';
    public $css = [
        'css/site.css',
        'scss/main.css',
        'css/fontawesome/css/all.min.css'
    ];
    public $js = [
        'js/bootstrap.bundle.min.js'

    ];
    public $depends = [
        'yii\web\YiiAsset',
        //s'frontend\assets\BootstrapAsset',
        //'frontend\assets\BootstrapPluginAsset'
    ];
    public $publishOptions=[
        'forceCopy'=>true
    ];
}
