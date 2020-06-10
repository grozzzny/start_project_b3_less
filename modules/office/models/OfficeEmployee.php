<?php

namespace app\modules\office\models;

use app\modules\office\components\AccountTrait;
use app\components\BlameableTrait;
use app\models\User;
use app\modules\office\components\EmployeeTrait;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "office_employee".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $account_id
 * @property string|null $role
 * @property int|null $priority
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property OfficeCaseEmployeeRel[] $officeCaseEmployeeRels
 * @property OfficeCase[] $cases
 * @property OfficeConsultationEmployeeRel[] $officeConsultationEmployeeRels
 * @property OfficeConsultation[] $consultations
 * @property OfficeTasksEmployeeRel[] $officeTasksEmployeeRels
 * @property OfficeTasks[] $tasks
 *
 * @property-read string $roleLabel
 * @property string $full_name [varchar(255)]
 * @property User $user
 */
class OfficeEmployee extends \yii\db\ActiveRecord
{
    use EmployeeTrait;
    use AccountTrait;
    use BlameableTrait;

    const ROLE_GUEST = 'guest';
    const ROLE_ASSISTANT = 'assistant';
    const ROLE_LAWYER = 'lawyer';
    const ROLE_PARTNER = 'partner';
    const ROLE_ADMINISTRATOR = 'administrator';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'office_employee';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            BlameableBehavior::className(),
            TimestampBehavior::className(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'account_id', 'priority', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['role', 'full_name'], 'string', 'max' => 255],
            [['user_id', 'account_id'], 'unique', 'targetAttribute' => ['user_id', 'account_id']],
            [[
                'account_id',
                'user_id',
                'role',
                'full_name',
            ], 'required'],
            [['priority'], 'default', 'value' => 0],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rus', 'ID'),
            'user_id' => Yii::t('rus', 'Пользователь'),
            'account_id' => Yii::t('rus', 'Аккаунт'),
            'role' => Yii::t('rus', 'Роль'), // guest assistant lawyer partner administrator
            'priority' => Yii::t('rus', 'Приоритет'),
            'created_at' => Yii::t('rus', 'Дата создания'),
            'updated_at' => Yii::t('rus', 'Дата обновления'),
            'created_by' => Yii::t('rus', 'Создан'),
            'updated_by' => Yii::t('rus', 'Обновлен'),
            'full_name' => Yii::t('rus', 'ФИО'),
        ];
    }

    /**
     * Gets query for [[OfficeCaseEmployeeRels]].
     *
     * @return \yii\db\ActiveQuery|\app\modules\office\models\query\OfficeCaseEmployeeRelQuery
     */
    public function getOfficeCaseEmployeeRels()
    {
        return $this->hasMany(OfficeCaseEmployeeRel::className(), ['employee_id' => 'id']);
    }

    /**
     * Gets query for [[Cases]].
     *
     * @return \yii\db\ActiveQuery|\app\modules\office\models\query\OfficeCaseQuery
     */
    public function getCases()
    {
        return $this->hasMany(OfficeCase::className(), ['id' => 'case_id'])->viaTable('office_case_employee_rel', ['employee_id' => 'id']);
    }

    /**
     * Gets query for [[OfficeConsultationEmployeeRels]].
     *
     * @return \yii\db\ActiveQuery|\app\modules\office\models\query\OfficeConsultationEmployeeRelQuery
     */
    public function getOfficeConsultationEmployeeRels()
    {
        return $this->hasMany(OfficeConsultationEmployeeRel::className(), ['employee_id' => 'id']);
    }

    /**
     * Gets query for [[Consultations]].
     *
     * @return \yii\db\ActiveQuery|\app\modules\office\models\query\OfficeConsultationQuery
     */
    public function getConsultations()
    {
        return $this->hasMany(OfficeConsultation::className(), ['id' => 'consultation_id'])->viaTable('office_consultation_employee_rel', ['employee_id' => 'id']);
    }

    /**
     * Gets query for [[OfficeTasksEmployeeRels]].
     *
     * @return \yii\db\ActiveQuery|\app\modules\office\models\query\OfficeTasksEmployeeRelQuery
     */
    public function getOfficeTasksEmployeeRels()
    {
        return $this->hasMany(OfficeTasksEmployeeRel::className(), ['employee_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery|\app\modules\office\models\query\OfficeTasksQuery
     */
    public function getTasks()
    {
        return $this->hasMany(OfficeTasks::className(), ['id' => 'task_id'])->viaTable('office_tasks_employee_rel', ['employee_id' => 'id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getRoleLabel()
    {
        return ArrayHelper::getValue(static::roles(), $this->role);
    }

    public function getName()
    {
        return empty($this->full_name) ? $this->user->email : $this->full_name;
    }

    public static function roles()
    {
        return [
            self::ROLE_GUEST => Yii::t('rus', 'Гость'),
            self::ROLE_ASSISTANT => Yii::t('rus', 'Помощник'),
            self::ROLE_LAWYER => Yii::t('rus', 'Адвокат'),
            self::ROLE_PARTNER => Yii::t('rus', 'Партнер'),
            self::ROLE_ADMINISTRATOR => Yii::t('rus', 'Администратор'),
        ];
    }

    public static function map($account_id)
    {
        return ArrayHelper::map(self::find()->accaunt($account_id)->all(), 'id', 'name');
    }


    /**
     * {@inheritdoc}
     * @return \app\modules\office\models\query\OfficeEmployeeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\office\models\query\OfficeEmployeeQuery(get_called_class());
    }
}
