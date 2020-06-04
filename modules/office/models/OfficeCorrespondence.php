<?php

namespace app\modules\office\models;

use Yii;

/**
 * This is the model class for table "office_correspondence".
 *
 * @property int $id
 * @property int|null $account_id
 * @property int|null $case_id
 * @property int|null $client_id
 * @property int|null $employee_id
 * @property string|null $sender
 * @property string|null $recipient
 * @property string|null $description
 * @property string|null $mail_number
 * @property int|null $cost
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class OfficeCorrespondence extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'office_correspondence';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_id', 'case_id', 'client_id', 'employee_id', 'cost', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['sender', 'recipient', 'description', 'mail_number'], 'string', 'max' => 255],
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
            'case_id' => Yii::t('rus', 'Case ID'),
            'client_id' => Yii::t('rus', 'Client ID'),
            'employee_id' => Yii::t('rus', 'Employee ID'),
            'sender' => Yii::t('rus', 'Sender'),
            'recipient' => Yii::t('rus', 'Recipient'),
            'description' => Yii::t('rus', 'Description'),
            'mail_number' => Yii::t('rus', 'Mail Number'),
            'cost' => Yii::t('rus', 'Cost'),
            'created_at' => Yii::t('rus', 'Created At'),
            'updated_at' => Yii::t('rus', 'Updated At'),
            'created_by' => Yii::t('rus', 'Created By'),
            'updated_by' => Yii::t('rus', 'Updated By'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\office\models\query\OfficeCorrespondenceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\office\models\query\OfficeCorrespondenceQuery(get_called_class());
    }
}
