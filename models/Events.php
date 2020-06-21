<?php

namespace app\models;

use app\components\BlameableTrait;
use app\components\RelationIdsBehavior;
use grozzzny\admin\components\images\AdminImages;
use grozzzny\admin\helpers\Image;
use grozzzny\admin\helpers\StringHelper;
use grozzzny\admin\widgets\file_input\components\FileBehavior;
use \yii\helpers\Url;
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
 * @property string $image [varchar(255)]
 * @property string $descriptionShort
 * @property string $countTimeLabel
 * @property int $league_id [int(11)]
 * @property int $code [int(11)]
 * @property-read string $publicLink
 * @property-read string $nameFormat
 * @property-read Teames[] $teames
 * @property-read boolean $isOpenRegistration
 * @property-read boolean $isActive
 * @property-read AdminImages $images
 */
class Events extends \yii\db\ActiveRecord
{
    use BlameableTrait;

    public $teames_ids = [];

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
                'value' => function ($event) {return empty($this->time_from) ? null : Yii::$app->formatter->asDatetime($this->time_from);},
            ],
            'timeToConvert' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [ActiveRecord::EVENT_AFTER_FIND => 'time_to'],
                'value' => function ($event) {return empty($this->time_to) ? null : Yii::$app->formatter->asDatetime($this->time_to);},
            ],
            'image' => [
                'class' => FileBehavior::className(),
                'fileAttribute' => 'image',
                'uploadPath' => '/uploads/events',
            ],
            'code' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [ActiveRecord::EVENT_BEFORE_INSERT => 'code'],
                'value' => function ($event) {return $this->code = rand(10000, 99999);},
            ],
            'teames_ids' => [
                'class' => RelationIdsBehavior::class,
                'relationName' => 'teames',
                'attribute' => 'teames_ids',
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
            [['loaction_id', 'active', 'created_at', 'updated_at', 'created_by', 'updated_by', 'league_id', 'code'], 'integer'],
            [['time_from'], 'datetime', 'format' => 'dd.MM.yyyy HH:mm', 'timestampAttribute' => 'time_from'],
            [['time_from'], 'default', 'value' => null],
            [['time_to'], 'datetime', 'format' => 'dd.MM.yyyy HH:mm', 'timestampAttribute' => 'time_to'],
            [['time_to'], 'default', 'value' => null],
            [['name'], 'string', 'max' => 255],
            [['image'], 'image'],
            [['loaction_id'], 'exist', 'skipOnError' => true, 'targetClass' => Locations::className(), 'targetAttribute' => ['loaction_id' => 'id']],
            [[
                'name',
                'loaction_id',
                'time_from',
                'time_to',
                'league_id',
            ], 'required'],
            [['teames_ids'], 'safe'],
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
            'image' => Yii::t('rus', 'Изображение'),
            'league_id' => Yii::t('rus', 'Лига'),
            'code' => Yii::t('rus', 'Код'),
            'teames_ids' => Yii::t('rus', 'Команды'),
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



    public function getImage($width = null, $height = null)
    {
        if(!isset(Yii::$app->params['noimage'])) return Image::thumb($this->image, $width, $height);

        $path = empty($this->image) ? Yii::$app->params['noimage'] : $this->image;

        $image = Image::thumb($path, $width, $height);

        return empty($image) ? Image::thumb(Yii::$app->params['noimage'], $width, $height) : $image;
    }

    public function getCountTimeLabel()
    {
        $seconds = abs($this->getOldAttribute('time_to') - time());

        $days = floor($seconds / 86400);

        return Yii::t(
            'rus',
            '{n, plural, =0{Сегодня} =1{1 день} one{# день} few{# дня} many{# дней} other{# дней}}',
            ['n' => $days]
        );
    }

    public function getTeames()
    {
        return $this->hasMany(Teames::className(), ['id' => 'team_id'])->viaTable('teames_events_rel', ['event_id' => 'id']);
    }

    public function getDescriptionShort()
    {
        return StringHelper::cut($this->description, 150);
    }

    public function getPublicLink()
    {
        return Url::to(['/events/' . $this->id]);
    }

    public function getNameFormat()
    {
        return $this->name . ' «'.$this->loaction->name.'»';
    }

    public function hasTeam(Teames $team)
    {
        if(empty($this->teames)) return false;

        return in_array($team->id, ArrayHelper::getColumn($this->teames, 'id'));
    }

    public function getIsActive()
    {
        return $this->active == '1';
    }

    public function getIsOpenRegistration()
    {
        if(!$this->isActive) return false;

        if($this->getOldAttribute('time_from') <= time()) return false;

        return true;
    }

    public function getImages()
    {
        return $this->hasMany(AdminImages::className(), ['item_id' => 'id'])->where(['key' => 'events']);
    }
}
