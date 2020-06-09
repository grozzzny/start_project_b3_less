<?php

namespace app\modules\office\models;

use app\components\BlameableTrait;
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
 */
class OfficeCase extends \yii\db\ActiveRecord
{
    use BlameableTrait;

    const CATEGORY_CIVIL = 'civil';
    const CATEGORY_CRIMINAL = 'criminal';
    const CATEGORY_EXECUTION = 'execution';
    const CATEGORY_ADMINISTRATIVE = 'administrative';
    const CATEGORY_INSTRUCTION = 'instruction';

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

    /**
     * {@inheritdoc}
     * @return \app\modules\office\models\query\OfficeCaseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\office\models\query\OfficeCaseQuery(get_called_class());
    }
}
