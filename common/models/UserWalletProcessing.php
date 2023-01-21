<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_wallet_processing".
 *
 * @property int $id
 * @property int $user_wallet_id
 * @property float $amount
 * @property int $type
 * @property string|null $type_string
 * @property string|null $description
 * @property int|null $status
 * @property string|null $date_created
 * @property string|null $date_payed
 * @property string|null $processing_hash
 */
class UserWalletProcessing extends \yii\db\ActiveRecord
{

    const TYPE_WALLET_ADD_FUNDS = 10;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_wallet_processing';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_wallet_id', 'amount', 'type'], 'required'],
            [['user_wallet_id', 'type', 'status'], 'integer'],
            [['amount'], 'number'],
            [['date_created', 'date_payed'], 'safe'],
            [['type_string', 'description', 'processing_hash'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_wallet_id' => 'User Wallet ID',
            'amount' => 'Amount',
            'type' => 'Type',
            'type_string' => 'Type String',
            'description' => 'Description',
            'status' => 'Status',
            'date_created' => 'Date Created',
            'date_payed' => 'Date Payed',
            'processing_hash' => 'Processing Hash',
        ];
    }
}
