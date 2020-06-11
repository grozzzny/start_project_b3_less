<?php

namespace app\modules\office\models;

use app\modules\office\components\AccountTrait;
use app\components\BlameableTrait;
use app\modules\office\components\ClientsBehavior;
use app\modules\office\components\EmployeeTrait;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

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
 * @property string $relation [varchar(255)]
 * @property int $consultation_id [int(11)]
 *
 * @property-read OfficeCase $case
 * @property-read OfficeConsultation $consultation
 * @property-read OfficeClients $client
 * @property-read OfficeEmployee $employee
 */
class OfficeCorrespondence extends \yii\db\ActiveRecord implements RelationsInterface
{
    use EmployeeTrait;
    use AccountTrait;
    use BlameableTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'office_correspondence';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            BlameableBehavior::className(),
            TimestampBehavior::className(),
            'client_id' => [
                'class' => ClientsBehavior::class,
                'relations' => [
                    'case',
                    'consultation',
                ]
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_id', 'case_id', 'client_id', 'employee_id', 'cost', 'created_at', 'updated_at', 'created_by', 'updated_by', 'consultation_id'], 'integer'],
            [['sender', 'recipient', 'description', 'mail_number', 'relation'], 'string', 'max' => 255],
            [[
                'relation',
                'account_id',
                'employee_id',
            ], 'required'],
            [['case_id'],
                'required',
                'when' => Relation::when(Relation::RELATION_CASE),
                'whenClient' => Relation::whenClient($this, Relation::RELATION_CASE)
            ],
            [['consultation_id'],
                'required',
                'when' => Relation::when(Relation::RELATION_CONSULTATION),
                'whenClient' => Relation::whenClient($this, Relation::RELATION_CONSULTATION)
            ],
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
            'case_id' => Yii::t('rus', 'Дело'),
            'client_id' => Yii::t('rus', 'Клиент'),
            'relation' => Yii::t('rus', 'Отношение'),
            'employee_id' => Yii::t('rus', 'Сотрудник'),
            'sender' => Yii::t('rus', 'Отправитель'),
            'recipient' => Yii::t('rus', 'Получатель'),
            'consultation_id' => Yii::t('rus', 'Консультация'),
            'description' => Yii::t('rus', 'Краткое содержание'),
            'mail_number' => Yii::t('rus', 'Почтовый идентификатор'),
            'cost' => Yii::t('rus', 'Сумма'),
            'created_at' => Yii::t('rus', 'Дата создания'),
            'updated_at' => Yii::t('rus', 'Дата обновления'),
            'created_by' => Yii::t('rus', 'Создан'),
            'updated_by' => Yii::t('rus', 'Обновлен'),
        ];
    }

    public function getCase()
    {
        return $this->hasOne(OfficeCase::class, ['id' => 'case_id']);
    }

    public function getConsultation()
    {
        return $this->hasOne(OfficeConsultation::class, ['id' => 'consultation_id']);
    }

    public function getClient()
    {
        return $this->hasOne(OfficeClients::class, ['id' => 'client_id']);
    }

    public function getEmployee()
    {
        return $this->hasOne(OfficeEmployee::class, ['id' => 'employee_id']);
    }

    public static function relations()
    {
        return [
            Relation::RELATION_CASE => Relation::label(Relation::RELATION_CASE),
            Relation::RELATION_CONSULTATION => Relation::label(Relation::RELATION_CONSULTATION),
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
