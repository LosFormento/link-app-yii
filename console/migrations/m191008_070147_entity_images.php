<?php

use yii\db\Migration;
use yii\helpers\FileHelper;

/**
 * Class m191008_070147_task_images
 */
class m191008_070147_entity_images extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        echo 'Создадим нужные папки'.PHP_EOL;
        FileHelper::createDirectory(Yii::getAlias('@image_uploads'),0777);
        $this->createTable('entity_images',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string()->notNull(),
            'path'=>$this->string()->notNull(),
            'alt'=>$this->string(),
            'entity_id'=>$this->integer()->notNull(),
            'entity_type'=>$this->integer()->notNull(),
            'size'=>$this->integer(),
            'type'=>$this->string(255),
            'old_file_name'=>$this->string(255),
            'date_created' =>$this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        FileHelper::removeDirectory(Yii::getAlias('@image_uploads'));
        $this->dropTable('entity_images');
    }

}
