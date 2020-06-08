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
            'cost' => Yii::t('rus', 'Сумма'),
            'type' => Yii::t('rus', 'Тип транзакции'), // Пополнение, списание
            'note' => Yii::t('rus', 'Примечание'),
            'consultation_id' => Yii::t('rus', 'Консультация'),
            'case_id' => Yii::t('rus', 'Дело'),
            'client_id' => Yii::t('rus', 'Клиент'),
            'is_account' => Yii::t('rus', 'Списание в пользу общего счета'),
            'employee_id' => Yii::t('rus', 'Сотрудник'),
            'created_at' => Yii::t('rus', 'Дата создания'),
            'updated_at' => Yii::t('rus', 'Дата обновления'),
            'created_by' => Yii::t('rus', 'Создан'),
            'updated_by' => Yii::t('rus', 'Обновлен'),
            'account_id' => Yii::t('rus', 'Аккаунт'),
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
