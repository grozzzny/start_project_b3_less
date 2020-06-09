<?php


namespace app\components;


use app\models\User;
use yii\db\ActiveRecord;

/**
 * Trait BlameableTrait
 * @package app\components
 * @property-read User $createdBy
 * @property-read User $updatedBy
 * @property-read string $createdByEmail
 * @property-read string $updatedByEmail
 */
trait BlameableTrait
{

    public function getCreatedBy()
    {
        /** @var ActiveRecord $this */
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    public function getUpdatedBy()
    {
        /** @var ActiveRecord $this */
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    public function getCreatedByEmail()
    {
        /** @var self $this */
        return $this->createdBy->email;
    }

    public function getUpdatedByEmail()
    {
        /** @var self $this */
        return $this->updatedBy->email;
    }
}