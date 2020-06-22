<?php


namespace app\controllers;


use app\models\League;
use app\models\Locations;
use app\models\Teames;
use grozzzny\admin\modules\pages\models\AdminPages;
use phpDocumentor\Reflection\Location;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class SettingsController extends Controller
{
    public $layout = 'main_with_container';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $page = AdminPages::get('page-settings');

        return $this->render('index', ['page' => $page]);
    }

    public function actionTeam()
    {
        $page = AdminPages::get('page-settings-team');

        $model = Yii::$app->user->identity->team;
        $model->setScenario(Teames::SCENARIO_EDIT_USER);

        if($model->load(Yii::$app->request->post())){
            if($model->save()){
                Yii::$app->session->addFlash('success', Yii::t('rus', 'Данные успешно сохранены'));
            } else {
                foreach ($model->errors as $messages){
                    foreach ($messages as $message) Yii::$app->session->addFlash('danger', $message);
                }
            }
        }

        return $this->render('team', ['page' => $page, 'model' => $model]);
    }

    public function actionLeague()
    {
        $page = AdminPages::get('page-settings-league');

        $model = Yii::createObject(['class' => League::class, 'scenario' => League::SCENARIO_USER]);

        if($model->load(Yii::$app->request->post())){
            if($model->save()){
                Yii::$app->session->addFlash('success', Yii::t('rus', 'Данные отправлены на модерацию'));
                $this->sendMailAdmin(Yii::t('rus', 'Отправлен запрос на создание лиги «{0}»', [$model->name]));
            } else {
                foreach ($model->errors as $messages){
                    foreach ($messages as $message) Yii::$app->session->addFlash('danger', $message);
                }
            }
        }

        return $this->render('league', ['page' => $page, 'model' => $model]);
    }

    public function actionLocation()
    {
        $page = AdminPages::get('page-settings-location');

        $model = Yii::createObject(['class' => Locations::class, 'scenario' => Locations::SCENARIO_USER]);

        if($model->load(Yii::$app->request->post())){
            if($model->save()){
                Yii::$app->session->addFlash('success', Yii::t('rus', 'Данные отправлены на модерацию'));
                $this->sendMailAdmin(Yii::t('rus', 'Отправлен запрос на создание локации «{0}»', [$model->name]));
            } else {
                foreach ($model->errors as $messages){
                    foreach ($messages as $message) Yii::$app->session->addFlash('danger', $message);
                }
            }
        }

        return $this->render('location', ['page' => $page, 'model' => $model]);
    }

    public function actionEvents()
    {

    }

    protected function sendMailAdmin($msg)
    {
        Yii::$app->mailer->compose()
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setTo(Yii::$app->params['adminEmail'])
            ->setSubject($msg)
            ->setTextBody($msg)
            ->send();
    }
}