<?php


namespace app\controllers;


use grozzzny\admin\modules\pages\models\AdminPages;
use yii\web\Controller;

class RatingController extends Controller
{
    public function actionIndex()
    {
        $page = AdminPages::get('page-rating');

        return $this->render('index', ['page' => $page]);
    }
}
