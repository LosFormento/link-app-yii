<?php
/* @var $this yii\web\View */
/* @var \yii\data\ActiveDataProvider $dataProvider*/
/* @var $model \common\models\Entity*/
use \yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;
?>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_news',
                'itemOptions' => [
                        'class'=>'col-md-4'
                ],
                'layout' => '{summary}<div class="row">{items}</div>{pager}',
            ]);
            ?>
        </div>
    </div>
</div>