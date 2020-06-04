<?php

namespace app\modules\office\models;

use Yii;

/**
 * This is the model class for table "office_case".
 *
 * @property int $id
 * @property int|null $account_id
 * @property string|null $number
 * @property int|null $client_id
 * @property string|null $category
 * @property string|null $object_category
 * @property int|null $curator_id
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property OfficeCaseEmployeeRel[] $officeCaseEmployeeRels
 * @property OfficeEmployee[] $employees
 */
class OfficeCase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'office_case';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_id', 'client_id', 'curator_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['number', 'category', 'object_category'], 'string', 'max' => 255],
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
            'number' => Yii::t('rus', 'Number'),
            'client_id' => Yii::t('rus', 'Client ID'),
            'category' => Yii::t('rus', 'Category'),
            'object_category' => Yii::t('rus', 'Object Category'),
            'curator_id' => Yii::t('rus', 'Curator ID'),
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
        return $this->hasMany(OfficeCaseEmployeeRel::className(), ['case_id' => 'id']);
    }

    /**
     * Gets query for [[Employees]].
     *
     * @return \yii\db\ActiveQuery|\app\modules\office\models\query\OfficeEmployeeQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(OfficeEmployee::className(), ['id' => 'employee_id'])->viaTable('office_case_employee_rel', ['case_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\office\models\query\OfficeCaseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\office\models\query\OfficeCaseQuery(get_called_class());
    }
}
