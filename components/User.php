<?php


namespace app\components;


use app\modules\office\models\OfficeAccount;
use app\modules\office\models\OfficeEmployee;
use Da\User\Factory\MailFactory;
use Da\User\Service\UserCreateService;
use Yii;

/**
 * Class User
 * @package app\components
 * @property \app\models\User $identity
 *
 * @property-read integer $sessionEmploeeId;
 * @property-read OfficeEmployee $selectedEmploee;
 * @property-read OfficeAccount $selectedAccount;
 */
class User extends \yii\web\User
{
    private $_selectedEmploee;
    private $_selectedAccount;

    public static function createUserAndLogin($email, $username)
    {
        /** @var \Da\User\Model\User $model */
        $user = Yii::$container->get(\Da\User\Model\User::class);

        if($user::find()->where(['email' => $email])->exists()) return;

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

    public function getSelectedEmploee()
    {
        $id = $this->sessionEmploeeId;

        if(empty($id)) return null;

        if(!empty($this->_selectedEmploee)) return $this->_selectedEmploee;

        return $this->_selectedEmploee = OfficeEmployee::findOne($id);
    }

    public function getSelectedAccount()
    {
        $selectedEmploee = $this->selectedEmploee;

        if(empty($selectedEmploee)) return null;

        if(!empty($this->_selectedAccount)) return $this->_selectedAccount;

        return $this->_selectedAccount = $selectedEmploee->officeAccount;
    }

    public function setSessionEmploee($id)
    {
        Yii::$app->session->set('EMPLOEE_ID', $id);

        return $id;
    }

    public function getSessionEmploeeId()
    {
        if($this->isGuest) return null;

        $id = Yii::$app->session->get('EMPLOEE_ID');

        if(empty($id)){

            if(empty($this->identity->officeEmployeePrimary)) return null;

            $id = $this->identity->officeEmployeePrimary->id;
            $this->setSessionEmploee($id);
        }

        return $id;
    }
}