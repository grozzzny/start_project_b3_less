<?php

use app\models\User;
use app\modules\office\models\OfficeAccount;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\office\models\OfficeEmployee */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="office-employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'account_id')->widget(Select2::className(), ['data' => OfficeAccount::map()]) ?>

    <?= $form->field($model, 'user_id')->widget(Select2::className(), ['data' => User::map()]) ?>

    <?= $form->field($model, 'role')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'priority')->textInput() ?>

    <?= $this->render('../_detail_view_created', ['model' => $model])?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('rus', 'Сохранить'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
