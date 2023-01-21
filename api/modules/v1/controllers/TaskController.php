<?php

namespace api\modules\v1\controllers;

use common\models\Entity;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;

/**
 * Country Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class TaskController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Entity';



}


