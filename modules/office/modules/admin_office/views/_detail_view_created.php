<?php

use app\components\BlameableTrait;
use app\modules\office\components\EmployeeTrait;
use yii\web\View;
use yii\widgets\DetailView;

/**
 * @var View $this
 * @var \yii\db\ActiveRecord $model
 */

if($model->isNewRecord) return;
?>

<div class="mb-3">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'created_at:datetime',
            'updated_at:datetime',
            [
                'attribute' => 'created_by',
                'value' => function($model){
                    /** @var BlameableTrait|EmployeeTrait $model */
                    if(!isset($model->createdEmployee)) return $model->createdByEmail;
                    $createdEmployee = $model->createdEmployee;
                    $data = [$model->createdByEmail];
                    if(!empty($createdEmployee)) $data[] = $createdEmployee->roleLabel;
                    return implode(' / ', $data);
                }
            ],
            [
                'attribute' => 'updated_by',
                'value' => function($model){
                    /** @var BlameableTrait|EmployeeTrait $model */
                    if(!isset($model->createdEmployee)) return $model->updatedByEmail;
                    $createdEmployee = $model->createdEmployee;
                    $data = [$model->updatedByEmail];
                    if(!empty($createdEmployee)) $data[] = $createdEmployee->roleLabel;
                    return implode(' / ', $data);
                }
            ],
        ]
    ])?>
</div>