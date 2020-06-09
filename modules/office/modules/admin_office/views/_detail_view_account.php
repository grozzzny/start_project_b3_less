<?php

use app\components\AccountTrait;
use yii\web\View;
use yii\widgets\DetailView;

/**
 * @var View $this
 * @var \yii\db\ActiveRecord $model
 */
?>

<div class="mb-3">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'account_id',
                'value' => function($model){
                    /** @var AccountTrait $model */
                    return $model->accountName;
                }
            ],
        ]
    ])?>
</div>

<hr>