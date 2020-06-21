<?php


namespace app\components;


use app\models\Locations;
use Da\User\Factory\MailFactory;
use Da\User\Service\UserCreateService;
use Yii;
use yii\web\Cookie;

/**
 * Class User
 * @package app\components
 * @property \app\models\User $identity
 * @property-read integer $cookieLocationId
 * @property-read Locations $selectedLocation
 *
 */
class User extends \yii\web\User
{

    private $_selectedLocation;

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

    public function getSelectedLocation()
    {
        if(!empty($this->_selectedLocation)) return $this->_selectedLocation;

        return $this->_selectedLocation = Locations::findOne($this->cookieLocationId);
    }

    public function setCookieLocation($id)
    {
        Yii::$app->response->cookies->add(new Cookie([
            'name' => 'location_id',
            'value' => $id,
        ]));
    }

    public function getCookieLocationId()
    {
        $location_id = Yii::$app->request->cookies->get('location_id')->value;

        if(empty($location_id)){
            $this->_selectedLocation = Locations::find()->andWhere(['active' => true])->one();
            $location_id = $this->_selectedLocation->id;
            $this->setCookieLocation($location_id);
        }

        return $location_id;
    }
}
