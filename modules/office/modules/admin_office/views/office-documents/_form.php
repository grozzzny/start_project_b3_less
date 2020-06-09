<?php

use app\modules\office\models\OfficeAccount;
use app\modules\office\widgets\date_time_picker\DateTimePicker;
use app\modules\office\widgets\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\office\models\OfficeDocuments */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="office-documents-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'case_id')->textInput() ?>

            <?= $form->field($model, 'client_id')->textInput() ?>

            <?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'datetime_act')->widget(DateTimePicker::class)?>

            <?= $form->field($model, 'category_act')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'file')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'court_id')->textInput() ?>

            <?= $form->field($model, 'term_appeal')->textInput() ?>

            <?= $form->field($model, 'result')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $this->render('../_detail_view_account', ['model' => $model])?>

            <?= $this->render('../_detail_view_created', ['model' => $model])?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('rus', 'Сохранить'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
