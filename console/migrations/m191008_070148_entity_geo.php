<?php

use yii\db\Migration;
use yii\helpers\FileHelper;

/**
 * Class m191008_070147_task_images
 */
class m191008_070148_entity_geo extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('entity_geo',[
            'id'=>$this->primaryKey(),
            'entity_id'=>$this->integer()->notNull(),
            'entity_type'=>$this->integer()->notNull(),
            'date_created' =>$this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'lat'=>$this->double()->notNull(),
            'lng'=>$this->double()->notNull()
        ]);
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('entity_geo');
    }
}