<?php


namespace app\modules\office\models\query;


class AccountBaseQuery extends \yii\db\ActiveQuery
{
    public function accaunt($account_id)
    {
        return $this->andWhere([
            'account_id' => $account_id
        ]);
    }
}