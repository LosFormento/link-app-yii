<?php

namespace frontend\models;

use common\components\SmsProvider;
use common\models\SmsMessages;
use Yii;
use yii\base\Model;
use common\models\User;
use yii\base\Security;

/**
 * Signup form
 */
class SignupPhoneForm extends Model
{
    public $name;
    public $phone;
    public $messageHash;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'trim'],
            ['name', 'required'],
            ['name', 'string', 'min' => 2, 'max' => 255],
            ['messageHash', 'string'],
            ['phone', 'required'],
            ['phone', 'common\components\PhoneValidator',
                'country'=>'BY'
            ],
            ['phone', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Под этим номером уже кто-то зарегистрировался'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $smsMessage = new SmsMessages();
        $smsMessage->phone = $this->phone;
        $smsMessage->type = SmsMessages::REGISTRATION;
        $smsMessage->code = SmsProvider::generateCode();
        $smsMessage->hash = md5(time().$this->phone);
        $this->messageHash = $smsMessage->hash;
        $smsMessage->ip = Yii::$app->request->userIP;
        $smsMessage->data = json_encode($this->attributes);
        if($smsMessage->send()){
            $smsMessage->save();
            return true;
        }else{
            return false;
        }
    }
}
