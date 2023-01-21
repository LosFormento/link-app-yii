<?php
/* @var $model \common\models\Entity*/

use common\models\EntityImage;
use yii\helpers\Html;
use yii\helpers\Url;
$formatter = Yii::$app->formatter;
?>
<?php
if(!empty($jsImg = json_decode($model->images,true))){
    $img='https://esoligorsk.by/'.$jsImg['image_intro'];
}else{
    $img=false;
}
?>
    <div class="entity-list-item">
        <div class="entity-list-category">
            <a href="#"><?=$model->category->title?></a>
        </div>
        <div class="entity-list-img">
            <?php if($img):?>
                <img class="img-fluid" src="<?=$img?>">
            <?php else:?>
                <img class="img-fluid" src="https://via.placeholder.com/<?= EntityImage::THUMB_WIDTH?>x<?=EntityImage::THUMB_HEIGHT?>.png">
            <?php endif;?>
        </div>
        <div class="entity-list-footer">
            <div class="entity-list-title">
                <a href="<?=Url::toRoute(['view','id'=>$model->id])?>"><?=Html::encode($model->title)?></a>
            </div>
            <div class="footer-dop-info">
                <?=$formatter->asRelativeTime($model->publish_up);?>
                <i class="fa-regular fa-eye"></i> <span><?=$model->hits?></span>
            </div>
        </div>
    </div>
