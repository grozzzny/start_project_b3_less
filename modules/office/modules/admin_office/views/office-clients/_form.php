<?php

use app\modules\office\models\OfficeAccount;
use app\modules\office\widgets\date_picker\DatePicker;
use app\modules\office\widgets\select2\Select2;
use grozzzny\admin\widgets\file_input\ImageInputWidget;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\modules\office\models\OfficeClients */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="office-clients-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'date_of_birth')->widget(DatePicker::className()) ?>

            <?= $form->field($model, 'place_of_birth')->textarea() ?>

            <?= $form->field($model, 'place_registration')->textarea() ?>

            <?= $form->field($model, 'place_residence')->textarea() ?>

            <?= $form->field($model, 'passport_number')
                ->widget(MaskedInput::className(),['mask'=>'9999 999999'])
                ->textInput(['placeholder'=>'____ ______']);?>

            <?= $form->field($model, 'passport_date')->widget(DatePicker::className()) ?>

            <?= $form->field($model, 'passport_institution')->textarea() ?>

            <?= $form->field($model,'passport_code')
                ->widget(MaskedInput::className(),['mask'=>'999-999'])
                ->textInput(['placeholder'=>'___-___']);?>

            <?= $form->field($model, 'passport_photo')->widget(ImageInputWidget::className()) ?>
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
