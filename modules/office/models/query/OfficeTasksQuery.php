<?php

namespace app\modules\office\models\query;

/**
 * This is the ActiveQuery class for [[\app\modules\office\models\OfficeTasks]].
 *
 * @see \app\modules\office\models\OfficeTasks
 */
class OfficeTasksQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\modules\office\models\OfficeTasks[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\office\models\OfficeTasks|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
