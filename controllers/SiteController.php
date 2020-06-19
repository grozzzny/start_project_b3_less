<?php

namespace app\controllers;

use app\models\Events;
use app\models\Teames;
use grozzzny\admin\modules\pages\models\AdminPages;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'location' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $page = AdminPages::get('page-index');

        $teames = Teames::find()
            ->andWhere(['active' => true])
            ->orderBy(['created_at' => SORT_DESC])
            ->limit(4)
            ->all();

        $events = Events::find()
            ->andWhere(['active' => true])
            ->andWhere(['loaction_id' => Yii::$app->user->selectedLocation->id])
            ->andWhere(['>=', 'time_to', time()])
            ->orderBy(['created_at' => SORT_DESC])
            ->limit(3)
            ->all();

        return $this->render('index', ['page' => $page, 'teames' => $teames, 'events' => $events]);
    }

    public function actionLocation()
    {
        $location_id = Yii::$app->request->post('location_id');

        Yii::$app->user->setCookieLocation($location_id);

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionCreate()
    {
        $this->layout = 'main_with_container';

        $model = Yii::createObject(['class' => Teames::class, 'scenario' => Teames::SCENARIO_CREATE]);

        if(!Yii::$app->user->isGuest) {
            if(!empty(Yii::$app->user->identity->team)) throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
            $model->email = Yii::$app->user->identity->email;
        }

        if($model->load(Yii::$app->request->post())){
            if(!$model->save()) {
                Yii::error(json_encode($model->errors, JSON_UNESCAPED_UNICODE));
                Yii::$app->session->setFlash('danger', Yii::t('rus', 'Ошибка в сохранении'));
            } else {
                return $this->redirect(['/']);
            }
        }

        $page = AdminPages::get('site-create-team');

        return $this->render('create', ['model' => $model, 'page' => $page]);
    }
}
