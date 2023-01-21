<?php
namespace frontend\models;

use common\components\SmsProvider;
use common\models\SmsMessages;
use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Login form
 */
class LoginPhoneForm extends Model
{
    public string $phone = '';
    public string $messageHash = '';
    private User $_user;


    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'phone' => 'Номер телефона',
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['phone'], 'required'],
            // rememberMe must be a boolean value
            ['phone', 'common\components\PhoneValidator',
                'country'=>'BY'
            ],
            ['messageHash','string'],
            ['phone', 'exist', 'targetClass' => '\common\models\User', 'message' => 'Нет аккаунтов с таким номером телефона'],

        ];
    }


    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), User::LOGIN_DURATION);
        }
        
        return false;
    }

    public function sendCode(){
        if(!$this->validate()){
            return false;
        }
        $smsMessage = new SmsMessages();
        $smsMessage->phone = $this->phone;
        $smsMessage->type = SmsMessages::LOGIN;

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


    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByPhone($this->phone);
        }

        return $this->_user;
    }
}
