<?php
namespace common\widgets\esol;



use common\widgets\esol\assets\EsolWidgetAsset;

class LeftMenuWidget extends \yii\base\Widget
{
    public $items;


    public function init()
    {
        parent::init();
    }


    public function run()
    {
        EsolWidgetAsset::register($this->getView());
        return $this->render('_left_menu',[
            'items'=>$this->items,
        ]);
    }

    public function getViewPath()
    {
        return '@common/widgets/esol/views';
    }

}