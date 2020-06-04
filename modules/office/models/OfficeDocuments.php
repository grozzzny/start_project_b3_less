<?php

namespace app\modules\office\models;

use Yii;

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
 */
class OfficeDocuments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'office_documents';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_id', 'case_id', 'client_id', 'datetime_act', 'court_id', 'term_appeal', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['category', 'category_act', 'name', 'file', 'note', 'result'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rus', 'ID'),
            'account_id' => Yii::t('rus', 'Account ID'),
            'case_id' => Yii::t('rus', 'Case ID'),
            'client_id' => Yii::t('rus', 'Client ID'),
            'category' => Yii::t('rus', 'Category'),
            'datetime_act' => Yii::t('rus', 'Datetime Act'),
            'category_act' => Yii::t('rus', 'Category Act'),
            'name' => Yii::t('rus', 'Name'),
            'file' => Yii::t('rus', 'File'),
            'note' => Yii::t('rus', 'Note'),
            'court_id' => Yii::t('rus', 'Court ID'),
            'term_appeal' => Yii::t('rus', 'Term Appeal'),
            'result' => Yii::t('rus', 'Result'),
            'created_at' => Yii::t('rus', 'Created At'),
            'updated_at' => Yii::t('rus', 'Updated At'),
            'created_by' => Yii::t('rus', 'Created By'),
            'updated_by' => Yii::t('rus', 'Updated By'),
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
