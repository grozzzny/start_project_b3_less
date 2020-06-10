<?php

namespace app\modules\office\models;

use app\modules\office\components\AccountTrait;
use app\components\BlameableTrait;
use app\modules\office\components\EmployeeTrait;
use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "office_tasks".
 *
 * @property int $id
 * @property int|null $account_id
 * @property int|null $curator_id
 * @property int|null $case_id
 * @property int|null $client_id
 * @property string|null $description
 * @property int|null $time_to
 * @property string|null $type_priority
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property OfficeTasksEmployeeRel[] $officeTasksEmployeeRels
 * @property OfficeEmployee[] $employees
 * @property string $relation [varchar(255)]
 * @property int $consultation_id [int(11)]
 */
class OfficeTasks extends \yii\db\ActiveRecord implements RelationsInterface
{
    use EmployeeTrait;
    use AccountTrait;
    use BlameableTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'office_tasks';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            BlameableBehavior::className(),
            TimestampBehavior::className(),
            'datetimeConvert' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [ActiveRecord::EVENT_AFTER_FIND => 'time_to'],
                'value' => function ($event) {return empty($this->time_to) ? null : date('d.m.Y H:i', $this->time_to);},
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_id', 'curator_id', 'case_id', 'client_id', 'time_to', 'created_at', 'updated_at', 'created_by', 'updated_by', 'consultation_id'], 'integer'],
            [['description', 'relation'], 'string'],
            [['type_priority'], 'string', 'max' => 255],
            [['time_to'], 'datetime', 'format' => 'dd.MM.yyyy HH:mm', 'timestampAttribute' => 'datetime'],
            [['time_to'], 'default', 'value' => null],
            [[
                'account_id',
                'relation',
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
            'account_id' => Yii::t('rus', 'Аккаунт'),
            'curator_id' => Yii::t('rus', 'Куратор'),
            'case_id' => Yii::t('rus', 'Дело'),
            'consultation_id' => Yii::t('rus', 'Консультация'),
            'client_id' => Yii::t('rus', 'Клиент'),
            'description' => Yii::t('rus', 'Описание'),
            'time_to' => Yii::t('rus', 'Срок задачи'),
            'type_priority' => Yii::t('rus', 'Приоритет задачи'), // current important urgent
            'created_at' => Yii::t('rus', 'Дата создания'),
            'updated_at' => Yii::t('rus', 'Дата обновления'),
            'created_by' => Yii::t('rus', 'Создан'),
            'updated_by' => Yii::t('rus', 'Обновлен'),
        ];
    }

    /**
     * Gets query for [[OfficeTasksEmployeeRels]].
     *
     * @return \yii\db\ActiveQuery|\app\modules\office\models\query\OfficeTasksEmployeeRelQuery
     */
    public function getOfficeTasksEmployeeRels()
    {
        return $this->hasMany(OfficeTasksEmployeeRel::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Employees]].
     *
     * @return \yii\db\ActiveQuery|\app\modules\office\models\query\OfficeEmployeeQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(OfficeEmployee::className(), ['id' => 'employee_id'])->viaTable('office_tasks_employee_rel', ['task_id' => 'id']);
    }

    public static function relations()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\office\models\query\OfficeTasksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\office\models\query\OfficeTasksQuery(get_called_class());
    }
}
