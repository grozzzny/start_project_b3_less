<?php

use app\modules\office\models\OfficeAccount;
use app\modules\office\widgets\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\office\models\OfficeComments */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="office-comments-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'task_id')->textInput() ?>

            <?= $form->field($model, 'case_id')->textInput() ?>

            <?= $form->field($model, 'client_id')->textInput() ?>

            <?= $form->field($model, 'document_id')->textInput() ?>

            <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>
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
