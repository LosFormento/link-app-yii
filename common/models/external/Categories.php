<?php

namespace common\models\external;


use Yii;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $title
 */
class Categories extends ActiveRecord
{

    public static function getDb()
    {
        return Yii::$app->dbExternal;
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'esol_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
        ];
    }


}
