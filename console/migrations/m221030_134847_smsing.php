<?php

use yii\db\Migration;

/**
 * Class m221030_134847_smsing
 */
class m221030_134847_smsing extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('sms_messages', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'type'=>$this->string()->notNull(),
            'phone'=>$this->string()->notNull(),
            'code'=>$this->integer()->notNull(),
            'hash'=>$this->string()->notNull(),
            'ip'=>$this->string()->notNull(),
            'useragent_hash'=>$this->string(),
            'message'=>$this->text(),
            'data'=>$this->text(),
            'date_created' =>$this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_updated' =>$this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'status'=>$this->integer()->defaultValue(1),
            'success'=>$this->boolean()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('sms_messages');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221030_134847_smsing cannot be reverted.\n";

        return false;
    }
    */
}
