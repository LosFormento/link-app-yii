<?php
namespace api\modules\v1\models;
use common\models\Category;
use api\modules\v1\models\User;
use \yii\db\ActiveRecord;
/**
 * Country Model
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class Entity extends \common\models\Entity
{

    public function fields()
    {
        return [
            'id',
            'title',
            'date_updated',
            'category'=>function ($model) {
                return [
                    'id'=>$model->category->id,
                    'name'=>$model->category->name
                ];
            }
        ];
    }


}
