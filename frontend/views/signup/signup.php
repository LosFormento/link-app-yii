<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap5\ActiveForm */


use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Мгновенная Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>


    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>





                <div class="form-group">
                    <?= Html::submitButton('Продолжить регистрацию', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
