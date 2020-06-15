<?php

namespace app\modules\office\models;

use Yii;

/**
 * This is the model class for table "office_consultation_employee_rel".
 *
 * @property int|null $consultation_id
 * @property int|null $employee_id
 *
 * @property OfficeEmployee $employee
 * @property OfficeConsultation $consultation
 */
class OfficeConsultationEmployeeRel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'office_consultation_employee_rel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['consultation_id', 'employee_id'], 'integer'],
            [['consultation_id', 'employee_id'], 'unique', 'targetAttribute' => ['consultation_id', 'employee_id']],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => OfficeEmployee::className(), 'targetAttribute' => ['employee_id' => 'id']],
            [['consultation_id'], 'exist', 'skipOnError' => true, 'targetClass' => OfficeConsultation::className(), 'targetAttribute' => ['consultation_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'consultation_id' => Yii::t('rus', 'Consultation ID'),
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
     * Gets query for [[Consultation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConsultation()
    {
        return $this->hasOne(OfficeConsultation::className(), ['id' => 'consultation_id']);
    }
}
