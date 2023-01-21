<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap5\ActiveForm */
/* @var $scenario string */

/* @var $model \frontend\models\EntityForm */

use kartik\editors\Summernote;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use common\widgets\yandex\YandexPickerWidget;


use kartik\file\FileInput;
use kartik\icons\FontAwesomeAsset;
use common\models\Category;

FontAwesomeAsset::register($this);

?>
<div class="site-<?= $scenario ?>">
    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= $form->field($model, 'title')->textInput(['autofocus' => true]) ?>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Category::find()->all(), 'id', 'name')) ?>
                    <?= Summernote::widget([
                        'model' => $model,
                        'attribute' => 'body',
                        'pluginOptions' => [
                            //'height' => 100,
                            'toolbar' => [
                                ['style', ['bold', 'italic', 'underline', 'clear']],
                                ['para', ['ul', 'ol']]
                            ]
                        ]
                    ]);
                    ?>
                </div>
                <div class="col-md-6">
                    <?=
                    YandexPickerWidget::widget(
                        [
                            'model' => $model,
                            'latField' => 'geoLat',
                            'lngField' => 'geoLng',
                            'zoomField' => 'geoZoom'
                        ]
                    )
                    ?>
                </div>
            </div>


            <?php
            // files upload config
            $pluginOptions = [
                'allowedFileExtensions' => ["jpg", "png", "jpeg"],
                'showUpload' => false,
                //'maxFileCount'=>4,
                'maxTotalFileCount' => 4,
                'overwriteInitial' => false,
                'showCancel' => false,
                'encodeUrl' => false,
                'showRemove' => false,
                'maxFileSize' => 5242880,
                'initialPreviewAsData' => true,
                'language' => 'ru',
                //'initialCaption'=>"The Moon and the Earth",
                //'uploadUrl'=>"/file-upload-batch/2",
                "fileActionSettings" => [
                    "showUpload" => false,
                    "showRemove" => true,
                    "showZoom" => false,
                    'showRotate' => false,
                    'showDrag' => false,
                ]
            ];
            $initalPreview = $initialPreviewConfig = null;
            foreach ($model->entityImages as $task_image) {
                $initalPreview[] = $task_image->getUrl(true);
                $initialPreviewConfig[] =
                    [
                        'caption' => $task_image->old_file_name,
                        'size' => $task_image->size,
                        'url' => Url::toRoute(['deleteimage', 'image_id' => $task_image->id])
                    ];
            }
            if ($initalPreview && $initialPreviewConfig) {
                $previewOptions = [
                    'initialPreview' => $initalPreview,
                    'initialPreviewConfig' => $initialPreviewConfig,
                ];
                $pluginOptions = $pluginOptions + $previewOptions;
            }
            ?>


            <?= $form->field($model, 'images[]')->widget(FileInput::class, [
                'options' => [
                    //'accept' => 'image/*',
                    'multiple' => true,
                    //'allowedFileExtensions'=> ["jpg", "png","jpeg"]
                ],
                'pluginOptions' => $pluginOptions
            ]); ?>
            <?= $form->errorSummary($model) ?>
            <div class="form-group">
                <?= Html::submitButton($scenario == 'update' ? 'Обновить' : 'Сохранить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>