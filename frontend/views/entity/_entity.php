<?php
/* @var $model \common\models\Entity*/

use common\models\EntityImage;
use yii\helpers\Html;
use yii\helpers\Url;
$formatter = Yii::$app->formatter;
?>
<?php
if(!empty($model->entityImages)){
    $img=$model->entityImages[0]->getUrl(true);
}else{
    $img=false;
}
?>
<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title"><?=$model->title?></h5>
        <h6 class="card-subtitle text-muted"><?=$model->category->name?></h6>
    </div>
    <?php if($img):?>
        <img class="img-fluid" src="<?=$img?>">
    <?php else:?>
        <img class="img-fluid" src="https://via.placeholder.com/<?= EntityImage::THUMB_WIDTH?>x<?=EntityImage::THUMB_HEIGHT?>.png">
    <?php endif;?>
    <div class="card-body">
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    </div>

    <div class="card-body">
        <a href="<?=Url::toRoute(['view','id'=>$model->id])?>">Подробнее</a>

    </div>
    <div class="card-footer text-muted">
        <?=$formatter->asRelativeTime($model->date_created);?>
    </div>
</div>
