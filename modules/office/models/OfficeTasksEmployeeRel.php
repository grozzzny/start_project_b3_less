<?php

namespace app\modules\office\models;

use Yii;

/**
 * This is the model class for table "office_tasks_employee_rel".
 *
 * @property int|null $task_id
 * @property int|null $employee_id
 *
 * @property OfficeEmployee $employee
 * @property OfficeTasks $task
 */
class OfficeTasksEmployeeRel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'office_tasks_employee_rel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'employee_id'], 'integer'],
            [['task_id', 'employee_id'], 'unique', 'targetAttribute' => ['task_id', 'employee_id']],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => OfficeEmployee::className(), 'targetAttribute' => ['employee_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => OfficeTasks::className(), 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'task_id' => Yii::t('rus', 'Task ID'),
            'employee_id' => Yii::t('rus', 'Employee ID'),
        ];
    }

    /**
     * Gets query for [[Employee]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(OfficeEmployee::className(), ['id' => 'employee_id']);
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(OfficeTasks::className(), ['id' => 'task_id']);
    }
}
