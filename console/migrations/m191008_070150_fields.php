<?php

use yii\db\Migration;
use yii\helpers\FileHelper;

/**
 * Class m191008_070147_task_images
 */
class m191008_070150_fields extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('field',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string()->notNull(),
            'field_type'=>$this->integer()->notNull(),
            'predefined_values'=>$this->json()->notNull()
        ]);
        $this->createTable('field_profile_values',[
            'id'=>$this->primaryKey(),
            'field_id'=>$this->integer()->notNull(),
            'profile_id'=>$this->integer()->notNull(),
            'value'=>$this->json()
        ]);
        $this->createTable('field_entity_values',[
            'id'=>$this->primaryKey(),
            'field_id'=>$this->integer()->notNull(),
            'entity_id'=>$this->integer()->notNull(),
            'value'=>$this->json()->notNull()
        ]);
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('field');
        $this->dropTable('field_profile_values');
        $this->dropTable('field_entity_values');
    }
}