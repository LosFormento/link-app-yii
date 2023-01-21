<?php

use yii\db\Migration;

/**
 * Class m190907_073007_task
 */
class m190905_073007_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'alias' => $this->string()->unique()->notNull(),
            'icon' => $this->string(255),
            'description' => $this->text(),
            'status' => $this->integer(),
            'city_id' => $this->integer()->defaultValue(1)
        ]);

        $this->insert('category',
            ['name' => 'Животные', 'alias' => 'zhivonyye'],
        );
        $this->insert('category',
            ['name' => 'Авто', 'alias' => 'avto'],
        );
        $this->insert('category',
            ['name' => 'Ремонт', 'alias' => 'remont'],
        );

        /*
        $this->createTable('category_custom_field',[
            'id'=>$this->primaryKey()->notNull(),
            'name'=>$this->string(255)->notNull(),
            'description'=>$this->string(255),
            'category_id'=>$this->integer()->notNull(),
            'field_type'=>$this->integer()->notNull(),
            'required'=>$this->boolean()->defaultValue(true)

        ]);

        // creates index for column `category_id`
        $this->createIndex(
            'idx-category_custom_field-category_id',
            'category_custom_field',
            'category_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-category_custom_field-category_id',
            'category_custom_field',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );

        $this->createTable('category_custom_field_value',[
            'id'=>$this->primaryKey(),
            'category_custom_field_id'=>$this->integer()->notNull(),
            'name'=>$this->string(),
            'value'=>$this->string()->notNull(),
            'description'=>$this->string()
        ]);

        // creates index for column `category_id`
        $this->createIndex(
            'idx-category_custom_field_value-category_custom_field_id',
            'category_custom_field_value',
            'category_custom_field_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-category_custom_field_value-category_custom_field_id',
            'category_custom_field_value',
            'category_custom_field_id',
            'category_custom_field',
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
        /*$this->dropTable('category_custom_field_value');
        $this->dropTable('category_custom_field');*/
        $this->dropTable('category');
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
