<?php

namespace app\modules\office\models;

use Yii;

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
 */
class OfficeTasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'office_tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_id', 'curator_id', 'case_id', 'client_id', 'time_to', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['description'], 'string'],
            [['type_priority'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rus', 'ID'),
            'account_id' => Yii::t('rus', 'Account ID'),
            'curator_id' => Yii::t('rus', 'Curator ID'),
            'case_id' => Yii::t('rus', 'Case ID'),
            'client_id' => Yii::t('rus', 'Client ID'),
            'description' => Yii::t('rus', 'Description'),
            'time_to' => Yii::t('rus', 'Time To'),
            'type_priority' => Yii::t('rus', 'Type Priority'),
            'created_at' => Yii::t('rus', 'Created At'),
            'updated_at' => Yii::t('rus', 'Updated At'),
            'created_by' => Yii::t('rus', 'Created By'),
            'updated_by' => Yii::t('rus', 'Updated By'),
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

    /**
     * {@inheritdoc}
     * @return \app\modules\office\models\query\OfficeTasksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\office\models\query\OfficeTasksQuery(get_called_class());
    }
}