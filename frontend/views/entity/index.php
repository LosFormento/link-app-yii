<?php
/* @var $this yii\web\View */
/* @var \yii\data\ActiveDataProvider $dataProvider*/
/* @var $model \common\models\Entity*/
use \yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;
?>
<div class="row">
    <div class="col-12 d-flex justify-content-between">
        <h1>Что-то</h1>
        <div class="align-self-center">
            <a class="btn btn-success" href="<?=Url::toRoute('create')?>" role="button"><i class="fa-regular fa-add"></i>Добавить</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        Категории
    </div>
    <div class="col-md-9">
        <div class="row">
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_entity',
                'itemOptions' => [
                        'class'=>'col-md-4'
                ],
                'layout' => '{summary}<div class="row">{items}</div>{pager}',
            ]);
            ?>
        </div>
    </div>
</div>