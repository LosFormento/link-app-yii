<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaskCategory */

$this->title = 'Update Entity Category: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Entity Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="task-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
