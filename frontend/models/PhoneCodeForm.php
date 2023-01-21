<?php

namespace frontend\models;

use common\models\SmsMessages;
use Yii;
use yii\base\Model;
use common\models\User;
use yii\base\Security;

/**
 * Signup form
 */
class PhoneCodeForm extends Model
{
    public $phoneCode;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['phoneCode', 'trim'],
            ['phoneCode', 'required'],
            ['phoneCode', 'integer'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User whether the creating new account was successful and email was sent
     */
    public function checkCode($hash,$type){
        $message= SmsMessages::findOne([
            'hash'=>$hash,
            'status'=>SmsMessages::STATUS_ACTIVE,
            'success'=>1
        ]);

        if($message && $this->phoneCode == $message->code){

            if($type == SmsMessages::REGISTRATION ){
                //var_dump( $message->attributes);die();
                $security= new Security();
                $userData=json_decode($message->data,true);
                $user = new User();
                $user->username = 'user_'.md5($userData['phone']);
                $user->phone=$userData['phone'];
                $user->name=$userData['name'];
                $user->setPassword($security->generateRandomString(8));
                $user->generateAuthKey();
                $user->generateAccessToken();
                $user->generateEmailVerificationToken();
                $user->status=User::STATUS_ACTIVE;

                if($user->save()){
                    $auth = Yii::$app->authManager;
                    $auth->assign($auth->getRole('user'),$user->id);

                    $message->status=SmsMessages::STATUS_NOT_ACTIVE;
                    $message->save();
                    return $user;
                }else{

                    $this->addError('phoneCode','Что-то с номером не так');
                    return NULL;
                }
            }elseif ($type == SmsMessages::LOGIN){
                $loginedUser=User::findByPhone($message->phone);
                $loginedUser->generateAccessToken();
                $loginedUser->save();
                $message->status=SmsMessages::STATUS_NOT_ACTIVE;
                $message->save();
                return $loginedUser;
            }else{
                return NULL;
            }
        }else{
            return NULL;
        }
    }

    public function checkCodeLogin($hash){
        $message= SmsMessages::findOne(['hash'=>$hash]);
        if($message && $this->phoneCode == $message->code){
           return User::findByPhone($message->phone);
        }else{
            return NULL;
        }
    }

}
