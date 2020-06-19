<?php

namespace app\models;

use kartik\select2\Select2;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class User
 * @package app\models
 * @property-read Teames $team
 */
class User extends \Da\User\Model\User
{

    public function getTeam()
    {
        return $this->hasOne(Teames::class, ['owner_id' => 'id']);
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
