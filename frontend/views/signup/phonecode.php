<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupFormStep1 */

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
\frontend\assets\YandexMapsAsset::register($this);
$this->title = 'Мгновенная Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-phone-code']); ?>
            <?= $form->field($model, 'phoneCode')->textInput(['autofocus' => true]) ?>
            <?= Html::submitButton('Подтвердить',[
                'class' => 'btn btn-primary',
            ])?>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
