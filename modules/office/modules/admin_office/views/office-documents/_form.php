<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\office\models\OfficeDocuments */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="office-documents-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'account_id')->textInput() ?>

    <?= $form->field($model, 'case_id')->textInput() ?>

    <?= $form->field($model, 'client_id')->textInput() ?>

    <?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'datetime_act')->textInput() ?>

    <?= $form->field($model, 'category_act')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'court_id')->textInput() ?>

    <?= $form->field($model, 'term_appeal')->textInput() ?>

    <?= $form->field($model, 'result')->textInput(['maxlength' => true]) ?>

    <?= $this->render('../_detail_view_created', ['model' => $model])?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('rus', 'Сохранить'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
