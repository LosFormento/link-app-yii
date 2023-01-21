<?php
namespace common\widgets\esol;



use common\widgets\esol\assets\EsolWidgetAsset;

class BalanceWidget extends \yii\base\Widget
{
    public $params;


    public function init()
    {
        parent::init();
    }


    public function run()
    {
        EsolWidgetAsset::register($this->getView());
        return $this->render('_ballance',[
            'params'=>$this->params,
        ]);
    }

    public function getViewPath()
    {
        return '@common/widgets/esol/views';
    }

}