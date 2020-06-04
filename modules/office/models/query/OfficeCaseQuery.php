<?php

namespace app\modules\office\models\query;

/**
 * This is the ActiveQuery class for [[\app\modules\office\models\OfficeCase]].
 *
 * @see \app\modules\office\models\OfficeCase
 */
class OfficeCaseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\modules\office\models\OfficeCase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\office\models\OfficeCase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
