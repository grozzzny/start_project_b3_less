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
 * This is the model class for table "office_comments".
 *
 * @property int $id
 * @property int|null $task_id
 * @property int|null $case_id
 * @property int|null $client_id
 * @property int|null $document_id
 * @property string|null $text
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $account_id
 * @property string $relation [varchar(255)]
 * @property int $consultation_id [int(11)]
 * @property int $session_id [int(11)]
 */
class OfficeComments extends \yii\db\ActiveRecord implements RelationsInterface
{
    use EmployeeTrait;
    use AccountTrait;
    use BlameableTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'office_comments';
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
            [['task_id', 'case_id', 'client_id', 'document_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'account_id', 'consultation_id', 'session_id'], 'integer'],
            [['text', 'relation'], 'string', 'max' => 255],
            [[
                'text',
                'relation',
                'account_id',
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
            [['session_id'],
                'required',
                'when' => Relation::when(Relation::RELATION_SESSION),
                'whenClient' => Relation::whenClient($this, Relation::RELATION_SESSION)
            ],
            [['client_id'],
                'required',
                'when' => Relation::when(Relation::RELATION_CLIENT),
                'whenClient' => Relation::whenClient($this, Relation::RELATION_CLIENT)
            ],
            [['task_id'],
                'required',
                'when' => Relation::when(Relation::RELATION_TASK),
                'whenClient' => Relation::whenClient($this, Relation::RELATION_TASK)
            ],
            [['document_id'],
                'required',
                'when' => Relation::when(Relation::RELATION_DOCUMENT),
                'whenClient' => Relation::whenClient($this, Relation::RELATION_DOCUMENT)
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
            'task_id' => Yii::t('rus', 'Задача'),
            'case_id' => Yii::t('rus', 'Дело'),
            'relation' => Yii::t('rus', 'Отношение'),
            'client_id' => Yii::t('rus', 'Клиент'),
            'session_id' => Yii::t('rus', 'Заседание'),
            'consultation_id' => Yii::t('rus', 'Консультация'),
            'document_id' => Yii::t('rus', 'Документ'),
            'text' => Yii::t('rus', 'Описание'),
            'created_at' => Yii::t('rus', 'Дата создания'),
            'updated_at' => Yii::t('rus', 'Дата обновления'),
            'created_by' => Yii::t('rus', 'Создан'),
            'updated_by' => Yii::t('rus', 'Обновлен'),
            'account_id' => Yii::t('rus', 'Аккаунт'),
        ];
    }

    public static function relations()
    {
        return [
            Relation::RELATION_CASE => Relation::label(Relation::RELATION_CASE),
            Relation::RELATION_CONSULTATION => Relation::label(Relation::RELATION_CONSULTATION),
            Relation::RELATION_SESSION => Relation::label(Relation::RELATION_SESSION),
            Relation::RELATION_CLIENT => Relation::label(Relation::RELATION_CLIENT),
            Relation::RELATION_DOCUMENT => Relation::label(Relation::RELATION_DOCUMENT),
            Relation::RELATION_TASK => Relation::label(Relation::RELATION_TASK),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\office\models\query\OfficeCommentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\office\models\query\OfficeCommentsQuery(get_called_class());
    }
}
