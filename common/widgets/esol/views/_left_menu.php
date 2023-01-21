<?php
/* @var $items array */

use yii\web\View;
use yii\widgets\Menu;
?>

<div class="left-menu">
    <?= Menu::widget([
        'items' => $items,
        'activeCssClass' => 'active'
    ]);?>
</div>

