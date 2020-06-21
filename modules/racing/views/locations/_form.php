<?php

use app\models\League;
use app\modules\racing\RacingModule;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Locations */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="locations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $this->render('../_detail_view_created', ['model' => $model])?>

    <?= $form->field($model, 'active')->checkbox(RacingModule::checkboxSettings()) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
