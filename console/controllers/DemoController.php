<?php
namespace console\controllers;

use common\models\Category;
use common\models\User;
use Yii;
use yii\console\Controller;
use yii\helpers\FileHelper;


class DemoController extends Controller
{
    public function actionInstall(){

        $cat_array=array(
          'Животные',
          'Поезда'
        );
        foreach ($cat_array as $cat){
            $new_cat= new Category();
            $new_cat->name=$cat;
            $new_cat->save();
        }
    }
}