<?php


namespace app\modules\office\components;


use app\components\User as WebUser;
use app\models\User;
use app\modules\office\models\OfficeAccount;
use app\modules\office\models\OfficeEmployee;
use Yii;
use yii\base\Behavior;
use yii\base\Exception;
use yii\db\ActiveRecord;

class CreateAccountBehavior extends Behavior
{
    /**
     * @var OfficeAccount
     */
    public $owner;

    /**
     * @var User
     */
    public $user;

    public function events()
    {
        $model = $this->owner;

        if($model->scenario !== OfficeAccount::SCENARIO_CREATE) return false;

        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
            ActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
        ];
    }

    public function beforeInsert()
    {
        $this->user = Yii::$app->user->isGuest ? $this->createUser() : Yii::$app->user->identity;

        $this->setParams();
    }

    public function afterInsert()
    {
        $this->addEmployee();
        $this->sendNotify();
    }

    protected function createUser()
    {
        $model = $this->owner;
        $username = self::generateUsername($model->email);

        return WebUser::createUserAndLogin($model->email, $username);
    }

    protected function setParams()
    {
        $this->owner->owner_id = $this->user->id;
        $this->owner->active = true;
        $this->owner->active_at = self::activeAt();
    }

    protected function addEmployee()
    {
        $employee = Yii::createObject([
            'class' => OfficeEmployee::class,
            'user_id' => $this->user->id,
            'account_id' => $this->owner->id,
            'role' => OfficeEmployee::ROLE_ADMINISTRATOR,
            'priority' => 1,
            'full_name' => $this->owner->full_name
        ]);

        if(!$employee->save()){
            throw new Exception(json_encode($employee->errors, JSON_UNESCAPED_UNICODE));
        }
    }

    protected function sendNotify()
    {
        Yii::$app->mailer->compose()
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setTo($this->user->email)
            ->setTextBody(Yii::t('rus', '{0}! Вами создан аккаунт в системе журнала судебных дел', [$this->owner->full_name]))
            ->setSubject(Yii::t('rus', 'Вами создан аккаунт в системе журнала судебных дел'))
            ->send();
    }

    protected static function generateUsername($email)
    {
        return preg_replace('/[^A-z]+/i', '_', $email);
    }

    protected static function activeAt()
    {
        $dateTime = new \DateTime('+ 15 day');
        return $dateTime->getTimestamp();
    }
}
