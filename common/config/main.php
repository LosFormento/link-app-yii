<?php
$conf = [
    'language' => 'ru-RU',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@image_uploads' => '@frontend/web/uploads/image_uploads',
        '@web_image_uploads' => '/uploads/image_uploads',
        '@api' => dirname(dirname(__DIR__)) . '/api',
    ],
    'timeZone' => 'Europe/Minsk',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'formatter' => [
            //'dateFormat' => 'dd.MM.yyyy',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'BYN',
            //'defaultTimeZone' => 'Europe/Minsk'
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['user'],
            // uncomment if you want to cache RBAC items hierarchy
            // 'cache' => 'cache',
        ],
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages', // if advanced application, set @frontend/messages
                    //'sourceLanguage' => 'ru',
                    'fileMap' => [
                        'udokmeci.phone.validator' => 'phonevalidator.php',
                        'main' => 'main.php',
                    ],
                ],
            ],
        ],
    ],
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module',
            'bsVersion' => '5'
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ],

    ],
];

return $conf;