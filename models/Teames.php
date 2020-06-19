<?php

namespace app\models;

use app\components\BlameableTrait;
use app\components\CreateTeamBehavior;
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
 * @property boolean $isActive
 */
class Teames extends \yii\db\ActiveRecord
{
    use BlameableTrait;

    public $email;

    const SCENARIO_CREATE = 'create';

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
            'create_team' => [
                'class' => CreateTeamBehavior::class
            ]
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
            [['email'], 'required', 'on' => self::SCENARIO_CREATE],
            [['email'], 'email'],
            [['email'], 'validatorUniqueUser'],
            [['email'], 'validatorUniqueTeam'],
        ];
    }

    public function validatorUniqueUser($attribute, $params) {
        if(!Yii::$app->user->isGuest) return false;

        $existModel = User::find()->andWhere(['email' => $this->email])->exists();

        if ($existModel) {
            $this->addError($attribute, Yii::t('rus', 'Пользователь с таким электронным адресом уже зарегистрирован в системе. Пожалуйста авторизуйтесь.'));
        }
    }

    public function validatorUniqueTeam($attribute, $params) {
        $existModel = self::find()->joinWith('owner')->andWhere(['email' => $this->email])->exists();

        if ($existModel) {
            $this->addError($attribute, Yii::t('rus', 'Пользователь с таким электронным адресом уже имеет зарегистрированную команду.'));
        }
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
            'email' => Yii::t('rus', 'Электронный адрес'),
        ];
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT => parent::scenarios()['default'],
            self::SCENARIO_CREATE => [
                'email',
            ],
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

    public function getIsActive()
    {
        return $this->active == 1;
    }
}
