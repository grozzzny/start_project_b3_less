<?php

namespace app\modules\office\models;

use Yii;

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
 */
class OfficeConsultation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'office_consultation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_id', 'client_id', 'cost', 'curator_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['type'], 'string', 'max' => 255],
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
            'client_id' => Yii::t('rus', 'Client ID'),
            'cost' => Yii::t('rus', 'Cost'),
            'type' => Yii::t('rus', 'Type'),
            'curator_id' => Yii::t('rus', 'Curator ID'),
            'created_at' => Yii::t('rus', 'Created At'),
            'updated_at' => Yii::t('rus', 'Updated At'),
            'created_by' => Yii::t('rus', 'Created By'),
            'updated_by' => Yii::t('rus', 'Updated By'),
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

    /**
     * {@inheritdoc}
     * @return \app\modules\office\models\query\OfficeConsultationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\office\models\query\OfficeConsultationQuery(get_called_class());
    }
}
