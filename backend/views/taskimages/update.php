<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaskImage */

$this->title = 'Update Entity Image: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Entity Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="task-image-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
