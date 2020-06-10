<?php

namespace app\modules\office\models;

use app\modules\office\components\AccountTrait;
use app\components\BlameableTrait;
use app\modules\office\components\EmployeeTrait;
use grozzzny\admin\widgets\file_input\components\FileBehavior;
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
 * @property string $passport_code [varchar(255)]
 */
class OfficeClients extends \yii\db\ActiveRecord
{
    use EmployeeTrait;
    use AccountTrait;
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
            'image' => [
                'class' => FileBehavior::className(),
                'fileAttribute' => 'passport_photo',
                'uploadPath' => '/uploads/passport_photo',
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['passport_code'], 'string'],
            [['passport_photo'], 'image'],
            [['date_of_birth', 'passport_date'], 'date', 'format' => 'dd.MM.yyyy'],
            [['full_name', 'phone', 'place_of_birth', 'place_registration', 'place_residence', 'passport_number', 'passport_institution'], 'string', 'max' => 255],
            [[
                'account_id',
                'full_name',
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
            'full_name' => Yii::t('rus', 'ФИО'),
            'phone' => Yii::t('rus', 'Телефон'),
            'date_of_birth' => Yii::t('rus', 'Дата рождения'),
            'place_of_birth' => Yii::t('rus', 'Место рождения'),
            'place_registration' => Yii::t('rus', 'Место регистрации'),
            'place_residence' => Yii::t('rus', 'Место жительства'),
            'passport_number' => Yii::t('rus', 'Серия и номер паспорта'),
            'passport_date' => Yii::t('rus', 'Дата выдачи паспорта'),
            'passport_code' => Yii::t('rus', 'Код подразделения'),
            'passport_institution' => Yii::t('rus', 'Орган выдачи паспорта'),
            'passport_photo' => Yii::t('rus', 'Фото паспорта'),
            'created_at' => Yii::t('rus', 'Дата создания'),
            'updated_at' => Yii::t('rus', 'Дата обновления'),
            'created_by' => Yii::t('rus', 'Создан'),
            'updated_by' => Yii::t('rus', 'Обновлен'),
        ];
    }

    public static function map($account_id)
    {
        return ArrayHelper::map(self::find()->accaunt($account_id)->all(), 'id', 'full_name');
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
