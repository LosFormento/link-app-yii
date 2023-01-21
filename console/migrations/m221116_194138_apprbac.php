<?php

use common\components\AuthorRule;
use common\models\User;
use yii\db\Migration;

/**
 * Class m221116_194138_apprbac
 */
class m221116_194138_apprbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        Yii::$app->authManager->removeAll();
        $auth = Yii::$app->authManager;

        // добавляем роль "client"
        $client = $auth->createRole('client');
        $auth->add($client);

        $authorRule = new AuthorRule();
        $auth->add($authorRule);

        $updateOwn = $auth->createPermission('updateOwn');
        $updateOwn->description = 'Update own';
        $updateOwn->ruleName = $authorRule->name;
        $auth->add($updateOwn);
        $auth->addChild($client, $updateOwn);

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

        $auth->addChild($user_premium,$client);
        $auth->addChild($moderator, $user_premium);
        $auth->addChild($editor, $moderator);
        $auth->addChild($admin, $editor);//наследование прав ролей


        //создаем пользователя admin
        $this->_createUser('admin','adminadmin','admin', '+375259146390');
        $this->_createUser('editor','editoreditor','editor');
        $this->_createUser('user','useruser','client');
        $this->_createUser('userpremium','userpremiumuserpremium','user_premium');
        $this->_createUser('user2','user2user2','client');
        $this->_createUser('moderator','moderator','moderator');


    }
    private function _createUser($username,$password,$role,$phone = null){
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
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {


        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221116_194138_apprbac cannot be reverted.\n";

        return false;
    }
    */
}
