<?php


namespace app\modules\office\components;


use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class ClientsBehavior extends Behavior
{
    /**
     * @var ActiveRecord
     */
    public $owner;

    public $relations = [];

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
        ];
    }

    public function afterInsert()
    {
        $model = $this->owner;

        foreach ($this->relations as $relation){
            $attribute = $relation.'_id';

            if(!isset($model->{$attribute})) continue;

            if(!empty($model->{$attribute})) {
                $client_id = $model->{$relation}->client_id;
                $model::updateAll(['client_id' => $client_id], ['id' => $model->id]);
                break;
            }
        }
    }
}
