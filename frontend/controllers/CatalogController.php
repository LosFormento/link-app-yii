<?php

namespace frontend\controllers;

use yii\web\Controller;

class CatalogController extends Controller
{
    public function actionCreate()
    {
        return $this->render('create');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionManage()
    {
        return $this->render('manage');
    }

    public function actionUpdate()
    {
        return $this->render('update');
    }

}
