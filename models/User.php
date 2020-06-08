<?php

namespace app\models;

use yii\helpers\ArrayHelper;

class User extends \Da\User\Model\User
{
   public static function map()
   {
       return ArrayHelper::map(User::find()->all(), 'id', 'email');
   }
}
