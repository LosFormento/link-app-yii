<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap5\ActiveForm */
/* @var $model LoginPhoneForm */
/* @var $modelEmail LoginEmailForm */


use common\models\external\UserExternal;
use frontend\models\LoginEmailForm;
use frontend\models\LoginPhoneForm;
use yii\bootstrap5\Tabs;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Войти';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-phone-tab" data-bs-toggle="tab" data-bs-target="#nav-phone" type="button" role="tab" aria-controls="nav-phone" aria-selected="true">По номеру телефона</button>
            <button class="nav-link" id="nav-social-tab" data-bs-toggle="tab" data-bs-target="#nav-social" type="button" role="tab" aria-controls="nav-social" aria-selected="false">Через Соцсети (Vkontakte, Одноклассники, Google, Facebook и др)</button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabLogin">
        <div class="tab-pane fade show active" id="nav-phone" role="tabpanel" aria-labelledby="nav-phone-tab">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::class, [
                'mask' => Yii::$app->params['user.phoneMask'],
            ]) ?>
            <div class="form-group">
                <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="tab-pane fade" id="nav-social" role="tabpanel" aria-labelledby="nav-social-tab">
            Соцсети
        </div>
    </div>

</div>
