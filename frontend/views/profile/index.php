<?php
/* @var $this yii\web\View */
$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <?php echo \common\widgets\esol\BalanceWidget::widget([

        ]); ?>
    </div>
</div>