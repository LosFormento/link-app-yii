<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap5\ActiveForm */

/* @var $model \frontend\models\EntityForm */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use vova07\imperavi\Widget;
use kartik\file\FileInput;
use kartik\icons\FontAwesomeAsset;
use common\models\Category;

FontAwesomeAsset::register($this);
$this->title = 'Добавить';
?>
<?php

echo $this->render('_form', [
    'model' => $model,
    'scenario' => 'create'
]);
?>
