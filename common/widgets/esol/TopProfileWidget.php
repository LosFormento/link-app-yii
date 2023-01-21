<?php
namespace common\widgets\esol;



use common\widgets\esol\assets\EsolWidgetAsset;

class TopProfileWidget extends \yii\base\Widget
{
    public $params;


    public function init()
    {
        parent::init();
    }


    public function run()
    {
        EsolWidgetAsset::register($this->getView());
        return $this->render('_top_profile',[
            'params'=>$this->params,
        ]);
    }

    public function getViewPath()
    {
        return '@common/widgets/esol/views';
    }

}