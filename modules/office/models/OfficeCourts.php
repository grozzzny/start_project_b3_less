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
            [[
                'account_id',
            ], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rus', 'ID'),
            'account_id' => Yii::t('rus', 'Аккаунт'),
            'name' => Yii::t('rus', 'Наименование'),
            'address' => Yii::t('rus', 'Адрес'),
            'phone' => Yii::t('rus', 'Телефон'),
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
