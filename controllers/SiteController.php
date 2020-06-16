<?php

namespace app\controllers;

use app\modules\office\models\OfficeAccount;
use grozzzny\admin\modules\pages\models\AdminPages;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
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

        return $this->render('index', ['page' => $page]);
    }


    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionCreate()
    {
        $this->layout = 'main_with_container';

        $model = Yii::createObject(['class' => OfficeAccount::class, 'scenario' => OfficeAccount::SCENARIO_CREATE]);

        if(!Yii::$app->user->isGuest) {
            if(!empty(Yii::$app->user->identity->officeAccount)) throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
            $model->email = Yii::$app->user->identity->email;
        }

        if($model->load(Yii::$app->request->post())){
            if(!$model->save()) {
                Yii::error(json_encode($model->errors, JSON_UNESCAPED_UNICODE));
                Yii::$app->session->setFlash('danger', Yii::t('rus', 'Ошибка в сохранении'));
            } else {
                return $this->redirect(['/office']);
            }
        }


        $page = AdminPages::get('site-create-account');

        return $this->render('create', ['model' => $model, 'page' => $page]);
    }
}
