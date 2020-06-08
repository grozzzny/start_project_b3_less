<?php

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
            'created_by',
            'updated_by',
        ]
    ])?>
</div>