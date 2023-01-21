<?php
/* @var $this yii\web\View */
/* @var $model \frontend\models\WalletAddFundsForm */

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

?>



<div class="row">
    <div class="col">
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <?= $form->field($model, 'amount')->textInput() ?>
        <div class="form-group">
            <?= Html::submitButton('Пополнить', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>