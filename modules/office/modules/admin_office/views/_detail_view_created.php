<?php

use app\components\BlameableTrait;
use yii\web\View;
use yii\widgets\DetailView;

/**
 * @var View $this
 * @var \yii\db\ActiveRecord $model
 */

?>

<hr>

<div class="mb-3">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'created_at:datetime',
            'updated_at:datetime',
            [
                'attribute' => 'created_by',
                'value' => function($model){
                    /** @var BlameableTrait $model */
                    return $model->createdByEmail;
                }
            ],
            [
                'attribute' => 'updated_by',
                'value' => function($model){
                    /** @var BlameableTrait $model */
                    return $model->updatedByEmail;
                }
            ],
        ]
    ])?>
</div>