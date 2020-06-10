<?php

namespace app\modules\office\models;

use app\modules\office\components\AccountTrait;
use app\components\BlameableTrait;
use app\modules\office\components\EmployeeTrait;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * This is the model class for table "office_transaction".
 *
 * @property int $id
 * @property int|null $cost
 * @property string|null $type
 * @property string|null $note
 * @property int|null $consultation_id
 * @property int|null $case_id
 * @property int|null $client_id
 * @property int|null $is_account
 * @property string|null $employee_id
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $account_id
 * @property string $relation [varchar(255)]
 * @property boolean $isAccount
 */
class OfficeTransaction extends \yii\db\ActiveRecord implements RelationsInterface
{
    use EmployeeTrait;
    use AccountTrait;
    use BlameableTrait;

    const TYPE_ADD = 'add';
    const TYPE_SUBTRACT = 'subtract';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'office_transaction';
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
            [['cost', 'consultation_id', 'case_id', 'client_id', 'is_account', 'created_at', 'updated_at', 'created_by', 'updated_by', 'account_id'], 'integer'],
            [['type', 'note', 'employee_id', 'relation'], 'string', 'max' => 255],
            [[
                'account_id',
                'relation',
                'type',
                'cost',
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
            [['employee_id'], 'required', 'when' => function($model) {
                /** @var self $model */
                return !$model->isAccount;
            }, 'whenClient' => "function (attribute, value) { return $('#".Html::getInputId($this, 'is_account')."').prop('checked') == false; }"],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rus', 'ID'),
            'cost' => Yii::t('rus', 'Сумма'),
            'type' => Yii::t('rus', 'Тип транзакции'), // Пополнение, списание
            'note' => Yii::t('rus', 'Примечание'),
            'relation' => Yii::t('rus', 'Отношение'),
            'consultation_id' => Yii::t('rus', 'Консультация'),
            'case_id' => Yii::t('rus', 'Дело'),
            'client_id' => Yii::t('rus', 'Клиент'),
            'is_account' => Yii::t('rus', 'Списание в пользу общего счета'),
            'employee_id' => Yii::t('rus', 'Сотрудник'),
            'created_at' => Yii::t('rus', 'Дата создания'),
            'updated_at' => Yii::t('rus', 'Дата обновления'),
            'created_by' => Yii::t('rus', 'Создан'),
            'updated_by' => Yii::t('rus', 'Обновлен'),
            'account_id' => Yii::t('rus', 'Аккаунт'),
        ];
    }

    public function getIsAccount()
    {
        return $this->is_account == 1;
    }

    public static function types()
    {
        return [
            self::TYPE_ADD => Yii::t('rus', 'Пополнение'),
            self::TYPE_SUBTRACT => Yii::t('rus', 'Списание'),
        ];
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
     * @return \app\modules\office\models\query\OfficeTransactionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\office\models\query\OfficeTransactionQuery(get_called_class());
    }
}
