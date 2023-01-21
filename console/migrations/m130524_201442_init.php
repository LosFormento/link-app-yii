<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey()->unsigned(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'access_token' => $this->string(64)->unique()->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(9),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'phone' => $this->string()->unique(),
            'phoneCode' => $this->integer(),
            'date_last_login' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'name' => $this->string(30)->notNull(),
            'avatar' =>$this->string(),
            'firebaseUserToken' => $this->string(),
        ], $tableOptions);

        $this->createTable('user_profile', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name'=>$this->string()->notNull(),
            'profile_type' => $this->string()->notNull(),
            'date_created' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createTable('user_soc_auth', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'service_type' => $this->string()->notNull(),
            'service_id' => $this->string()->notNull(),
            'date_created' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_last_login' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
        $this->createTable('user_wallet', [
            'user_id' => $this->primaryKey(),
            'balance' => $this->float()->defaultValue(0.0),
        ]);
        $this->createTable('user_wallet_transaction', [
            'id' => $this->primaryKey(),
            'user_wallet_id' => $this->integer()->notNull(),
            'user_wallet_old_ballance' => $this->float()->notNull(),
            'amount' => $this->float()->notNull(),
            'type' => $this->integer()->notNull(),
            'is_income' => $this->integer()->defaultValue(0),
            'description' => $this->string(),
            'date_created' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'user_id'=> $this->integer()->notNull()
        ]);
        $this->createTable('user_wallet_processing', [
            'id' => $this->primaryKey(),
            'user_wallet_id' => $this->integer()->notNull(),
            'amount' => $this->float()->notNull(),
            'type' => $this->integer()->notNull(),
            'type_string' => $this->string(),
            'description' => $this->string(),
            'status' => $this->integer()->defaultValue(0),
            'date_created' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_payed' => $this->dateTime(),
            'processing_hash' => $this->string()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
        $this->dropTable('user_profile');
        $this->dropTable('user_soc_auth');
        $this->dropTable('user_wallet');
        $this->dropTable('user_wallet_transaction');
        $this->dropTable('user_wallet_processing');
    }
}
