<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupFormStep1 */

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

            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::class, [
                'mask' => Yii::$app->params['user.phoneMask'],
            ]) ?>
            <?= Html::submitButton('Получить код',[
                'class' => 'btn btn-primary',
                'id' => 'signupformphone-getcode'])?>
            <?php ActiveForm::end(); ?>


        </div>
    </div>
</div>
