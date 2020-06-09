<?php

namespace app\modules\office\models\query;

/**
 * This is the ActiveQuery class for [[\app\modules\office\models\OfficeEmployee]].
 *
 * @see \app\modules\office\models\OfficeEmployee
 */
class OfficeEmployeeQuery extends AccountBaseQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\modules\office\models\OfficeEmployee[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\office\models\OfficeEmployee|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
