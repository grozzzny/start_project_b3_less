<?php

use app\modules\office\models\OfficeAccount;
use app\modules\office\models\OfficeCase;
use app\modules\office\models\OfficeClients;
use app\modules\office\models\OfficeEmployee;
use app\modules\office\widgets\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\office\models\OfficeCase */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="office-case-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'account_id')->widget(Select2::className(), ['data' => OfficeAccount::map()]) ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'client_id')->widget(Select2::className(), ['data' => OfficeClients::map()]) ?>

    <?= $form->field($model, 'category')->widget(Select2::className(), ['data' => OfficeCase::categories()]) ?>

    <?= $form->field($model, 'object_category')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'curator_id')->widget(Select2::className(), ['data' => OfficeEmployee::map()]) ?>

    <?= $this->render('../_detail_view_created', ['model' => $model])?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('rus', 'Сохранить'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
