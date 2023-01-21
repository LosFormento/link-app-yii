<?php

namespace common\models;

use Imagine\Image\ImageInterface;
use Imagine\Image\ManipulatorInterface;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\web\UploadedFile;

/**
 * This is the model class for table "task_image".
 *
 * @property int $id
 * @property string $name
 * @property string $path
 * @property string $alt
 * @property string $old_file_name
 * @property string $type
 * @property int $entity_id
 * @property int $entity_type
 * @property int $size
 * @property UploadedFile uploadedFile
 *
 * @property Entity $task
 */
class EntityImage extends ActiveRecord
{
    //у фейсбука  492 x 276 фотки превью,

    public $uploadedFile;
    const THUMB_WIDTH = 492;
    const THUMB_HEIGHT = 276;
    const DETAIL_WIDTH = 984;
    const DETAIL_HEIGHT = 984;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'entity_images';
    }

    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['uploadedFile', 'entity_id', 'entity_type'], 'required'],
            [['entity_id', 'entity_type'], 'integer'],
            [['name', 'path', 'alt'], 'string', 'max' => 255],
            [['entity_id'], 'exist', 'skipOnError' => true, 'targetClass' => Entity::class, 'targetAttribute' => ['entity_id' => 'id']],
        ];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $thumb = Image::thumbnail($this->uploadedFile->tempName, self::THUMB_WIDTH, self::THUMB_HEIGHT, ImageInterface::THUMBNAIL_OUTBOUND);
        $detail = Image::thumbnail($this->uploadedFile->tempName, self::DETAIL_WIDTH, self::DETAIL_HEIGHT, ImageInterface::THUMBNAIL_FLAG_NOCLONE);
        $savePath = uniqid('link_app', true) . '.jpg';
        FileHelper::createDirectory(Yii::getAlias('@image_uploads') . DIRECTORY_SEPARATOR . $this->entity_type . '_' . $this->entity_id,0777);
        FileHelper::createDirectory(Yii::getAlias('@image_uploads') . DIRECTORY_SEPARATOR . $this->entity_type . '_' . $this->entity_id . DIRECTORY_SEPARATOR . 'thumb',0777);

        $this->name = $savePath;
        $this->path = $savePath;
        $this->size = $detail->metadata()->get('file.FileSize');
        $this->old_file_name = $this->uploadedFile->name;
        $this->type = $detail->metadata()->get('file.MimeType');

        $thumbPath = $this->getPath(true);
        $detailPath = $this->getPath();
        $detail->save($detailPath);
        $thumb->save($thumbPath);

        if (file_exists($thumbPath) && file_exists($detailPath)) {
            return true;
        } else {
            Yii::$app->session->setFlash('error', "Ошибка обработки и сохранения файла");
            return false;
        }
    }

    /**
     * Remove images after model deletion
     */
    public function afterDelete()
    {
        @unlink($this->getPath());
        @unlink($this->getPath(true));
        parent::afterDelete();
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'path' => 'Path',
            'alt' => 'Alt',
            'task_id' => 'Entity ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Entity::class, ['id' => 'task_id']);
    }

    public function getPath($preview = false)
    {
        if ($preview) {
            return Yii::getAlias('@image_uploads/') . $this->entity_type . '_' . $this->entity_id . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR . $this->name;
        } else {
            return Yii::getAlias('@image_uploads/') . $this->entity_type . '_' . $this->entity_id . DIRECTORY_SEPARATOR . $this->name;
        }
    }

    public function getUrl($preview = false)
    {
        if ($preview) {
            return Yii::getAlias('@web_image_uploads/' . $this->entity_type . '_' . $this->entity_id . '/thumb/' . $this->name);
        } else {
            return Yii::getAlias('@web_image_uploads/' . $this->entity_type . '_' . $this->entity_id . '/' . $this->name);
        }
    }
}
