<?php
/* @var $params array */
use yii\bootstrap5\Html;
use yii\web\View;
?>
<div class="current-balance">
    <div class="amount">
        <div class="upper">Увас есть</div>
        <?=Yii::$app->user->identity->balance?> руб.
    </div>
    <div class="load-money">
        <a href="<?=\yii\helpers\Url::toRoute(['profile/payload'])?>" class="btn btn-done">Пополнить счет</a>
    </div>
</div>
