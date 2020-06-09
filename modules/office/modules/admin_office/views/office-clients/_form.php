<?php

use app\modules\office\models\OfficeAccount;
use app\modules\office\widgets\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

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

            <?= $form->field($model, 'date_of_birth')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'place_of_birth')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'place_registration')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'place_residence')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'passport_number')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'passport_date')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'passport_institution')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'passport_photo')->textInput(['maxlength' => true]) ?>
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
