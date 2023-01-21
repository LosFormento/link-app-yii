<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_soc_auth".
 *
 * @property int $id
 * @property int $user_id
 * @property string $service_type
 * @property string $service_id
 * @property string|null $date_created
 * @property string|null $date_last_login
 */
class UserSocAuth extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_soc_auth';
    }

    const SERVICE_ESOL='esoligorsk';


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'service_type', 'service_id'], 'required'],
            [['user_id'], 'integer'],
            [['date_created', 'date_last_login'], 'safe'],
            [['service_type', 'service_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'service_type' => 'Service Type',
            'service_id' => 'Service ID',
            'date_created' => 'Date Created',
            'date_last_login' => 'Date Last Login',
        ];
    }
}
