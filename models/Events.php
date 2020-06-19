<?php

namespace app\models;

use app\components\BlameableTrait;
use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "events".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $loaction_id
 * @property int|null $time_from
 * @property int|null $time_to
 * @property int|null $active
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Locations $loaction
 * @property Rating[] $ratings
 */
class Events extends \yii\db\ActiveRecord
{
    use BlameableTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'events';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            BlameableBehavior::className(),
            TimestampBehavior::className(),
            'timeFromConvert' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [ActiveRecord::EVENT_AFTER_FIND => 'time_from'],
                'value' => function ($event) {return empty($this->time_from) ? null : date('d.m.Y H:i', $this->time_from);},
            ],
            'timeToConvert' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [ActiveRecord::EVENT_AFTER_FIND => 'time_to'],
                'value' => function ($event) {return empty($this->time_to) ? null : date('d.m.Y H:i', $this->time_to);},
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['loaction_id', 'active', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['time_from'], 'datetime', 'format' => 'dd.MM.yyyy HH:mm', 'timestampAttribute' => 'time_from'],
            [['time_from'], 'default', 'value' => null],
            [['time_to'], 'datetime', 'format' => 'dd.MM.yyyy HH:mm', 'timestampAttribute' => 'time_to'],
            [['time_to'], 'default', 'value' => null],
            [['name'], 'string', 'max' => 255],
            [['loaction_id'], 'exist', 'skipOnError' => true, 'targetClass' => Locations::className(), 'targetAttribute' => ['loaction_id' => 'id']],
            [[
                'name',
                'loaction_id',
                'time_from',
                'time_to',
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
            'name' => Yii::t('rus', 'Наименование'),
            'description' => Yii::t('rus', 'Описание / Призовой фонд'),
            'loaction_id' => Yii::t('rus', 'Локация'),
            'time_from' => Yii::t('rus', 'Время начала'),
            'time_to' => Yii::t('rus', 'Время окончания'),
            'active' => Yii::t('rus', 'Активно'),
            'created_at' => Yii::t('rus', 'Дата создания'),
            'updated_at' => Yii::t('rus', 'Дата обновления'),
            'created_by' => Yii::t('rus', 'Создан'),
            'updated_by' => Yii::t('rus', 'Обновлен'),
        ];
    }

    /**
     * Gets query for [[Loaction]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLoaction()
    {
        return $this->hasOne(Locations::className(), ['id' => 'loaction_id']);
    }

    /**
     * Gets query for [[Ratings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRatings()
    {
        return $this->hasMany(Rating::className(), ['event_id' => 'id']);
    }
}
