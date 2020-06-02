<?php


namespace app\controllers;


use grozzzny\admin\modules\pages\models\AdminPages;
use yii\web\Controller;

class PoliticaController extends Controller
{

    public function actionIndex()
    {
        $page = AdminPages::get('page-politica');

        return $this->render('index', ['page' => $page]);
    }

}