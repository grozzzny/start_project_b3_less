<?php

namespace app\controllers;

use grozzzny\admin\modules\pages\models\AdminPages;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{
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

        return $this->render('index', ['page' => $page]);
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
