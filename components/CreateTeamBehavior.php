<?php


namespace app\components;


use app\models\Teames;
use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use app\components\User as WebUser;

class CreateTeamBehavior extends Behavior
{
    /**
     * @var Teames
     */
    public $owner;

    /**
     * @var User
     */
    public $user;

    public function events()
    {
        $model = $this->owner;

        if($model->scenario !== Teames::SCENARIO_CREATE) return false;

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
    }

//    protected function addEmployee()
//    {
//        $employee = Yii::createObject([
//            'class' => OfficeEmployee::class,
//            'user_id' => $this->user->id,
//            'account_id' => $this->owner->id,
//            'role' => OfficeEmployee::ROLE_ADMINISTRATOR,
//            'priority' => 1,
//            'full_name' => $this->owner->full_name
//        ]);
//
//        if(!$employee->save()){
//            throw new Exception(json_encode($employee->errors, JSON_UNESCAPED_UNICODE));
//        }
//    }

    protected function sendNotify()
    {
        Yii::$app->mailer->compose()
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setTo($this->user->email)
            ->setTextBody(Yii::t('rus', 'Вами зарегистрирована команда «{0}»', [$this->owner->name]))
            ->setSubject(Yii::t('rus', 'Зарегистрирована команда'))
            ->send();
    }

    protected static function generateUsername($email)
    {
        return preg_replace('/[^A-z]+/i', '_', $email);
    }
}
