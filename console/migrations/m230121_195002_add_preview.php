<?php

use yii\db\Migration;

/**
 * Class m230121_195002_add_preview
 */
class m230121_195002_add_preview extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('entity','preview',$this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('entity','preview');
    }

}
