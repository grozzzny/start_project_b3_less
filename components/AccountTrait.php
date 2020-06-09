<?php


namespace app\components;


use app\modules\office\models\OfficeAccount;
use yii\db\ActiveRecord;

/**
 * Trait AccountTrait
 * @package app\components
 * @property-read OfficeAccount $account
 * @property-read string $accountName
 */
trait AccountTrait
{

    public function getAccount()
    {
        /** @var ActiveRecord $this */
        return $this->hasOne(OfficeAccount::class, ['id' => 'account_id']);
    }

    public function getAccountName()
    {
        /** @var self $this */
        return $this->account->name;
    }
}