<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;
use yii\bootstrap5\Breadcrumbs;
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
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => ['class' => 'navbar-expand-md navbar-dark bg-primary']
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav me-auto'],
            'items' => [
                ['label' => Yii::t('main', 'Home'), 'url' => ['/']],
                ['label' => Yii::t('main', 'About'), 'url' => ['/site/about']],
                ['label' => Yii::t('main', 'Contact'), 'url' => ['/site/contact']],
            ]
        ]);
        ?>

        <?php
        if (Yii::$app->user->isGuest):?>
            <a class="btn btn-dark"
                    href="<?= Url::toRoute('site/login') ?>"><?= Yii::t('main', 'Login') ?></a>
            <a class="btn btn-dark"
                    href="<?= Url::toRoute('site/signup') ?>"><?= Yii::t('main', 'Signup') ?></a>
        <?php else: ?>
            <?= Html::beginForm(['/site/logout'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-dark logout']
            )
            . Html::endForm() ?>
        <?php endif; ?>
        <?php
        NavBar::end();
        ?>
    </header>
    <?php if (isset($this->params['breadcrumbs'])): ?>
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                //'itemTemplate' => '<li class="breadcrumb-item">{link}</li>',
                //'activeItemTemplate' => '<li class="breadcrumb-item active">{link}</li>'
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
        <?= $content ?>
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
