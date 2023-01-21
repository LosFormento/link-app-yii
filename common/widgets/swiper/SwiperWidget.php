<?php
namespace common\widgets\swiper;




use common\widgets\swiper\assets\SwiperWidgetAsset;

class SwiperWidget extends \yii\base\Widget
{
    public $params;
    public $imagesItems;


    public function init()
    {
        parent::init();
    }


    public function run()
    {
        SwiperWidgetAsset::register($this->getView());
        return $this->render('_swiper',[
            'params'=>$this->params,
            'imagesItems'=>$this->imagesItems
        ]);
    }

    public function getViewPath()
    {
        return '@common/widgets/swiper/views';
    }

}