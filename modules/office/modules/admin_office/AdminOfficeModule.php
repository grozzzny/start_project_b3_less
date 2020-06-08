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

    public static function checkboxSettings()
    {
        return [
            'labelOptions' => ['class' => 'custom-control-label'],
            'options' => ['class' => 'custom-control-input'],
            'template' => "<div class=\"custom-control custom-switch\">{input} {label}</div><div>{error}</div>",
        ];
    }
}
