<?php

namespace common\models\external;


use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property int $catid
 * @property int $state
 * @property string $title
 * @property string $body
 * @property int $status
 * @property int $entity_type
 * @property string $created
 * @property string $date_updated
 * @property array $images
 * @property double $geoLat
 * @property double $geoLng
 * @property integer $geoZoom
 * @property Categories $category
 * @property User $user
 * @property EntityImage[] $entityImages
 */
class News extends ActiveRecord
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
        return 'esol_content';
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



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::class, ['id' => 'catid']);
    }


}
