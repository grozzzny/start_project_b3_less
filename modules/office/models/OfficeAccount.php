<?php

namespace app\modules\office\models;

use app\components\BlameableTrait;
use app\models\User;
use app\modules\office\widgets\select2\Select2;
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
 * @property string $name [varchar(255)]
 *
 * @property-read User $owner
 * @property-read OfficeEmployee $createdEmployee
 * @property-read boolean $isActive
 * @property-read string $activeAtFormat
 */
class OfficeAccount extends \yii\db\ActiveRecord
{
    use BlameableTrait;

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
            'set_name' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [ActiveRecord::EVENT_AFTER_INSERT => 'name'],
                'value' => function ($event) {
                    $name = implode(' / ', ['ID'.$this->id, $this->owner->email]);
                    self::updateAll(['name' => $name], ['id' => $this->id]);
                    return $this->name = $name;
                },
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
            [['name'], 'string'],
            [[
                'owner_id',
                'active_at',
            ], 'required'],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rus', 'ID'),
            'name' => Yii::t('rus', 'Наименование'),
            'owner_id' => Yii::t('rus', 'Владелец'),
            'active' => Yii::t('rus', 'Активно'),
            'active_at' => Yii::t('rus', 'Активно до'),
            'created_at' => Yii::t('rus', 'Дата создания'),
            'updated_at' => Yii::t('rus', 'Дата обновления'),
            'created_by' => Yii::t('rus', 'Создан'),
            'updated_by' => Yii::t('rus', 'Обновлен'),
        ];
    }

    public function getOwner()
    {
        return $this->hasOne(User::class, ['id' => 'owner_id']);
    }

    public function getIsActive()
    {
        return $this->active == 1;
    }

    public function getCreatedEmployee()
    {
        return $this->hasOne(OfficeEmployee::class, ['user_id' => 'created_by'])
            ->onCondition(['account_id' => $this->id]);
    }

    public function getActiveAtFormat()
    {
        return $this->active_at;
    }

    public static function select2FilterSettings($model)
    {
        return Select2::widget([
            'model' => $model,
            'attribute' => 'account_id',
            'data' => ArrayHelper::map(OfficeAccount::find()->all(), 'id', 'name'),
            'pluginOptions' => [
                'allowClear' => true,
                'placeholder' => Yii::t('rus', 'Выберите значение'),
            ],
        ]);
    }

    public static function map()
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'name');
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
