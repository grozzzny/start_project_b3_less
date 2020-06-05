<?php


namespace app\components;


use Da\User\Event\SocialNetworkAuthEvent;
use Da\User\Factory\MailFactory;
use Da\User\Model\User;
use Da\User\Service\UserCreateService;
use Yii;
use yii\base\BaseObject;

class SocialNetworkHandler extends BaseObject
{
    /**
     * @param SocialNetworkAuthEvent $event
     */
    public static function beforeAuthenticate($event)
    {
        /** @var User $model */
        $user = Yii::$container->get(User::class);

        if($user::find()->where(['email' => $event->client->email])->exists()) return;

        $user = new $user([
            'scenario' => 'create',
            'email' => $event->client->email,
            'username' => $event->client->username,
            'password' => null
        ]);

        /** @var MailFactory $mailFactory */
        $mailFactory = Yii::$container->get(MailFactory::class);
        $mailService = $mailFactory::makeWelcomeMailerService($user);

        /** @var UserCreateService $userCreateService */
        $userCreateService = Yii::$container->get(UserCreateService::class, [$user, $mailService]);
        $userCreateService->run();

        $event->account->user_id = $user->id;
        $event->account->save();

        Yii::$app->user->login($user);
    }
}
