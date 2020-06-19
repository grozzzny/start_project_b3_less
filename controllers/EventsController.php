<?php


namespace app\controllers;


use app\models\Events;
use grozzzny\admin\modules\pages\models\AdminPages;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class EventsController extends Controller
{
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
}
