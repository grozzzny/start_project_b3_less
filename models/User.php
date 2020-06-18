<?php

namespace app\models;

use kartik\select2\Select2;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class User
 * @package app\models
 *
 */
class User extends \Da\User\Model\User
{

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
