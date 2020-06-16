<?php


namespace app\components;


use Da\User\Event\SocialNetworkAuthEvent;
use app\components\User as WebUser;
use yii\base\BaseObject;

class SocialNetworkHandler extends BaseObject
{
    /**
     * @param SocialNetworkAuthEvent $event
     */
    public static function beforeAuthenticate($event)
    {
        $user = WebUser::createUserAndLogin($event->client->email, $event->client->username);

        $event->account->user_id = $user->id;
        $event->account->save();
    }
}
