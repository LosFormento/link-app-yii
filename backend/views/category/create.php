<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaskCategory */

$this->title = 'Create Entity Category';
$this->params['breadcrumbs'][] = ['label' => 'Entity Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
