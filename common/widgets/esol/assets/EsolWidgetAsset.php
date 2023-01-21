<?php

namespace common\widgets\esol\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class EsolWidgetAsset extends AssetBundle
{

    public $sourcePath = '@common/widgets/esol/assets';

    public $js = [
        //'js/picker-input.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'common\assets\AppAsset'
    ];
    public $publishOptions=[
        'forceCopy'=>true
    ];

}
