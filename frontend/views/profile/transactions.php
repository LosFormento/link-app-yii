<?php
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\widgets\ListView;
$this->title = 'Транзакции';
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="row">
    <div class="col">
        <?php
        echo ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_transaction',
        ]);
        ?>
    </div>
</div>