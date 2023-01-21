<?php

namespace api\modules\v1\controllers;

use common\models\LoginForm;
use common\models\SmsMessages;
use common\models\Entity;
use frontend\models\LoginPhoneForm;
use frontend\models\PhoneCodeForm;
use frontend\models\SignupPhoneForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use yii\rest\Controller;
use yii\web\Response;

/**
 * Country Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class AuthController extends Controller
{

    public function actionLogin(){
        $loginForm= new LoginPhoneForm();
        $loginForm->load(Yii::$app->getRequest()->getBodyParams(),'');
        if(!$loginForm->sendCode() && $loginForm->hasErrors()){
            Yii::$app->response->statusCode = 422;
            return $loginForm->errors;
        }else{
            return ['id'=>$loginForm->messageHash];
        }
    }

    public function actionSignup(){
        $model = new SignupPhoneForm();
        $model->load(Yii::$app->getRequest()->getBodyParams(),'');
        if(!$model->signup() && $model->hasErrors()){
            Yii::$app->response->statusCode = 422;
            return $model->errors;
        }else{
            return ['id'=>$model->messageHash];
        }
    }
    public function actionCode(){
        $model = new PhoneCodeForm();
        $model->phoneCode = Yii::$app->getRequest()->getBodyParam('phoneCode');
        if ($model->validate() && $user = $model->checkCode(Yii::$app->getRequest()->getBodyParam('id'),Yii::$app->getRequest()->getBodyParam('type'))) {
            return $user->getAccessToken();
        }else{
            Yii::$app->response->statusCode = 422;
            return ['code'=>'Неверный код'];
        }

    }
}


