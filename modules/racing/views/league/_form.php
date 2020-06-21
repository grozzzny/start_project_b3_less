<?php

use app\modules\racing\RacingModule;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\League */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="league-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->checkbox(RacingModule::checkboxSettings()) ?>

    <?= $this->render('../_detail_view_created', ['model' => $model])?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
