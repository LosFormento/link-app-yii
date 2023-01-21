<?php
/* @var $params array */
use yii\bootstrap5\Html;
use yii\web\View;
?>
<div class="top-profile">
    <?php if(Yii::$app->user->isGuest):?>
        <a href="<?=\yii\helpers\Url::toRoute(['site/login'])?>">Войти</a>
    <?php else:?>
        <a href="<?=\yii\helpers\Url::toRoute(['profile/index'])?>"><?=Yii::$app->user->identity->name?></a>
    <?php endif?>
</div>
