<?php

namespace common\models\external;

use common\models\UserSocAuth;
use common\models\SmsMessages;
use common\models\User;
use Yii;
use yii\base\NotSupportedException;
use yii\base\Security;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * UserEsol model
 *
 * @property integer $id
 * @property string $username
 * @property string $name
 * @property string $password
 * @property string $email
 * @property int $block
 */
class UserExternal extends ActiveRecord
{

    public static function getDb()
    {
        return Yii::$app->dbExternal;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'esol_users';
    }


    public function rules()
    {
        return [
            ['id'],
            ['username'],
            ['name'],
            ['password'],
            ['block']
        ];
    }


    public function validatePassword($password)
    {
        if (hash_equals($this->password, crypt($password, $this->password))) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserIdentity(string $serviceType = UserSocAuth::SERVICE_ESOL)
    {
        if ($socRelation = UserSocAuth::findOne(['service_id' => $this->id, 'service_type' => $serviceType])) {
            if ($userIdentity = User::findById($socRelation->user_id, false)) {
                if ($userIdentity->status == User::STATUS_ACTIVE) {
                    return $userIdentity;
                }
            }
        } else {
            $security = new Security();
            $newUserIdentity = new User();
            $newUserIdentity->username = 'user_' . md5($this->email);
            //$user->phone=$userData['phone'];
            $newUserIdentity->name = $this->name;
            $newUserIdentity->email = $this->email;
            $newUserIdentity->setPassword($security->generateRandomString(8));
            $newUserIdentity->generateAuthKey();
            $newUserIdentity->generateAccessToken();
            $newUserIdentity->generateEmailVerificationToken();
            $newUserIdentity->status = User::STATUS_ACTIVE;
            if ($newUserIdentity->save()) {
                $auth = Yii::$app->authManager;
                $auth->assign($auth->getRole('client'), $newUserIdentity->id);
                $newSocAuth = new UserSocAuth();
                $newSocAuth->user_id = $newUserIdentity->id;
                $newSocAuth->service_id = (string) $this->id;
                $newSocAuth->service_type = $serviceType;
                if ($newSocAuth->save()) {
                    return $newUserIdentity;
                }
            }
            return null;
        }
    }
}