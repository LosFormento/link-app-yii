<?php

use yii\db\Migration;

/**
 * Class m190907_073007_task
 */
class m190907_073007_entity extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('entity', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->unsigned()->notNull(),
            'category_id' => $this->integer()->defaultValue(1),
            'title' => $this->string()->notNull(),
            'alias' => $this->string()->unique()->notNull(),
            'body' => $this->text(),
            'status' => $this->integer(),
            'entity_type' => $this->integer()->defaultValue(1),
            'date_created' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_updated' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_active_to' => $this->dateTime(),
            'date_last_up' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'city_id' => $this->integer()->defaultValue(1),
            'geoLat'=>$this->decimal(16,14),
            'geoLng'=>$this->decimal(17,14),
            'geoZoom'=>$this->integer()->defaultValue(13),
            'viewsCount'=>$this->integer()->defaultValue(0)
        ]);

        $this->createIndex(
            'idx-entity-user_id',
            'entity',
            'user_id'
        );

        $this->addForeignKey(
            'fk-entity-user_id',
            'entity',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'idx-entity-category_id',
            'entity',
            'category_id'
        );
        $this->addForeignKey(
            'fk-entity-category_id',
            'entity',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );

        //города
        $this->createIndex(
            'idx-entity-city_id',
            'entity',
            'city_id'
        );
        $this->addForeignKey(
            'fk-entity-city_id',
            'entity',
            'city_id',
            'city',
            'id',
            'CASCADE'
        );
        /*
                $this->createTable('rel_task_category_field',[
                    'id'=>$this->primaryKey(),
                    'task_id'=>$this->integer()->notNull(),
                    'category_custom_field_value_id'=>$this->integer()->notNull()
                ]);

                $this->createIndex(
                    'idx-rel_task_category_field-task_id',
                    'rel_task_category_field',
                    'task_id'
                );
                $this->createIndex(
                    'idx-rel_task_category_field-category_custom_field_value_id',
                    'rel_task_category_field',
                    'category_custom_field_value_id'
                );
                $this->addForeignKey(
                    'fk-rel_task_category_field-task_id',
                    'rel_task_category_field',
                    'task_id',
                    'task',
                    'id',
                    'CASCADE'
                );
                $this->addForeignKey(
                    'fk-rel_task_category_field-category_custom_field_value_id',
                    'rel_task_category_field',
                    'category_custom_field_value_id',
                    'category_custom_field_value',
                    'id',
                    'CASCADE'
                );

        */
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //$this->dropTable('rel_task_category_field');
        $this->dropTable('entity');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190907_073007_task cannot be reverted.\n";

        return false;
    }
    */
}
