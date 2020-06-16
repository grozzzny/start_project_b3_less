<?php

namespace app\modules\office;

use Yii;
use yii\filters\AccessControl;

/**
 * office module definition class
 */
class OfficeModule extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\office\controllers';

    public $layout = 'main';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            return !empty(Yii::$app->user->selectedEmploee);
                        }
                    ],
                ],
            ],
        ];
    }
}
