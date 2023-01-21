<?php
// your_app/votewidget/views/_vote.php
/* @var $model \common\models\Entity */

/* @var $latField float */
/* @var $lngField float */
/* @var $zoomField float */

use yii\helpers\Html;
use yii\web\View;

if(!$model->isNewRecord){
    $jsonModel = [
        'coordsCenter' => [$model->geoLat,$model->geoLng],
        'coords'=>[$model->geoLat,$model->geoLng],
        'title'=>$model->title,
        'zoom'=>$model->geoZoom
    ];
}else{
    $jsonModel =[
        'coordsCenter' => [52.78955500000000,27.51501690000000],
        'zoom'=>$model->geoZoom?:13
    ];
}

$this->registerJs(
    "var mapObjectModel = " . \yii\helpers\Json::htmlEncode($jsonModel) . ";",
    View::POS_HEAD,
    'yiiOptions'
);
/**/
?>
<div class="row">
    <div class="col-12">
        <label>Выберите место</label>
        <div id="yandexMapPicker" style="height: 400px"></div>
    </div>
    <div class="col-12 text-center">
        <input readonly id="geoPosLat" type="text" name="<?= $model->formName() ?>[<?= $latField ?>]"
               value="<?= $model->$latField ?: '' ?>">
        <input readonly id="geoPosLng" type="text" name="<?= $model->formName() ?>[<?= $lngField ?>]"
               value="<?= $model->$latField ?: '' ?>">
        <input readonly id="geoPosZoom" type="text" name="<?= $model->formName() ?>[<?=$zoomField?>]"
               value="<?= $model->$zoomField ?: '' ?>">


    </div>
</div>
