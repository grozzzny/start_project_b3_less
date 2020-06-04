<?php

namespace app\modules\office\models;

use Yii;

/**
 * This is the model class for table "office_session".
 *
 * @property int $id
 * @property int|null $account_id
 * @property int|null $case_id
 * @property int|null $client_id
 * @property int|null $datetime_act
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class OfficeSession extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'office_session';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_id', 'case_id', 'client_id', 'datetime_act', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
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
            'datetime_act' => Yii::t('rus', 'Datetime Act'),
            'created_at' => Yii::t('rus', 'Created At'),
            'updated_at' => Yii::t('rus', 'Updated At'),
            'created_by' => Yii::t('rus', 'Created By'),
            'updated_by' => Yii::t('rus', 'Updated By'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\office\models\query\OfficeSessionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\office\models\query\OfficeSessionQuery(get_called_class());
    }
}
