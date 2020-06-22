<?php

namespace app\models;

use app\components\BlameableTrait;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "league".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $active
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Locations[] $locations
 */
class League extends \yii\db\ActiveRecord
{
    use BlameableTrait;

    const SCENARIO_USER = 'user';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'league';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            BlameableBehavior::className(),
            TimestampBehavior::className(),
        ]);
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT => parent::scenarios()['default'],
            self::SCENARIO_USER => [
                'name',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'required'],
            [['name'], 'required', 'on' => self::SCENARIO_USER],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rus', 'ID'),
            'name' => Yii::t('rus', 'Наименование'),
            'active' => Yii::t('rus', 'Активно'),
            'created_at' => Yii::t('rus', 'Дата создания'),
            'updated_at' => Yii::t('rus', 'Дата обновления'),
            'created_by' => Yii::t('rus', 'Создан'),
            'updated_by' => Yii::t('rus', 'Обновлен'),
        ];
    }

    /**
     * Gets query for [[Locations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocations()
    {
        return $this->hasMany(Locations::className(), ['league_id' => 'id']);
    }

    public static function map()
    {
        return ArrayHelper::map(self::find()->andWhere(['active' => true])->all(), 'id', 'name');
    }
}
