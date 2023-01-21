<?php

namespace frontend\models;

use common\components\CommonHelpers;
use common\components\EsolProxy;
use common\models\external\UserExternal;
use common\models\User;
use DateTimeInterface;
use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginEmailForm extends Model
{
    public string $username = '';
    public string $password = '';
    public bool $rememberMe = true;

    private ?UserExternal $_user = null;


    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'username' => 'Имя пользователя или email',
            'password' => 'Пароль'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],

            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword(string $attribute, array|null $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неверные данные для входа');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $user = $this->getUser();
            if ($user->block) {
                $this->addError('password', 'Этот пользователь был заблокирован');
                return false;
            }
            if ($identity = $user->getUserIdentity()) {
                $identity->date_last_login = date(CommonHelpers::MYSQL_DATE_FORMAT,time());
                $identity->save();
                return Yii::$app->user->login($identity, User::LOGIN_DURATION);
            } else {
                $this->addError('password', 'Ошибка сервера, что-то пошло не так');
                return false;
            }
        }
        $this->addError('username', 'Ошибка сервера');
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return UserExternal|null
     */
    protected function getUser(): ?UserExternal
    {

        if ($this->_user === null) {
            $this->_user = UserExternal::find()->where(['or',
                ['username' => $this->username],
                ['email' => $this->username]
            ])->one();
        }
        return $this->_user;
    }
}
