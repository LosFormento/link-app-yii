<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "entity_geo".
 *
 * @property int $id
 * @property int $entity_id
 * @property int $entity_type
 * @property string|null $date_created
 * @property float $lat
 * @property float $lng
 */
class EntityGeo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'entity_geo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entity_id', 'entity_type', 'lat', 'lng'], 'required'],
            [['entity_id', 'entity_type'], 'integer'],
            [['date_created'], 'safe'],
            [['lat', 'lng'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entity_id' => 'Entity ID',
            'entity_type' => 'Entity Type',
            'date_created' => 'Date Created',
            'lat' => 'Lat',
            'lng' => 'Lng',
        ];
    }
}
