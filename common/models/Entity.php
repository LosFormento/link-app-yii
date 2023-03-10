<?php

namespace common\models;


use common\components\CommonHelpers;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;
use yii\helpers\HtmlPurifier;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property int $viewsCount
 * @property string $title
 * @property string $body
 * @property string $preview
 * @property int $status
 * @property int $entity_type
 * @property string $date_created
 * @property string $date_updated
 * @property array $images
 * @property double $geoLat
 * @property double $geoLng
 * @property integer $geoZoom
 * @property Category $category
 * @property User $user
 * @property EntityImage[] $entityImages
 */
class Entity extends ActiveRecord
{

    const ENTITY_TYPE = 1;
    const STATUS_ACTIVE = 1;
    public $images;

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
                'slugAttribute' => 'alias',
                'ensureUnique' => true,
                'immutable' => true
            ],
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'date_created',
                'updatedAtAttribute' => 'date_updated',
                'value' => new Expression('CURRENT_TIMESTAMP'),
            ],
        ];
    }


    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        /* @var $uplodedImage UploadedFile */

        foreach ($this->images as $uploadedImage) {
            $image = new EntityImage();
            $image->uploadedFile = $uploadedImage;
            $image->entity_id = $this->id;
            $image->entity_type = $this->entity_type;
            $image->save();
        }
    }

    public function beforeSave($insert)
    {
        //$this->user_id = Yii::$app->user->getId();

        $this->images = UploadedFile::getInstances($this, 'images');
        $this->status = self::STATUS_ACTIVE;
        $this->entity_type = self::ENTITY_TYPE;

        $this->body = HtmlPurifier::process($this->body,
            ['HTML.Allowed'=>'b,i,u,p,ul,li,ol']
        );
        $this->preview = CommonHelpers::generatePriview($this->body);
        if (count($this->entityImages) + count($this->images) > Yii::$app->params['entity.maxFiles']) {
            $this->addError('images', '???????????????????????? ?????????? ???????????? ???? ???????????? ?????????????????? ' . Yii::$app->params['entity.maxFiles']);
            return false;
        }

        $this->setAttribute('user_id', Yii::$app->user->getId());
        return parent::beforeSave($insert);
    }


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'entity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'category_id'], 'required'],
            [['user_id', 'category_id', 'status','geoZoom'], 'integer'],
            [['body','preview'], 'string'],
            [['date_created', 'date_updated'], 'safe'],
            [['title', 'alias'], 'string', 'max' => 255],
            [['alias'], 'unique'],
            [['geoLat','geoLng'],'number'],
            [['images'], 'file', 'maxFiles' => Yii::$app->params['entity.maxFiles'], 'extensions' => "jpg, png, jpeg", 'maxSize' => Yii::$app->params['entity.maxFileSize'],],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '??????????',
            'category_id' => '??????????????????',
            'title' => '??????????????????',
            'body' => '?????????? ??????????????',
            'status' => '????????????',
            'date_created' => '??????????????',
            'date_updated' => '??????????????????',
        ];
    }


    public function checkAuthor()
    {
        if (!Yii::$app->user->can('updateOwn', [
            'user_id' => $this->user_id
        ])) {
            throw new ForbiddenHttpException('?????????? ?? ??????????????.');
        } else {
            return true;
        }
    }

/*
    public function getGeoPos()
    {
        $geoModel = EntityGeo::findOne(['entity_type' => self::ENTITY_TYPE, 'entity_id' => $this->id]);
        if ($geoModel) {
            $this->_geoPos = [
                'lat' => $geoModel->lat,
                'lng' => $geoModel->lng
            ];
            return $this->_geoPos;
        } else {
            return null;
        }
    }

    public function setGeoPos($geoPos)
    {
        if ($geoPos && isset($geoPos['lat'], $geoPos['lng'])) {
            $geoModel = EntityGeo::findOne(['entity_type' => self::ENTITY_TYPE, 'entity_id' => $this->id]);
            if ($geoModel) {
                $geoModel->delete();
                $newGeo = new EntityGeo();
                $newGeo->entity_id = $this->id;
                $newGeo->entity_type = self::ENTITY_TYPE;
                $newGeo->lng = $geoPos['lng'];
                $newGeo->lat = $geoPos['lat'];
                if($newGeo->save()){
                    $this->_geoPos = [
                        'lat' => $newGeo->lat,
                        'lng' => $newGeo->lng
                    ];
                };
            }
        }
    }
*/

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntityImages()
    {
        return $this->hasMany(EntityImage::class, ['entity_id' => 'id'])->andWhere(['entity_type' => self::ENTITY_TYPE]);
    }
}
