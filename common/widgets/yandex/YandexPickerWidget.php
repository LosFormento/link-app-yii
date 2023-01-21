<?php
namespace common\widgets\yandex;

use common\widgets\yandex\assets\EsolWidgetAsset ;
use common\widgets\yandex\assets\YandexPickerWidgetAsset;

class YandexPickerWidget extends \yii\base\Widget
{
    public $model;
    public $latField;
    public $lngField;
    public $zoomField;

    public function init()
    {
        parent::init();
    }


    public function run()
    {
        // Register AssetBundle
        YandexPickerWidgetAsset::register($this->getView());
        return $this->render('_picker',[
            'model'=>$this->model,
            'latField'=>$this->latField,
            'lngField'=>$this->lngField,
            'zoomField'=>$this->zoomField
        ]);
    }

    public function getViewPath()
    {
        return '@common/widgets/yandex/views';
    }

}