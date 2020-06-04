<?php

namespace app\modules\office\models;

use Yii;

/**
 * This is the model class for table "office_clients".
 *
 * @property int $id
 * @property int|null $account_id
 * @property string|null $full_name
 * @property string|null $phone
 * @property string|null $date_of_birth
 * @property string|null $place_of_birth
 * @property string|null $place_registration
 * @property string|null $place_residence
 * @property string|null $passport_number
 * @property string|null $passport_date
 * @property string|null $passport_institution
 * @property string|null $passport_photo
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class OfficeClients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'office_clients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['full_name', 'phone', 'date_of_birth', 'place_of_birth', 'place_registration', 'place_residence', 'passport_number', 'passport_date', 'passport_institution', 'passport_photo'], 'string', 'max' => 255],
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
            'full_name' => Yii::t('rus', 'Full Name'),
            'phone' => Yii::t('rus', 'Phone'),
            'date_of_birth' => Yii::t('rus', 'Date Of Birth'),
            'place_of_birth' => Yii::t('rus', 'Place Of Birth'),
            'place_registration' => Yii::t('rus', 'Place Registration'),
            'place_residence' => Yii::t('rus', 'Place Residence'),
            'passport_number' => Yii::t('rus', 'Passport Number'),
            'passport_date' => Yii::t('rus', 'Passport Date'),
            'passport_institution' => Yii::t('rus', 'Passport Institution'),
            'passport_photo' => Yii::t('rus', 'Passport Photo'),
            'created_at' => Yii::t('rus', 'Created At'),
            'updated_at' => Yii::t('rus', 'Updated At'),
            'created_by' => Yii::t('rus', 'Created By'),
            'updated_by' => Yii::t('rus', 'Updated By'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\office\models\query\OfficeClientsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\office\models\query\OfficeClientsQuery(get_called_class());
    }
}
