<?php

use yii\db\Migration;

/**
 * Class m190907_073007_task
 */
class m190905_073001_city extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('city', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->unique()->notNull(),
            'alias' => $this->string()->unique()->notNull(),
            'icon' => $this->string(255),
            'description' => $this->text(),
            'status' => $this->integer()->defaultValue(1),
            'image' => $this->string(),
            'geoLat'=>$this->decimal(16,14),
            'geoLng'=>$this->decimal(17,14),
            'mapZoom'=>$this->integer()
        ]);

        $this->insert('city',[
            'id'=>1,
            'name'=>'Солигорск',
            'alias'=>'soligorsk',
            'status'=>1,
            'geoLat'=>52.789555,
            'geoLng'=>27.5150169,
            'mapZoom'=>14
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropTable('city');
    }

}
