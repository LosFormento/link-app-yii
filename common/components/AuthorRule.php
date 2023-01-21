<?php
namespace common\components;
use common\models\Entity;
use yii\rbac\Rule;
/*
 *  Class AuthorRule.
 *  @package app\rbac
 */
class AuthorRule extends Rule {
    public $name = 'isAuthor';
    /*
     * @param int|string $user_id
     * @param \yii\rbac\Item $item
     * @param array $params
     *
     * @return bool
     */
    public function execute($user_id, $item, $params){
        return isset($params['user_id']) ? $params['user_id'] == $user_id : false;
    }
}