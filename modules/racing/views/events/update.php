<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Events */
/* @var $items \app\models\Rating[] */

$this->title = Yii::t('app', 'Update Events: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>


<div class="row page-title-header">
    <div class="col-12">
        <div class="page-header">
            <h4 class="page-title"><?= Html::encode($this->title) ?></h4>
            <?= $this->render('../_menu')?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="events-update">

                    <?= $this->render('_form', [
                        'model' => $model,
                        'items' => $items,
                    ]) ?>

                </div>
            </div>
        </div>
    </div>
</div>
