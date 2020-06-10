<?php

namespace app\modules\office\models;

use app\modules\office\components\AccountTrait;
use app\components\BlameableTrait;
use app\modules\office\components\EmployeeTrait;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "office_case".
 *
 * @property int $id
 * @property int|null $account_id
 * @property string|null $number
 * @property int|null $client_id
 * @property string|null $category
 * @property string|null $object_category
 * @property int|null $curator_id
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property OfficeCaseEmployeeRel[] $officeCaseEmployeeRels
 * @property OfficeEmployee[] $employees
 * @property-read string $objectCategoryLabel
 * @property-read string $categoryLabel
 * @property-read OfficeClients $client
 * @property-read string $name
 *
 */
class OfficeCase extends \yii\db\ActiveRecord
{
    use EmployeeTrait;
    use AccountTrait;
    use BlameableTrait;

    const CATEGORY_CIVIL = 'civil';

    const CIVIL_PLAINTIFF = 'civil_plaintiff';
    const CIVIL_RESPONDENT = 'civil_respondent';
    const CIVIL_SUBJECT_DISPUTE = 'civil_subject_dispute';
    const CIVIL_COURT = 'civil_court';

    const CATEGORY_CRIMINAL = 'criminal';

    const CRIMINAL_SUSPECT = 'criminal_suspect';
    const CRIMINAL_VICTIM = 'criminal_victim';
    const CRIMINAL_ESSENCE_CHARGE = 'criminal_essence_charge';
    const CRIMINAL_STAGE_PRE_INVESTIGATION = 'criminal_stage_pre_investigation';
    const CRIMINAL_STAGE_CONSEQUENCE = 'criminal_stage_consequence';
    const CRIMINAL_STAGE_JUDICIAL = 'criminal_stage_judicial';
    const CRIMINAL_COURT = 'criminal_court';

    const CATEGORY_EXECUTION = 'execution';

    const EXECUTION_RECOVERER = 'execution_recoverer';
    const EXECUTION_DEBTOR = 'execution_debtor';
    const EXECUTION_BAILIFF_SERVICE = 'execution_bailiff_service';
    const EXECUTION_SUBJECT_EXECUTION = 'execution_subject_execution';

    const CATEGORY_ADMINISTRATIVE = 'administrative';

    const ADMINISTRATIVE_PLAINTIFF = 'administrative_plaintiff';
    const ADMINISTRATIVE_RESPONDENT = 'administrative_respondent';
    const ADMINISTRATIVE_OFFENDER = 'administrative_offender';
    const ADMINISTRATIVE_COURT = 'administrative_court';
    const ADMINISTRATIVE_SUBJECT_DISPUTE = 'administrative_subject_dispute';

    const CATEGORY_INSTRUCTION = 'instruction';

    const INSTRUCTION_ESSENCE_ORDER = 'instruction_essence_order';
    const INSTRUCTION_APPLICANT = 'instruction_applicant';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'office_case';
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
            [['account_id', 'client_id', 'curator_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['number', 'category', 'object_category'], 'string', 'max' => 255],
            [[
                'account_id',
                'client_id',
                'category',
                'object_category',
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
            'number' => Yii::t('rus', 'Номер дела'),
            'client_id' => Yii::t('rus', 'Клиент'),
            'category' => Yii::t('rus', 'Категория'),
            'object_category' => Yii::t('rus', 'Объект категории'),
            'curator_id' => Yii::t('rus', 'Куратор'),
            'created_at' => Yii::t('rus', 'Дата создания'),
            'updated_at' => Yii::t('rus', 'Дата обновления'),
            'created_by' => Yii::t('rus', 'Создан'),
            'updated_by' => Yii::t('rus', 'Обновлен'),
        ];
    }

    /**
     * Gets query for [[OfficeCaseEmployeeRels]].
     *
     * @return \yii\db\ActiveQuery|\app\modules\office\models\query\OfficeCaseEmployeeRelQuery
     */
    public function getOfficeCaseEmployeeRels()
    {
        return $this->hasMany(OfficeCaseEmployeeRel::className(), ['case_id' => 'id']);
    }

    /**
     * Gets query for [[Employees]].
     *
     * @return \yii\db\ActiveQuery|\app\modules\office\models\query\OfficeEmployeeQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(OfficeEmployee::className(), ['id' => 'employee_id'])->viaTable('office_case_employee_rel', ['case_id' => 'id']);
    }

    public function getObjectCategoryLabel()
    {
        $objects = ArrayHelper::getValue(static::objectsCategory(), $this->category);
        return ArrayHelper::getValue($objects, $this->object_category);
    }

    public function getCategoryLabel()
    {
        return ArrayHelper::getValue(static::categories(), $this->category);
    }

    public function getClient()
    {
        return $this->hasOne(OfficeClients::class, ['id' => 'client_id']);
    }

    public function getName()
    {
        return implode(' / ', [
            $this->number,
            $this->client->full_name,
            $this->categoryLabel,
            $this->objectCategoryLabel
        ]);
    }

    public static function categories()
    {
        return [
            self::CATEGORY_CIVIL => Yii::t('rus', 'Гражданское дело'),
            self::CATEGORY_CRIMINAL => Yii::t('rus', 'Уголовное дело'),
            self::CATEGORY_EXECUTION => Yii::t('rus', 'Исполнение судебного акта'),
            self::CATEGORY_ADMINISTRATIVE => Yii::t('rus', 'Административное'),
            self::CATEGORY_INSTRUCTION => Yii::t('rus', 'Поручение'),
        ];
    }

    public static function objectsCategory()
    {
        return [
            self::CATEGORY_CIVIL => [
                self::CIVIL_PLAINTIFF => Yii::t('rus', 'Истец'),
                self::CIVIL_RESPONDENT => Yii::t('rus', 'Ответчик'),
                self::CIVIL_SUBJECT_DISPUTE => Yii::t('rus', 'Предмет спора'),
                self::CIVIL_COURT => Yii::t('rus', 'Суд'),
            ],
            self::CATEGORY_CRIMINAL => [
                self::CRIMINAL_SUSPECT => Yii::t('rus', 'Подозреваемый (обвиняемый)'),
                self::CRIMINAL_VICTIM => Yii::t('rus', 'Потерпевший'),
                self::CRIMINAL_ESSENCE_CHARGE => Yii::t('rus', 'Суть обвинения'),
                self::CRIMINAL_STAGE_PRE_INVESTIGATION => Yii::t('rus', 'Стадия расследования (Доследственная проверка)'),
                self::CRIMINAL_STAGE_CONSEQUENCE => Yii::t('rus', 'Стадия расследования (Следствие)'),
                self::CRIMINAL_STAGE_JUDICIAL => Yii::t('rus', 'Стадия расследования (Судебная стадия)'),
                self::CRIMINAL_COURT => Yii::t('rus', 'Суд'),
            ],
            self::CATEGORY_EXECUTION => [
                self::EXECUTION_RECOVERER => Yii::t('rus', 'Взыскатель'),
                self::EXECUTION_DEBTOR => Yii::t('rus', 'Должник'),
                self::EXECUTION_BAILIFF_SERVICE => Yii::t('rus', 'Приставы'),
                self::EXECUTION_SUBJECT_EXECUTION => Yii::t('rus', 'Предмет исполнения'),
            ],
            self::CATEGORY_ADMINISTRATIVE => [
                self::ADMINISTRATIVE_PLAINTIFF => Yii::t('rus', 'Административный истец'),
                self::ADMINISTRATIVE_RESPONDENT => Yii::t('rus', 'Административный ответчик'),
                self::ADMINISTRATIVE_OFFENDER => Yii::t('rus', 'Правонарушитель'),
                self::ADMINISTRATIVE_COURT => Yii::t('rus', 'Суд'),
                self::ADMINISTRATIVE_SUBJECT_DISPUTE => Yii::t('rus', 'Предмет спора'),
            ],
            self::CATEGORY_INSTRUCTION => [
                self::INSTRUCTION_ESSENCE_ORDER => Yii::t('rus', 'Суть поручения'),
                self::INSTRUCTION_APPLICANT => Yii::t('rus', 'Заявитель'),
            ],
        ];
    }

    public static function objectsCategoryFormat()
    {
        $arr = [];

        foreach (self::objectsCategory() as $key => $objects){
            foreach ($objects as $key_object => $name) {
                $arr[$key][] = [
                    'id' => $key_object,
                    'text' => $name,
                ];
            }
        }

        return $arr;
    }

    public static function map($account_id)
    {
        return ArrayHelper::map(self::find()->accaunt($account_id)->all(), 'id', 'name');
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\office\models\query\OfficeCaseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\office\models\query\OfficeCaseQuery(get_called_class());
    }
}
