<?php


namespace app\controllers;


use grozzzny\admin\modules\pages\models\AdminPages;
use yii\web\Controller;

class RuleController extends Controller
{
    public function actionIndex()
    {
        $page = AdminPages::get('page-rule');

        return $this->render('index', ['page' => $page]);
    }
}
