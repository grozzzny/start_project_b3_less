<?php

namespace app\modules\racing;

/**
 * racing module definition class
 */
class RacingModule extends \yii\base\Module
{
    public $defaultRoute = 'events';
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\racing\controllers';

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
