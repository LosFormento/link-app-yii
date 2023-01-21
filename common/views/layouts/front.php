<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use common\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <header>

        <?php
        $topMenuItems = [
            ['label' => 'Главная', 'url' => ['site/index']],
            ['label' => 'Новости', 'url' => ['news/index']],
            ['label' => 'Расписание автобусов', 'url' => ['site/raspisanie']],
            ['label' => 'Какие-то штуки', 'url' => ['entity/index']],
        ];
        echo \common\widgets\esol\TopMenuWidget::widget([
            'items' => $topMenuItems
        ]) ?>
    </header>
    <?php if (isset($this->params['breadcrumbs'])): ?>


        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'itemTemplate' => '<li class="breadcrumb-item">{link}</li>',
                'activeItemTemplate' => '<li class="breadcrumb-item active">{link}</li>'

            ]) ?>
        </div>
    <?php endif; ?>
    <?php if (isset($this->title)): ?>
        <div class="container">
            <h1 class="page-title"><?= $this->title ?></h1>
        </div>
    <?php endif; ?>
    <div class="container">
        <?= Alert::widget() ?>
        <?php if (isset($this->params['leftMenu'])): ?>
            <div class="row">
                <div class="col-md-3">
                    <?php echo \common\widgets\esol\LeftMenuWidget::widget([
                        'items' => $this->params['leftMenu']
                    ]); ?>
                </div>
                <div class="col-md-9">
                    <?= $content ?>
                </div>
            </div>
        <?php else: ?>
            <?= $content ?>
        <?php endif; ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        &copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
