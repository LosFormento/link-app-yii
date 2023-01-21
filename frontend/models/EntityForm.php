<?php

namespace frontend\models;

use common\models\Entity;
use common\models\Category;
class EntityForm extends Entity
{
    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['category_id','title','body'], 'required'],
            [['category_id','geoZoom'], 'integer'],
            [['body'], 'string'],
            [['geoLat','geoLng'],'number'],
            [['title'],'string', 'max' => 255],
            [['images'],'file','maxFiles' => 4, 'extensions' => "jpg, png, jpeg",'maxSize' => 5120000,],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Категория',
            'title' => 'Заголовок',
            'body' => 'Текст задания',
            'images'=>'Изображения и Фото',
            'price'=>'Цена'
        ];
    }
}
