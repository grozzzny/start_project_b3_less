<?php

namespace app\models;

use app\modules\office\models\OfficeAccount;
use app\modules\office\models\OfficeEmployee;
use app\modules\office\widgets\select2\Select2;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class User
 * @package app\models
 *
 * @property-read OfficeAccount $officeAccount
 * @property-read OfficeEmployee[] $officeEmployees
 */
class User extends \Da\User\Model\User
{
    public function getOfficeAccount()
    {
        return $this->hasOne(OfficeAccount::class, ['owner_id' => 'id']);
    }

    public function getOfficeEmployees()
    {
        return $this->hasMany(OfficeEmployee::class, ['user_id' => 'id']);
    }

    public static function map()
    {
        return ArrayHelper::map(User::find()->all(), 'id', 'email');
    }

    public static function select2CreatedBy($model)
    {
        return Select2::widget([
            'model' => $model,
            'attribute' => 'created_by',
            'data' => ArrayHelper::map(self::find()->all(), 'id', 'email'),
            'pluginOptions' => [
                'allowClear' => true,
                'placeholder' => Yii::t('rus', 'Выберите значение'),
            ],
        ]);
    }
}
