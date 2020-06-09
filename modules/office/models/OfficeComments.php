<?php

namespace app\modules\office\models;

use app\components\BlameableTrait;
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
 */
class OfficeComments extends \yii\db\ActiveRecord
{
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
            [['task_id', 'case_id', 'client_id', 'document_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'account_id'], 'integer'],
            [['text'], 'string', 'max' => 255],
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
            'task_id' => Yii::t('rus', 'Задача'),
            'case_id' => Yii::t('rus', 'Дело'),
            'client_id' => Yii::t('rus', 'Клиент'),
            'document_id' => Yii::t('rus', 'Документ'),
            'text' => Yii::t('rus', 'Описание'),
            'created_at' => Yii::t('rus', 'Дата создания'),
            'updated_at' => Yii::t('rus', 'Дата обновления'),
            'created_by' => Yii::t('rus', 'Создан'),
            'updated_by' => Yii::t('rus', 'Обновлен'),
            'account_id' => Yii::t('rus', 'Аккаунт'),
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
