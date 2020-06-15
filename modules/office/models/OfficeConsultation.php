<?php

namespace app\modules\office\models;

use app\components\RelationIdsBehavior;
use app\modules\office\components\AccountTrait;
use app\components\BlameableTrait;
use app\modules\office\components\EmployeeTrait;
use app\modules\office\widgets\select2\Select2;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "office_consultation".
 *
 * @property int $id
 * @property int|null $account_id
 * @property int|null $client_id
 * @property int|null $cost
 * @property string|null $type
 * @property int|null $curator_id
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property OfficeConsultationEmployeeRel[] $officeConsultationEmployeeRels
 * @property OfficeEmployee[] $employees
 * @property-read OfficeClients $client
 * @property-read string $name
 * @property-read string $typeLabel
 */
class OfficeConsultation extends \yii\db\ActiveRecord
{
    use EmployeeTrait;
    use AccountTrait;
    use BlameableTrait;

    const TYPE_ORAL  = 'oral';
    const TYPE_WRITTEN = 'written';

    public $employees_ids = [];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'office_consultation';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            BlameableBehavior::className(),
            TimestampBehavior::className(),
            'employees_ids' => [
                'class' => RelationIdsBehavior::class,
                'relationName' => 'employees',
                'attribute' => 'employees_ids',
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_id', 'client_id', 'cost', 'curator_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['type'], 'string', 'max' => 255],
            [[
                'client_id',
                'cost',
                'type',
                'account_id',
                'employees_ids',
            ], 'required'],
            [['employees_ids'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rus', 'ID'),
            'account_id' => Yii::t('rus', 'Аккаунт'),
            'client_id' => Yii::t('rus', 'Клиент'),
            'cost' => Yii::t('rus', 'Сумма'),
            'type' => Yii::t('rus', 'Тип'), // Тип консультации: oral written
            'curator_id' => Yii::t('rus', 'Куратор'),
            'created_at' => Yii::t('rus', 'Дата создания'),
            'updated_at' => Yii::t('rus', 'Дата обновления'),
            'created_by' => Yii::t('rus', 'Создан'),
            'updated_by' => Yii::t('rus', 'Обновлен'),
            'employees_ids' => Yii::t('rus', 'Исполнители'),
        ];
    }

    /**
     * Gets query for [[OfficeConsultationEmployeeRels]].
     *
     * @return \yii\db\ActiveQuery|\app\modules\office\models\query\OfficeConsultationEmployeeRelQuery
     */
    public function getOfficeConsultationEmployeeRels()
    {
        return $this->hasMany(OfficeConsultationEmployeeRel::className(), ['consultation_id' => 'id']);
    }

    /**
     * Gets query for [[Employees]].
     *
     * @return \yii\db\ActiveQuery|\app\modules\office\models\query\OfficeEmployeeQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(OfficeEmployee::className(), ['id' => 'employee_id'])->viaTable('office_consultation_employee_rel', ['consultation_id' => 'id']);
    }

    public function getClient()
    {
        return $this->hasOne(OfficeClients::class, ['id' => 'client_id']);
    }

    public function getName()
    {
        return implode(' / ', [
            $this->client->full_name,
            $this->cost,
            $this->typeLabel
        ]);
    }

    public static function select2Filter($model)
    {
        return Select2::widget([
            'model' => $model,
            'attribute' => 'consultation_id',
            'data' => ArrayHelper::map(OfficeConsultation::find()->all(), 'id', 'name'),
            'pluginOptions' => [
                'allowClear' => true,
                'placeholder' => Yii::t('rus', 'Выберите значение'),
            ],
        ]);
    }

    public static function map($account_id)
    {
        return ArrayHelper::map(self::find()->accaunt($account_id)->all(), 'id', 'name');
    }

    public function getTypeLabel()
    {
        return ArrayHelper::getValue(self::types(), $this->type);
    }

    public static function types()
    {
        return [
            self::TYPE_ORAL => Yii::t('rus', 'Устная'),
            self::TYPE_WRITTEN => Yii::t('rus', 'Письменная'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\office\models\query\OfficeConsultationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\office\models\query\OfficeConsultationQuery(get_called_class());
    }
}
