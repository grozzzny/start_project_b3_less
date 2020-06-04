<?php

namespace app\modules\office\modules\admin_office\controllers;

use yii\web\Controller;

/**
 * Default controller for the `admin_office` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
