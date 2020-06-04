<?php

namespace app\modules\office\models\query;

/**
 * This is the ActiveQuery class for [[\app\modules\office\models\OfficeCorrespondence]].
 *
 * @see \app\modules\office\models\OfficeCorrespondence
 */
class OfficeCorrespondenceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\modules\office\models\OfficeCorrespondence[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\office\models\OfficeCorrespondence|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
