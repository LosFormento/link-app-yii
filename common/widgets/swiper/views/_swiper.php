<?php
/* @var $params array */
/* @var $imagesItems array */
/* @var $image \common\models\EntityImage */
?>
<div class="swiper">
    <div class="swiper-wrapper">
        <?php foreach ($imagesItems as $image): ?>
            <div class="swiper-slide">
                <a href="<?= $image->getUrl() ?>" target="_blank">
                    <img src="<?= $image->getUrl(true) ?>">
                </a>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="swiper-pagination"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-scrollbar"></div>
</div>



