<?php

namespace app\modules\office\models;

use Yii;

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
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'office_employee';
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
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rus', 'ID'),
            'user_id' => Yii::t('rus', 'User ID'),
            'account_id' => Yii::t('rus', 'Account ID'),
            'role' => Yii::t('rus', 'Role'),
            'priority' => Yii::t('rus', 'Priority'),
            'created_at' => Yii::t('rus', 'Created At'),
            'updated_at' => Yii::t('rus', 'Updated At'),
            'created_by' => Yii::t('rus', 'Created By'),
            'updated_by' => Yii::t('rus', 'Updated By'),
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

    /**
     * {@inheritdoc}
     * @return \app\modules\office\models\query\OfficeEmployeeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\office\models\query\OfficeEmployeeQuery(get_called_class());
    }
}
