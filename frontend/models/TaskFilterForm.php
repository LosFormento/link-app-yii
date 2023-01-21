<?php

namespace frontend\models;

use app\models\Task;
use Yii;
use yii\base\Model;

/**
 * TaskFilterForm is the model behind the task filter main page form.
 */
class TaskFilterForm extends Model
{
    public $category_id;
    public $order;
    public $flags;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            //[['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['category_id', 'integer'],
            ['flags','safe']
            // verifyCode needs to be entered correctly
            //['verifyCode', 'captcha'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
           // 'verifyCode' => 'Verification Code',
        ];
    }


    public function getTasks(){


        return Task::find()->where([
            'category_id'=>$this->category_id,

        ])->orderBy(['date_updated'])->all();

    }

}
