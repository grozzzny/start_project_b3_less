<?php

namespace app\modules\office\models;

use app\components\RelationIdsBehavior;
use app\modules\office\components\AccountTrait;
use app\components\BlameableTrait;
use app\modules\office\components\EmployeeTrait;
use app\modules\office\widgets\select2\Select2;
use grozzzny\admin\helpers\StringHelper;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

/**
 * This is the model class for table "office_case".
 *
 * @property int $id
 * @property int|null $account_id
 * @property string|null $number
 * @property int|null $client_id
 * @property string|null $category
 * @property int|null $curator_id
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property OfficeCaseEmployeeRel[] $officeCaseEmployeeRels
 * @property OfficeEmployee[] $employees
 * @property-read string $categoryLabel
 * @property-read OfficeClients $client
 * @property-read string $name
 *
 * @property string $civil_plaintiff [varchar(255)]
 * @property string $civil_respondent [varchar(255)]
 * @property string $civil_subject_dispute [varchar(255)]
 * @property string $civil_court_id [varchar(255)]
 * @property string $criminal_suspect [varchar(255)]
 * @property string $criminal_victim [varchar(255)]
 * @property string $criminal_essence_charge [varchar(255)]
 * @property string $criminal_stage [varchar(255)]
 * @property string $criminal_court_id [varchar(255)]
 * @property string $execution_recoverer [varchar(255)]
 * @property string $execution_debtor [varchar(255)]
 * @property string $execution_bailiff_service [varchar(255)]
 * @property string $execution_subject_execution [varchar(255)]
 * @property string $administrative_plaintiff [varchar(255)]
 * @property string $administrative_respondent [varchar(255)]
 * @property string $administrative_offender [varchar(255)]
 * @property string $administrative_court_id [varchar(255)]
 * @property string $administrative_subject_dispute [varchar(255)]
 * @property string $instruction_essence_order [varchar(255)]
 * @property string $instruction_applicant [varchar(255)]
 * @property-read string $subject
 * @property-read string $subjectShort
 *
 */
class OfficeCase extends \yii\db\ActiveRecord
{
    use EmployeeTrait;
    use AccountTrait;
    use BlameableTrait;

    const CATEGORY_CIVIL = 'civil';
    const CATEGORY_CRIMINAL = 'criminal';
    const CATEGORY_EXECUTION = 'execution';
    const CATEGORY_ADMINISTRATIVE = 'administrative';
    const CATEGORY_INSTRUCTION = 'instruction';

    const STAGE_PRE_INVESTIGATION = 'pre_investigation';
    const STAGE_CONSEQUENCE = 'consequence';
    const STAGE_JUDICIAL = 'judicial';

    public $employees_ids = [];

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
            'employees_ids' => [
                'class' => RelationIdsBehavior::class,
                'relationName' => 'employees',
                'attribute' => 'employees_ids',
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_id', 'client_id', 'curator_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['number', 'category'], 'string', 'max' => 255],
            [[
                'account_id',
                'client_id',
                'category',
                'employees_ids',
            ], 'required'],
            [[
                'civil_plaintiff',
                'civil_respondent',
                'civil_subject_dispute',
                'criminal_suspect',
                'criminal_victim',
                'criminal_essence_charge',
                'criminal_stage',
                'execution_recoverer',
                'execution_debtor',
                'execution_bailiff_service',
                'execution_subject_execution',
                'administrative_plaintiff',
                'administrative_respondent',
                'administrative_offender',
                'administrative_subject_dispute',
                'instruction_essence_order',
                'instruction_applicant',
            ], 'string'],
            [[
                'civil_court_id',
                'criminal_court_id',
                'administrative_court_id',
            ], 'integer'],
            [[
                'civil_plaintiff',
                'civil_respondent',
                'civil_subject_dispute',
                'civil_court_id',
            ],
                'required',
                'when' => self::when(self::CATEGORY_CIVIL),
                'whenClient' => self::whenClient($this, self::CATEGORY_CIVIL)
            ],
            [[
                'criminal_suspect',
                'criminal_victim',
                'criminal_essence_charge',
                'criminal_stage',
                'criminal_court_id',
            ],
                'required',
                'when' => self::when(self::CATEGORY_CRIMINAL),
                'whenClient' => self::whenClient($this, self::CATEGORY_CRIMINAL)
            ],
            [[
                'execution_recoverer',
                'execution_debtor',
                'execution_bailiff_service',
                'execution_subject_execution',
            ],
                'required',
                'when' => self::when(self::CATEGORY_EXECUTION),
                'whenClient' => self::whenClient($this, self::CATEGORY_EXECUTION)
            ],
            [[
                'administrative_plaintiff',
                'administrative_respondent',
                'administrative_offender',
                'administrative_court_id',
                'administrative_subject_dispute',
            ],
                'required',
                'when' => self::when(self::CATEGORY_ADMINISTRATIVE),
                'whenClient' => self::whenClient($this, self::CATEGORY_ADMINISTRATIVE)
            ],
            [[
                'instruction_essence_order',
                'instruction_applicant',
            ],
                'required',
                'when' => self::when(self::CATEGORY_INSTRUCTION),
                'whenClient' => self::whenClient($this, self::CATEGORY_INSTRUCTION)
            ],
            [['employees_ids'], 'safe'],
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
            'curator_id' => Yii::t('rus', 'Куратор'),
            'created_at' => Yii::t('rus', 'Дата создания'),
            'updated_at' => Yii::t('rus', 'Дата обновления'),
            'created_by' => Yii::t('rus', 'Создан'),
            'updated_by' => Yii::t('rus', 'Обновлен'),

            'civil_plaintiff' => Yii::t('rus', 'Истец'),
            'civil_respondent' => Yii::t('rus', 'Ответчик'),
            'civil_subject_dispute' => Yii::t('rus', 'Предмет спора'),
            'civil_court_id' => Yii::t('rus', 'Суд'),
            'criminal_suspect' => Yii::t('rus', 'Подозреваемый (обвиняемый)'),
            'criminal_victim' => Yii::t('rus', 'Потерпевший'),
            'criminal_essence_charge' => Yii::t('rus', 'Суть обвинения'),
            'criminal_stage' => Yii::t('rus', 'Стадия расследования'),
            'criminal_court_id' => Yii::t('rus', 'Суд'),
            'execution_recoverer' => Yii::t('rus', 'Взыскатель'),
            'execution_debtor' => Yii::t('rus', 'Должник'),
            'execution_bailiff_service' => Yii::t('rus', 'Приставы'),
            'execution_subject_execution' => Yii::t('rus', 'Предмет исполнения'),
            'administrative_plaintiff' => Yii::t('rus', 'Административный истец'),
            'administrative_respondent' => Yii::t('rus', 'Административный ответчик'),
            'administrative_offender' => Yii::t('rus', 'Правонарушитель'),
            'administrative_court_id' => Yii::t('rus', 'Суд'),
            'administrative_subject_dispute' => Yii::t('rus', 'Предмет спора'),
            'instruction_essence_order' => Yii::t('rus', 'Суть поручения'),
            'instruction_applicant' => Yii::t('rus', 'Заявитель'),
            'subject' => Yii::t('rus', 'Предмет'),
            'employees_ids' => Yii::t('rus', 'Исполнители'),
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
            $this->categoryLabel
        ]);
    }

    public function getSubject()
    {
        switch ($this->category){
            case self::CATEGORY_CIVIL:
                return $this->civil_subject_dispute;
            case self::CATEGORY_CRIMINAL:
                return $this->criminal_essence_charge;
            case self::CATEGORY_EXECUTION:
                return $this->execution_subject_execution;
            case self::CATEGORY_ADMINISTRATIVE:
                return $this->administrative_subject_dispute;
            case self::CATEGORY_INSTRUCTION:
                return $this->instruction_essence_order;
            default: return '';
        }
    }

    public function getSubjectShort()
    {
        return StringHelper::cut($this->subject, 200);
    }

    public static function select2Filter($model)
    {
        return Select2::widget([
            'model' => $model,
            'attribute' => 'case_id',
            'data' => ArrayHelper::map(OfficeCase::find()->all(), 'id', 'name'),
            'pluginOptions' => [
                'allowClear' => true,
                'placeholder' => Yii::t('rus', 'Выберите значение'),
            ],
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


    public static function stages()
    {
        return [
            self::STAGE_PRE_INVESTIGATION => Yii::t('rus', 'Доследственная проверка'),
            self::STAGE_CONSEQUENCE => Yii::t('rus', 'Следствие'),
            self::STAGE_JUDICIAL => Yii::t('rus', 'Судебная стадия'),
        ];
    }

    public static function map($account_id)
    {
        return ArrayHelper::map(self::find()->accaunt($account_id)->all(), 'id', 'name');
    }

    public static function registerJsChangeCategory($model)
    {
        /** @var self $model */
        $keys = array_keys(self::categories());
        $category = empty($model->category) ? $keys[0] : $model->category;

        $js = <<<JS
            var showCategory = function(category) {
                $('[data-category]').hide();
                $('[data-category="'+category+'"]').show();
            };
            showCategory('$category');
            
            var changeCategoryCase = function() {
               showCategory($(this).val());
            }
JS;
        Yii::$app->view->registerJs($js, View::POS_END);
    }

    public static function when($category)
    {
        return function($model) use ($category) {
            /** @var self $model */
            return $model->category == $category;
        };
    }

    public static function whenClient($model, $category)
    {
        /** @var self $model */
        $id = Html::getInputId($model, 'category');
        return <<<JS
            function (attribute, value) { return $('#$id').val() == '$category'; }
JS;

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
