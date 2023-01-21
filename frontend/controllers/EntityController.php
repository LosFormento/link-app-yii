<?php

namespace frontend\controllers;

use common\models\Entity;
use common\models\EntityImage;
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

class EntityController extends Controller
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
                        'actions' => ['create', 'update', 'delete', 'manage', 'deleteimage'],
                        'allow' => true,
                        'roles' => ['client'],
                    ],
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => ['?','client'],
                    ],

                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    public function actionCreate()
    {

        $model = new EntityForm();
        if ($model->load(Yii::$app->request->post())) {

            if ($model->validate() && $model->save()) {
                Yii::$app->session->setFlash('success', 'Спасибо, ваше нечто добавлено!');
                return $this->redirect(['manage']);
            }
            Yii::$app->session->setFlash('error', 'Произошла ошибка валидации данных формы. Попробуйте еще раз или обратитесь в службу поддержки.');
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionIndex($category_id = null)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Entity::find()->orderBy(['date_created' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render(
            'index',
            ['dataProvider' => $dataProvider]
        );
    }

    public function actionManage()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Entity::find()->where(['user_id' => Yii::$app->user->id]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('manage', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findEntity($id);
        $model->checkAuthor();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionDelete($id)
    {
        $model = $this->findEntity($id);
        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Удалено!');
        } else {
            Yii::$app->session->setFlash('danger', 'Ошибка удаления!');
        }
        return $this->redirect(Url::toRoute('manage'));
    }

    public function actionDeleteimage($image_id)
    {
        $image = EntityImage::findOne($image_id);
        $entity = Entity::findOne(['id' => $image->entity_id, 'entity_type' => $image->entity_type]);
        $entity->checkAuthor();
        $result = ['error' => true, 'message' => 'Ошибка удаления'];
        if ($image) {
            if ($image->delete()) {
                $result = ['message' => 'Файл удален'];
            }
        }
        return json_encode($result);
    }

    public function actionView($id)
    {
        $model = $this->findEntity($id);
        if(!Yii::$app->user->isGuest){
            $model->viewsCount++;
            $model->save(false);
        }

        return $this->render('view',
            ['model' => $model]
        );
    }


    protected function findEntity($id)
    {
        if (($model = EntityForm::findOne($id)) !== null) {

            return $model;
        }

        throw new NotFoundHttpException('Страница не существует.');
    }

}
