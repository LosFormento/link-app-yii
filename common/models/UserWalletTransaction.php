<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_wallet_transactions".
 *
 * @property int $id
 * @property int $user_wallet_id
 * @property float $amount
 * @property int $type
 * @property int|null $is_income
 * @property string|null $description
 * @property string|null $date_created
 */
class UserWalletTransaction extends \yii\db\ActiveRecord
{
    const TYPE_ADD = 10;
    const TYPE_WITHDRAW = 20;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_wallet_transaction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_wallet_id', 'amount', 'type'], 'required'],
            [['user_wallet_id', 'type', 'is_income'], 'integer'],
            [['amount'], 'number'],
            [['date_created'], 'safe'],
            [['description'], 'string', 'max' => 255],
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
            'is_income' => 'Is Income',
            'description' => 'Description',
            'date_created' => 'Date Created',
        ];
    }
}
