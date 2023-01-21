<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_wallet".
 *
 * @property int $user_id
 * @property float|null $balance
 */
class UserWallet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_wallet';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['balance'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'balance' => 'Balance',
        ];
    }
    public function addFunds(float $amount, string $description){
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        try {
            $newTransaction = new UserWalletTransaction();
            $newTransaction->user_wallet_id = $this->user_id;
            $newTransaction->amount = $amount;
            $newTransaction->description = $description;
            $newTransaction->type = UserWalletTransaction::TYPE_ADD;
            $newTransaction->is_income = 1;
            $newTransaction->user_id = Yii::$app->user->id;
            $newTransaction->save(false);
            $this->balance += $amount;
            $this->save(false);
            $transaction->commit();
        }catch(\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }

    }

}
