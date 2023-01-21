<?php

namespace frontend\controllers;

use common\models\Entity;
use common\models\UserWalletTransaction;
use frontend\models\WalletAddFundsForm;

use Yii;
use yii\bootstrap5\Html;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class ProfileController extends Controller
{



    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        $this->layout = '@common/views/layouts/front';
        $this->getView()->params['leftMenu']=[
            ['url'=>['profile/index'],'label'=>'Профиль'],
            ['url'=>['profile/transactions'],'label'=>'Транзакции'],
            ['url'=>['profile/list'],'label'=>'Список профилей'],
            [   'encode'=>false,
                'label'=>'<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выйти',
                    ['class' => 'btn btn-outline-default']
                )
                . Html::endForm()
                . '</li>']
        ];
        return parent::beforeAction($action);
    }




    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionPayload()
    {
        $model = new WalletAddFundsForm();

        if ($model->load(Yii::$app->request->post()) && $model->process()) {
            Yii::$app->session->setFlash('success', 'Спасибо, ваши деньги добавлены!');
            return $this->redirect(['index']);
        }
        return $this->render('payload', [
            'model' => $model,
        ]);

    }
    public function actionTransactions()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => UserWalletTransaction::find()->where(['user_id' => Yii::$app->user->id]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('transactions', [
            'dataProvider' => $dataProvider
        ]);
    }
}
