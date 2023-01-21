<?php

namespace frontend\controllers;

use common\models\Entity;
use common\models\User;
use yii\web\Controller;
use yii\web\Response;

class RestController extends Controller
{

    public function beforeAction($action)
    {

        \Yii::$app->response->format = Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }
    public function actionTaskIndex($category=NULL,$page=1)
    {
        $result=[];
        foreach (Entity::find()->with(['user','category'])->each() as $key=> $task){
            $result[$key]['task']=$task;
            /*
            $result[$key]['otherData']=[
                'user'=>$task->user,
                'images'=>$task->taskImages,
                'category'=>$task->category,
                'title'=>$task->title
            ];*/
        }

        return $result;
    }
}
