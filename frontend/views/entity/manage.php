<?php
/* @var $this yii\web\View */
/* @var ActiveDataProvider $dataProvider */
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use kartik\icons\FontAwesomeAsset;
use yii\helpers\Url;

FontAwesomeAsset::register($this);
?>
<div class="d-flex justify-content-between">
    <h1>Редактировать свое</h1>
    <a class="btn btn-success align-self-center" href="<?=Url::toRoute('entity/create')?>" role="button">Добавить</a>
</div>


<?php

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'bsVersion' => 4,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'title',
        [
            'label' => 'Категория',
            'attribute' => 'category.name',
        ],
        [
            'class' => 'kartik\grid\ActionColumn',
        ],
        ]
]);
?>
