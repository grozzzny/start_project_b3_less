<?php


namespace app\controllers;


use app\models\Events;
use app\models\League;
use app\models\Locations;
use app\models\Teames;
use grozzzny\admin\modules\pages\models\AdminPages;
use phpDocumentor\Reflection\Location;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

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
        $page = AdminPages::get('page-settings-events');

        $query = Yii::$app->user->identity->getEvents();

        $provider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['time_from'=>SORT_DESC]],
            'pagination' => ['pageSize' => 50],
        ]);

        return $this->render('events', ['page' => $page, 'provider' => $provider]);
    }

    public function actionEventCreate()
    {
        $page = AdminPages::get('page-settings-event-create');

        $model = Yii::createObject(['class' => Events::class, 'scenario' => Events::SCENARIO_USER, 'active' => true]);

        if($model->load(Yii::$app->request->post())){
            if($model->save()){
                $this->sendMailAdmin(Yii::t('rus', 'Создано событие «{0}»', [$model->name]));
                return $this->redirect(['/settings/events']);
            } else {
                foreach ($model->errors as $messages){
                    foreach ($messages as $message) Yii::$app->session->addFlash('danger', $message);
                }
            }
        }

        return $this->render('event-create', ['page' => $page, 'model' => $model]);
    }

    public function actionEventEdit($id)
    {
        $page = AdminPages::get('page-settings-event-edit');

        $model = Events::find()
            ->andWhere(['id' => $id])
            ->andWhere(['created_by' => Yii::$app->user->id])
            ->one();

        if(empty($model)) throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));

        if(!$model->isOpenEdit) throw new ForbiddenHttpException(Yii::t('rus', 'Доступ ограничен'));

        if($model->load(Yii::$app->request->post())){
            if($model->save()){
                return $this->redirect(['/settings/events']);
            } else {
                foreach ($model->errors as $messages){
                    foreach ($messages as $message) Yii::$app->session->addFlash('danger', $message);
                }
            }
        }

        return $this->render('event-edit', ['page' => $page, 'model' => $model]);
    }

    public function actionEventRating($id)
    {
        $page = AdminPages::get('page-settings-event-rating');

        $model = Events::find()
            ->andWhere(['id' => $id])
            ->andWhere(['created_by' => Yii::$app->user->id])
            ->one();

        if(empty($model)) throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));

        if(!$model->isOpenEdit) throw new ForbiddenHttpException(Yii::t('rus', 'Доступ ограничен'));

        $items = $model->ratingsTeames;

        if(empty($items)) throw new ForbiddenHttpException(Yii::t('rus', 'Команды не заявлены'));

        if(Yii::$app->request->isPost){
            $this->saveItems($items);
            return $this->redirect(['/settings/events']);
        }

        return $this->render('event-rating', ['page' => $page, 'model' => $model, 'items' => $items]);
    }

    public function actionEventPhoto($id)
    {
        $page = AdminPages::get('page-settings-event-photo');

        $model = Events::find()
            ->andWhere(['id' => $id])
            ->andWhere(['created_by' => Yii::$app->user->id])
            ->one();

        if(empty($model)) throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));

        if(!$model->isOpenEdit) throw new ForbiddenHttpException(Yii::t('rus', 'Доступ ограничен'));

        if(Yii::$app->request->isPost){
            $model->code = $model->generateCode();
            Events::updateAll(['code' => $model->code], ['id' => $model->id]);
        }

        return $this->render('event-photo', ['page' => $page, 'model' => $model]);
    }

    public function actionEventDelete($id)
    {
        $model = Events::find()
            ->andWhere(['id' => $id])
            ->andWhere(['created_by' => Yii::$app->user->id])
            ->one();

        if(empty($model)) throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));

        if(!$model->isOpenRegistration) throw new ForbiddenHttpException(Yii::t('rus', 'Доступ ограничен'));

        $model->delete();
        $this->sendMailAdmin(Yii::t('rus', 'Событие было удалено «{0}»', [$model->name]));

        return $this->redirect(['/settings/events']);
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

    public function saveItems($items)
    {
        $dataItems = Yii::$app->request->post('Rating', []);

        foreach ($items as $i => $model) {
            $model->setAttributes($dataItems[$i]);
            $model->save();
        }
    }
}