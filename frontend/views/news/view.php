<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Entity */

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$taskImages = $model->entityImages;

?>
<div class="task-view">

    <?php if (Yii::$app->user->can('updateOwn', [
        'user_id' => $model->user_id
    ])):
        ?>
        <div class="d-flex justify-content-end">
            <?= Html::a('Мои', ['manage'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы действительно хотите удалить это?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    <?php endif; ?>
    <?php

    ?>
    <?php if (!empty($taskImages)): ?>
        <div class="row">
            <div class="col-md-4">
                <?php
                echo \common\widgets\swiper\SwiperWidget::widget(
                    ['imagesItems' => $taskImages]
                );
                ?>
            </div>
            <div class="col-md-8">
                <?= $model->body ?>
            </div>
        </div>

    <?php else: ?>
        <div class="row">
            <div class="col-12">
                <?= $model->body ?>
            </div>
        </div>
    <?php endif; ?>


</div>
