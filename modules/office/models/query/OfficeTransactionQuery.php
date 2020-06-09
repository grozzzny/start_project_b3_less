<?php

namespace app\modules\office\models\query;

/**
 * This is the ActiveQuery class for [[\app\modules\office\models\OfficeTransaction]].
 *
 * @see \app\modules\office\models\OfficeTransaction
 */
class OfficeTransactionQuery extends AccountBaseQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\modules\office\models\OfficeTransaction[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\office\models\OfficeTransaction|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
