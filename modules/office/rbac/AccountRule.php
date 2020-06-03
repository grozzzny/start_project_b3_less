<?php


namespace app\modules\office\rbac;


use yii\rbac\Item;
use yii\rbac\Rule;

class AccountRule extends Rule
{
    public $name = 'isAuthor';

    /**
     * @param string|integer $user ID пользователя.
     * @param Item $item роль или разрешение с которым это правило ассоциировано
     * @param array $params параметры, переданные в ManagerInterface::checkAccess(), например при вызове проверки
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        return isset($params['news']) ? $params['news']->createdBy == $user : false;
    }

    // Yii::$app->user->can('updateOwnNews', ['news' => $newsModel])

}