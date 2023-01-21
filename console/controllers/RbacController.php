<?php
namespace console\controllers;

use common\components\AuthorRule;
use common\models\User;
use Yii;
use yii\console\Controller;


class RbacController extends Controller
{



    public function actionInit(){

        Yii::$app->authManager->removeAll();

        $auth = Yii::$app->authManager;

        $authorRule = new AuthorRule();
        // add permissions
        $auth->add($authorRule);

        $updateOwn = $auth->createPermission('updateOwn');
        $updateOwn->description = 'Update own';
        $updateOwn->ruleName = $authorRule->name;
        $auth->add($updateOwn);

        // добавляем роль "user"
        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $updateOwn);

        // добавляем роль "premium user"
        $user_premium = $auth->createRole('user_premium');
        $auth->add($user_premium);

        // добавляем роль "editor"
        $editor=$auth->createRole('editor');
        $auth->add($editor);

        // добавляем роль "moderator"
        $moderator=$auth->createRole('moderator');
        $auth->add($moderator);

        // добавляем роль "admin"
        $admin = $auth->createRole('admin');
        $auth->add($admin);

        $auth->addChild($user_premium,$user);
        $auth->addChild($moderator, $user_premium);
        $auth->addChild($admin, $moderator);//наследование прав ролей
        $auth->addChild($moderator, $editor);
        $auth->addChild($editor, $user);

        //создаем пользователя admin
        $this->_createUser('admin','adminadmin','admin','+375251111111');
        $this->_createUser('editor','editoreditor','editor','+375252222222');
        $this->_createUser('user','useruser','user','+375253333333');
        $this->_createUser('userpremium','userpremiumuserpremium','user_premium','+375253453333');
        $this->_createUser('user2','user2user2','user','+375254444444');
        $this->_createUser('moderator','moderator','moderator','+375255555555');
    }

    private function _createUser($username,$password,$role,$phone){
        //делаем пользователя
        $admin_user=new User();
        $admin_user->username=$username;
        $admin_user->email=$username.'@link-app-php.test';
        $admin_user->password=$password;
        $admin_user->generateAuthKey();
        $admin_user->generateAccessToken();
        $admin_user->generateEmailVerificationToken();
        $admin_user->status=User::STATUS_ACTIVE;
        $admin_user->phone=$phone;
        $admin_user->name = $username;
        $admin_user->save();
        //назначаем роль
        $auth = Yii::$app->authManager;
        $auth->assign($auth->getRole($role),$admin_user->id);
    }


}