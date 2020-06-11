<?php

namespace app\modules\office\models;

use app\modules\office\components\AccountTrait;
use app\components\BlameableTrait;
use app\modules\office\components\ClientsBehavior;
use app\modules\office\components\EmployeeTrait;
use app\modules\office\components\FileBehavior;
use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * This is the model class for table "office_documents".
 *
 * @property int $id
 * @property int|null $account_id
 * @property int|null $case_id
 * @property int|null $client_id
 * @property string|null $category
 * @property int|null $datetime_act
 * @property string|null $category_act
 * @property string|null $name
 * @property string|null $file
 * @property string|null $note
 * @property int|null $court_id
 * @property int|null $term_appeal
 * @property string|null $result
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
 */
class OfficeDocuments extends \yii\db\ActiveRecord implements RelationsInterface
{
    use EmployeeTrait;
    use AccountTrait;
    use BlameableTrait;

    const CATEGORY_CURRENT = 'current';
    const CATEGORY_JUDICIAL_ACT = 'judicial_act';
    const CATEGORY_DOCUMENTS = 'documents';

    const CATEGORY_ACT_SOLUTIONS = 'solutions';
    const CATEGORY_ACT_SENTENCES = 'sentences';
    const CATEGORY_ACT_RESOLUTIONS = 'resolutions';
    const CATEGORY_ACT_ORDERS = 'orders';
    const CATEGORY_ACT_DEFINITIONS = 'definitions';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'office_documents';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            BlameableBehavior::className(),
            TimestampBehavior::className(),
            'datetimeActConvert' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [ActiveRecord::EVENT_AFTER_FIND => 'datetime_act'],
                'value' => function ($event) {return empty($this->datetime_act) ? null : date('d.m.Y H:i', $this->datetime_act);},
            ],
            'termAppealConvert' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [ActiveRecord::EVENT_AFTER_FIND => 'term_appeal'],
                'value' => function ($event) {return empty($this->term_appeal) ? null : date('d.m.Y H:i', $this->term_appeal);},
            ],
            'file' => [
                'class' => FileBehavior::className(),
                'fileAttribute' => 'file',
                'root' => '@app',
                'uploadPath' => '/store/{account_id}/documents',
            ],
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
            [['account_id', 'case_id', 'client_id', 'court_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'consultation_id'], 'integer'],
            [['file'], 'file', 'extensions' => ['pdf']],
            [['datetime_act'], 'datetime', 'format' => 'dd.MM.yyyy HH:mm', 'timestampAttribute' => 'datetime_act'],
            [['term_appeal'], 'datetime', 'format' => 'dd.MM.yyyy HH:mm', 'timestampAttribute' => 'term_appeal'],
            [['category', 'category_act', 'name', 'note', 'result', 'relation'], 'string', 'max' => 255],
            [[
                'relation',
                'account_id',
                'name',
            ], 'required'],
            [[
                'datetime_act',
                'court_id',
                'category_act',
            ], 'required', 'when' => function($model) {
                /** @var self $model */
                return $model->category == self::CATEGORY_JUDICIAL_ACT;
            }, 'whenClient' => "function (attribute, value) { return $('#".Html::getInputId($this, 'category')."').val() == '".self::CATEGORY_JUDICIAL_ACT."'; }"],
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
            'relation' => Yii::t('rus', 'Отношение'),
            'client_id' => Yii::t('rus', 'Клиент'),
            'category' => Yii::t('rus', 'Категория'),
            'consultation_id' => Yii::t('rus', 'Консультация'),
            'datetime_act' => Yii::t('rus', 'Дата судебного акта'),
            'category_act' => Yii::t('rus', 'Категория акта'),
            'name' => Yii::t('rus', 'Наименование'),
            'file' => Yii::t('rus', 'Файл pdf'),
            'note' => Yii::t('rus', 'Примечание'),
            'court_id' => Yii::t('rus', 'Суд'),
            'term_appeal' => Yii::t('rus', 'Срок обжалования'),
            'result' => Yii::t('rus', 'Результат'),
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

    public static function map($account_id)
    {
        return ArrayHelper::map(self::find()->accaunt($account_id)->all(), 'id', 'name');
    }

    public static function relations()
    {
        return [
            Relation::RELATION_CASE => Relation::label(Relation::RELATION_CASE),
            Relation::RELATION_CONSULTATION => Relation::label(Relation::RELATION_CONSULTATION),
        ];
    }

    public static function categories()
    {
        return [
            static::CATEGORY_CURRENT => Yii::t('rus', 'Текущие'),
            static::CATEGORY_DOCUMENTS => Yii::t('rus', 'Документы'),
            static::CATEGORY_JUDICIAL_ACT => Yii::t('rus', 'Судебный акт'),
        ];
    }

    public static function categoriesAct()
    {
        return [
            static::CATEGORY_ACT_SOLUTIONS => Yii::t('rus', 'Решение'),
            static::CATEGORY_ACT_SENTENCES => Yii::t('rus', 'Приговор'),
            static::CATEGORY_ACT_RESOLUTIONS => Yii::t('rus', 'Постановление'),
            static::CATEGORY_ACT_ORDERS => Yii::t('rus', 'Распоряжение'),
            static::CATEGORY_ACT_DEFINITIONS => Yii::t('rus', 'Определение'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\office\models\query\OfficeDocumentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\office\models\query\OfficeDocumentsQuery(get_called_class());
    }
}
