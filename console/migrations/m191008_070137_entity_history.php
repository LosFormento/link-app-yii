<?php

use yii\db\Migration;


/**
 * Class m191008_070147_entity_history
 */
class m191008_070137_entity_history extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('entity_history', [
            'id' => $this->primaryKey(),
            'entity_id' => $this->integer()->notNull(),
            'entity_type' => $this->integer()->notNull(),
            'json_new_content' => $this->text()->notNull(),
            'json_old_content' => $this->text()->notNull(),
            'date_updated' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'user_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('entity_history');
    }

}
