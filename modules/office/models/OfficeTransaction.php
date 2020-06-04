<?php

namespace app\modules\office\models;

use Yii;

/**
 * This is the model class for table "office_transaction".
 *
 * @property int $id
 * @property int|null $cost
 * @property string|null $type
 * @property string|null $note
 * @property int|null $consultation_id
 * @property int|null $case_id
 * @property int|null $client_id
 * @property int|null $is_account
 * @property string|null $employee_id
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $account_id
 */
class OfficeTransaction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'office_transaction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cost', 'consultation_id', 'case_id', 'client_id', 'is_account', 'created_at', 'updated_at', 'created_by', 'updated_by', 'account_id'], 'integer'],
            [['type', 'note', 'employee_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rus', 'ID'),
            'cost' => Yii::t('rus', 'Cost'),
            'type' => Yii::t('rus', 'Type'),
            'note' => Yii::t('rus', 'Note'),
            'consultation_id' => Yii::t('rus', 'Consultation ID'),
            'case_id' => Yii::t('rus', 'Case ID'),
            'client_id' => Yii::t('rus', 'Client ID'),
            'is_account' => Yii::t('rus', 'Is Account'),
            'employee_id' => Yii::t('rus', 'Employee ID'),
            'created_at' => Yii::t('rus', 'Created At'),
            'updated_at' => Yii::t('rus', 'Updated At'),
            'created_by' => Yii::t('rus', 'Created By'),
            'updated_by' => Yii::t('rus', 'Updated By'),
            'account_id' => Yii::t('rus', 'Account ID'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\office\models\query\OfficeTransactionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\office\models\query\OfficeTransactionQuery(get_called_class());
    }
}
