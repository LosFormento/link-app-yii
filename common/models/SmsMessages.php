<?php

namespace common\models;

use common\components\SmsProvider;
use Yii;

/**
 * This is the model class for table "sms_messages".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $type
 * @property string $phone
 * @property int $code
 * @property string $hash
 * @property string|null $message
 * @property string|null $ip
 * @property string|null $date_created
 * @property string|null $date_updated
 * @property int|null $success
 * @property int $status
 */
class SmsMessages extends \yii\db\ActiveRecord
{

    const REGISTRATION = 1;
    const LOGIN = 2;
    const STATUS_ACTIVE = 1;
    const STATUS_NOT_ACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sms_messages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'code', 'success','type','status'], 'integer'],
            [['type', 'phone', 'code', 'hash'], 'required'],
            [['message','data'], 'string'],
            [['date_created', 'date_updated'], 'safe'],
            [['phone', 'hash','ip','useragent_hash'], 'string', 'max' => 255],
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
            'type' => 'Type',
            'phone' => 'Phone',
            'code' => 'Code',
            'hash' => 'Hash',
            'message' => 'Message',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'success' => 'Success',
        ];
    }

    public function send(){
        if(SmsProvider::sendSms($this->phone,$this->message)){
            $this->success = 1;
            $this->save();
            return true;
        }else{
            return false;
        }
    }
}
