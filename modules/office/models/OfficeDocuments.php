<?php

namespace app\modules\office\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

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
            [['account_id', 'case_id', 'client_id', 'datetime_act', 'court_id', 'term_appeal', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['datetime_act'], 'date', 'format' => 'dd.MM.yyyy'],
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
            'account_id' => Yii::t('rus', 'Аккаунт'),
            'case_id' => Yii::t('rus', 'Дело'),
            'client_id' => Yii::t('rus', 'Клиент'),
            'category' => Yii::t('rus', 'Категория'), // Текущие, Судебный акт, Документы
            'datetime_act' => Yii::t('rus', 'Дата судебного акта'),
            'category_act' => Yii::t('rus', 'Категория акта'), // Решение, приговор, постановление и т.д.
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

    /**
     * {@inheritdoc}
     * @return \app\modules\office\models\query\OfficeDocumentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\office\models\query\OfficeDocumentsQuery(get_called_class());
    }
}
