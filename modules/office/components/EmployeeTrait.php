<?php


namespace app\modules\office\components;


use app\modules\office\models\OfficeEmployee;
use yii\db\ActiveRecord;

/**
 * Trait EmployeeTrait
 * @package app\modules\office\components
 * @property-read OfficeEmployee $createdEmployee
 */
trait EmployeeTrait
{

    public function getCreatedEmployee()
    {
        /** @var ActiveRecord $this */
        return $this->hasOne(OfficeEmployee::class, ['user_id' => 'created_by'])
            ->onCondition(['account_id' => $this->account_id]);
    }
}