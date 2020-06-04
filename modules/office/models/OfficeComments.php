<?php

namespace app\modules\office\models;

use Yii;

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
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'office_comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'case_id', 'client_id', 'document_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'account_id'], 'integer'],
            [['text'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rus', 'ID'),
            'task_id' => Yii::t('rus', 'Task ID'),
            'case_id' => Yii::t('rus', 'Case ID'),
            'client_id' => Yii::t('rus', 'Client ID'),
            'document_id' => Yii::t('rus', 'Document ID'),
            'text' => Yii::t('rus', 'Text'),
            'created_at' => Yii::t('rus', 'Created At'),
            'updated_at' => Yii::t('rus', 'Updated At'),
            'created_by' => Yii::t('rus', 'Created By'),
            'updated_by' => Yii::t('rus', 'Updated By'),
            'account_id' => Yii::t('rus', 'Account ID'),
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
