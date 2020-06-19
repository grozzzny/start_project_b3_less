<?php


namespace app\controllers;


use app\models\Teames;
use grozzzny\admin\modules\pages\models\AdminPages;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class TeamesController extends Controller
{
    public function actionIndex()
    {
        $page = AdminPages::get('page-teames');

        $query = Teames::find()->where(['active' => true]);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['created_at'=>SORT_DESC]],
            'pagination' => ['pageSize' => 50],
        ]);

        return $this->render('index', ['page' => $page, 'provider' => $provider]);
    }
}
