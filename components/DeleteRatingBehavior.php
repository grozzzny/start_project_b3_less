<?php


namespace app\components;


use app\models\Events;
use app\models\Rating;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class DeleteRatingBehavior extends Behavior
{
    /**
     * @var Events
     */
    public $owner;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterUpdate',
        ];
    }

    public function afterUpdate()
    {
        if(count($this->owner->ratings) == count($this->owner->teames)) return false;

        $ids_teames = ArrayHelper::getColumn($this->owner->teames, 'id');

        foreach ($this->owner->ratings as $rating){
            if(!in_array($rating->team_id, $ids_teames)){
                Rating::deleteRating($this->owner->id, $rating->team_id);
            }
        }
    }
}
