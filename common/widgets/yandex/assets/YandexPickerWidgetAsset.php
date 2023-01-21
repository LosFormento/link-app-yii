<?php

namespace common\widgets\yandex\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class YandexPickerWidgetAsset extends AssetBundle
{

    public $sourcePath = '@common/widgets/yandex/assets';

    public $js = [
        'js/picker-input.js'
    ];
    public $depends = [
        'common\assets\YandexMapsAsset',
    ];
    public $publishOptions=[
        //'forceCopy'=>true
    ];

}
