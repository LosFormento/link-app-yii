<?php

namespace frontend\controllers;

use common\models\Entity;
use common\models\EntityImage;
use common\models\external\News;
use common\models\TaskImage;
use frontend\models\EntityForm;
use frontend\models\TaskUpdateForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class NewsController extends Controller
{

    public function beforeAction($action)
    {
        $this->layout = '@common/views/layouts/front';
        return parent::beforeAction($action);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                //'only' => ['index', 'view'],
                'rules' => [
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => ['?','client'],
                    ],
                ],
            ],

        ];
    }



    public function actionIndex($category_id = null)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => News::find()->orderBy(['publish_up' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render(
            'index',
            ['dataProvider' => $dataProvider]
        );
    }

    public function actionView($id)
    {
        $model = $this->findEntity($id);
        $model->viewsCount++;
        $model->save(false);
        return $this->render('view',
            ['model' => $model]
        );
    }


    protected function findEntity($id)
    {
        if (($model = News::findOne($id)) !== null) {

            return $model;
        }

        throw new NotFoundHttpException('Страница не существует.');
    }

}
