<?php

namespace app\modules\office\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\validators\DateValidator;

/**
 * This is the model class for table "office_account".
 *
 * @property int $id
 * @property int|null $owner_id
 * @property int|boolean $active
 * @property int|null $active_at
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class OfficeAccount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'office_account';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            BlameableBehavior::className(),
            TimestampBehavior::className(),
            'dateConvert' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [ActiveRecord::EVENT_AFTER_FIND => 'active_at'],
                'value' => function ($event) {return empty($this->active_at) ? null : date('d.m.Y', $this->active_at);},
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()

    {
        return [
            [['owner_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['active'], 'boolean'],
            [['active_at'], 'date', 'type' => DateValidator::TYPE_DATE, 'format' => 'dd.MM.yyyy', 'timestampAttribute' => 'active_at'],
            [['active'], 'default', 'value' => true],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rus', 'ID'),
            'owner_id' => Yii::t('rus', 'Владелец'),
            'active' => Yii::t('rus', 'Активно'),
            'active_at' => Yii::t('rus', 'Активно до'),
            'created_at' => Yii::t('rus', 'Дата создания'),
            'updated_at' => Yii::t('rus', 'Дата обновления'),
            'created_by' => Yii::t('rus', 'Создан'),
            'updated_by' => Yii::t('rus', 'Обновлен'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\office\models\query\OfficeAccountQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\office\models\query\OfficeAccountQuery(get_called_class());
    }
}
