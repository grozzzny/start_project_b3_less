<?php

namespace app\models;

use app\components\BlameableTrait;
use grozzzny\admin\widgets\file_input\components\FileBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "teames".
 *
 * @property int $id
 * @property int|null $owner_id
 * @property string|null $name
 * @property string|null $image
 * @property int|null $active
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Rating[] $ratings
 * @property User $owner
 */
class Teames extends \yii\db\ActiveRecord
{
    use BlameableTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teames';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            BlameableBehavior::className(),
            TimestampBehavior::className(),
            'image' => [
                'class' => FileBehavior::className(),
                'fileAttribute' => 'image',
                'uploadPath' => '/uploads/teames',
            ],
        ]);
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['owner_id', 'active', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['image'], 'image'],
            [['owner_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['owner_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rus', 'ID'),
            'owner_id' => Yii::t('rus', 'Капитан команды'),
            'name' => Yii::t('rus', 'Название команды'),
            'image' => Yii::t('rus', 'Изображение / фото команды'),
            'active' => Yii::t('rus', 'Активно'),
            'created_at' => Yii::t('rus', 'Дата создания'),
            'updated_at' => Yii::t('rus', 'Дата обновления'),
            'created_by' => Yii::t('rus', 'Создан'),
            'updated_by' => Yii::t('rus', 'Обновлен'),
        ];
    }

    /**
     * Gets query for [[Ratings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRatings()
    {
        return $this->hasMany(Rating::className(), ['team_id' => 'id']);
    }

    /**
     * Gets query for [[Owner]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'owner_id']);
    }
}
