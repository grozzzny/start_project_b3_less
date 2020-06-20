<?php


namespace app\controllers;


use app\models\Teames;
use grozzzny\admin\modules\pages\models\AdminPages;
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
}