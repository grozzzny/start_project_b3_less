<?php


namespace app\controllers;


use app\models\League;
use app\models\Rating;
use grozzzny\admin\modules\pages\models\AdminPages;
use Yii;
use yii\web\Controller;

class RatingController extends Controller
{
    public function actionIndex()
    {
        $page = AdminPages::get('page-rating');

        $arr_ratings = [];

        foreach (League::find()->andWhere(['active' => true])->all() as $league){
            $arr_ratings[] = [
                'name' => $league->name,
                'models' => Rating::find()
                    ->select(['rating.id', 'event_id', 'team_id', 'value' => 'sum(value)'])
                    ->groupBy('team_id')
                    ->joinWith('event')
                    ->andWhere(['loaction_id' => Yii::$app->user->selectedLocation->id])
                    ->all()
            ];
        }

        return $this->render('index', ['page' => $page, 'arr_ratings' => $arr_ratings]);
    }
}
