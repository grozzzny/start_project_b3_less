<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\office\models\OfficeSession */

$this->title = Yii::t('rus', 'Добавить заседание');
$this->params['breadcrumbs'][] = ['label' => Yii::t('rus', 'Заседания'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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

                <div class="office-session-create">

                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>

                </div>

            </div>
        </div>
    </div>
</div>