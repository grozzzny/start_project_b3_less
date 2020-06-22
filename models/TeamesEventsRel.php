<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "teames_events_rel".
 *
 * @property int|null $team_id
 * @property int|null $event_id
 *
 * @property Events $event
 * @property Teames $team
 */
class TeamesEventsRel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teames_events_rel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['team_id', 'event_id'], 'integer'],
            [['team_id', 'event_id'], 'unique', 'targetAttribute' => ['team_id', 'event_id']],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Events::className(), 'targetAttribute' => ['event_id' => 'id']],
            [['team_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teames::className(), 'targetAttribute' => ['team_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'team_id' => Yii::t('rus', 'Team ID'),
            'event_id' => Yii::t('rus', 'Event ID'),
        ];
    }

    /**
     * Gets query for [[Event]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Events::className(), ['id' => 'event_id']);
    }

    /**
     * Gets query for [[Team]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeam()
    {
        return $this->hasOne(Teames::className(), ['id' => 'team_id']);
    }
}
