<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaskimagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Entity Images';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-image-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Entity Image', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'path',
            'alt',
            'task_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
