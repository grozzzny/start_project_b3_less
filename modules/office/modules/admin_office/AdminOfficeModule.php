<?php

namespace app\modules\office\modules\admin_office;

/**
 * admin_office module definition class
 */
class AdminOfficeModule extends \yii\base\Module
{
    public $defaultRoute = 'office-account';

    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\office\modules\admin_office\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
