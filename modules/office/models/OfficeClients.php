<?php

namespace app\modules\office\models;

use app\components\BlameableTrait;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

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
    use BlameableTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'office_clients';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            BlameableBehavior::className(),
            TimestampBehavior::className(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['date_of_birth', 'passport_date'], 'date', 'format' => 'dd.MM.yyyy'],
            [['full_name', 'phone', 'place_of_birth', 'place_registration', 'place_residence', 'passport_number', 'passport_institution', 'passport_photo'], 'string', 'max' => 255],
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
            'full_name' => Yii::t('rus', 'ФИО'),
            'phone' => Yii::t('rus', 'Телефон'),
            'date_of_birth' => Yii::t('rus', 'Дата рождения'),
            'place_of_birth' => Yii::t('rus', 'Место рождения'),
            'place_registration' => Yii::t('rus', 'Место регистрации'),
            'place_residence' => Yii::t('rus', 'Место жительства'),
            'passport_number' => Yii::t('rus', 'Серия и номер паспорта'),
            'passport_date' => Yii::t('rus', 'Дата выдачи паспорта'),
            'passport_institution' => Yii::t('rus', 'Орган выдачи паспорта'),
            'passport_photo' => Yii::t('rus', 'Фото паспорта'),
            'created_at' => Yii::t('rus', 'Дата создания'),
            'updated_at' => Yii::t('rus', 'Дата обновления'),
            'created_by' => Yii::t('rus', 'Создан'),
            'updated_by' => Yii::t('rus', 'Обновлен'),
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
