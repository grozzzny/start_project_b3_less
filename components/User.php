<?php


namespace app\components;


use Da\User\Factory\MailFactory;
use Da\User\Service\UserCreateService;
use Yii;

/**
 * Class User
 * @package app\components
 * @property \app\models\User $identity
 *
 */
class User extends \yii\web\User
{


    public static function createUserAndLogin($email, $username)
    {
        /** @var \Da\User\Model\User $model */
        $user = Yii::$container->get(\Da\User\Model\User::class);

        if($user::find()->where(['email' => $email])->exists()) return null;

        $user = new $user([
            'scenario' => 'create',
            'email' => $email,
            'username' => $username,
            'password' => null
        ]);

        /** @var MailFactory $mailFactory */
        $mailFactory = Yii::$container->get(MailFactory::class);
        $mailService = $mailFactory::makeWelcomeMailerService($user);

        /** @var UserCreateService $userCreateService */
        $userCreateService = Yii::$container->get(UserCreateService::class, [$user, $mailService]);
        $userCreateService->run();

        Yii::$app->user->login($user);

        return $user;
    }
}