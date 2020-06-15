<?php

namespace app\modules\office\models;

use Yii;

/**
 * This is the model class for table "office_case_employee_rel".
 *
 * @property int|null $case_id
 * @property int|null $employee_id
 *
 * @property OfficeEmployee $employee
 * @property OfficeCase $case
 */
class OfficeCaseEmployeeRel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'office_case_employee_rel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['case_id', 'employee_id'], 'integer'],
            [['case_id', 'employee_id'], 'unique', 'targetAttribute' => ['case_id', 'employee_id']],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => OfficeEmployee::className(), 'targetAttribute' => ['employee_id' => 'id']],
            [['case_id'], 'exist', 'skipOnError' => true, 'targetClass' => OfficeCase::className(), 'targetAttribute' => ['case_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'case_id' => Yii::t('rus', 'Case ID'),
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
     * Gets query for [[Case]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCase()
    {
        return $this->hasOne(OfficeCase::className(), ['id' => 'case_id']);
    }
}
