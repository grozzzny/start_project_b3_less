<?php


namespace app\controllers;


use app\models\Events;
use grozzzny\admin\modules\pages\models\AdminPages;
use Yii;
use yii\data\ActiveDataProvider;
use yii\debug\models\search\Event;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class EventsController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['add-team', 'delete-team'],
                        'roles' => ['@'],
                        'verbs' => ['post'],
                        'matchCallback' => function ($rule, $action){
                            return !empty(Yii::$app->user->identity->team);
                        }
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $page = AdminPages::get('page-events');

        $query = Events::find()->where(['active' => true])->andWhere(['loaction_id' => Yii::$app->user->selectedLocation->id]);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['time_from'=>SORT_ASC]],
            'pagination' => ['pageSize' => 50],
        ]);

        return $this->render('index', ['page' => $page, 'provider' => $provider]);
    }

    public function actionView($id)
    {
        $model = Events::find()->andWhere(['active' => true, 'id' => $id])->one();

        if(empty($model)) throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));

        $code = Yii::$app->request->post('code');

        if($code == $model->code){
            $images = $model->images;
        } else {
            $images = [];
        }

        return $this->render('view', ['model' => $model, 'images' => $images]);
    }

    public function actionAddTeam($id)
    {
        $model = Events::findOne($id);

        if(!$model->isOpenRegistration)  throw new ForbiddenHttpException(Yii::t('rus', 'Регистрация на участие закончена. Действие запрещено'));

        $model->link('teames', Yii::$app->user->identity->team);

        return $this->redirect(['/events/'.$model->id]);
    }

    public function actionDeleteTeam($id)
    {
        $model = Events::findOne($id);

        if(!$model->isOpenRegistration)  throw new ForbiddenHttpException(Yii::t('rus', 'Регистрация на участие закончена. Действие запрещено'));

        $model->unlink('teames', Yii::$app->user->identity->team, true);

        return $this->redirect(['/events/'.$model->id]);
    }
}
