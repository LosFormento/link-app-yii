<?php

namespace frontend\models;

use common\models\User;
use common\models\UserWalletProcessing;
use yii\base\InvalidArgumentException;
use yii\base\Model;

class WalletAddFundsForm extends Model
{
    /**
     * @var string
     */
    public $amount;

    /**
     * @var User
     */
    private $_user;
    public function rules(): array
    {
        return [
            [['amount'], 'required'],
            [['amount'], 'number'],
        ];
    }
    public function process(){
        $newWalletProcessing=new UserWalletProcessing();
        $newWalletProcessing->amount = $this->amount;
        $newWalletProcessing->type = UserWalletProcessing::TYPE_WALLET_ADD_FUNDS;
        if($newWalletProcessing->save()){
            return true;
        }else{
            $this->addError('amount','Ошибка процессинга');
            return false;
        }
    }

}
