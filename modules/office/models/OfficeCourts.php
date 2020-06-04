<?php

namespace app\modules\office\models;

use Yii;

/**
 * This is the model class for table "office_courts".
 *
 * @property int $id
 * @property int|null $account_id
 * @property string|null $name
 * @property string|null $address
 * @property string|null $phone
 */
class OfficeCourts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'office_courts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_id'], 'integer'],
            [['name', 'address', 'phone'], 'string', 'max' => 255],
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
            'name' => Yii::t('rus', 'Name'),
            'address' => Yii::t('rus', 'Address'),
            'phone' => Yii::t('rus', 'Phone'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\office\models\query\OfficeCourtsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\office\models\query\OfficeCourtsQuery(get_called_class());
    }
}
