<?php

namespace app\modules\office\models;

use app\components\AccountTrait;
use app\components\BlameableTrait;
use app\models\User;
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
 */
class OfficeEmployee extends \yii\db\ActiveRecord
{
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
            [['role'], 'string', 'max' => 255],
            [['user_id', 'account_id'], 'unique', 'targetAttribute' => ['user_id', 'account_id']],
            [[
                'account_id',
                'user_id',
                'role',
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

    public static function map()
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'user.email');
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
