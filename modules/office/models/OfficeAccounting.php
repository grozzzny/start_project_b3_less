<?php

namespace app\modules\office\models;

use Yii;

/**
 * This is the model class for table "office_accounting".
 *
 * @property int $id
 * @property int|null $cost
 * @property string|null $type
 * @property string|null $note
 * @property string|null $target
 * @property int|null $transaction_id
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $account_id
 */
class OfficeAccounting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'office_accounting';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cost', 'transaction_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'account_id'], 'integer'],
            [['type', 'note', 'target'], 'string', 'max' => 255],
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
            'target' => Yii::t('rus', 'Target'),
            'transaction_id' => Yii::t('rus', 'Transaction ID'),
            'created_at' => Yii::t('rus', 'Created At'),
            'updated_at' => Yii::t('rus', 'Updated At'),
            'created_by' => Yii::t('rus', 'Created By'),
            'updated_by' => Yii::t('rus', 'Updated By'),
            'account_id' => Yii::t('rus', 'Account ID'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\office\models\query\OfficeAccountingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\office\models\query\OfficeAccountingQuery(get_called_class());
    }
}
