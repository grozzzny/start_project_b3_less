<?php

use app\models\User;
use app\modules\office\modules\admin_office\AdminOfficeModule;
use app\modules\office\widgets\date_picker\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\office\models\OfficeAccount */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="office-account-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'owner_id')->widget(Select2::className(), ['data' => User::map()]) ?>

    <?= $form->field($model, 'active')->checkbox(AdminOfficeModule::checkboxSettings()) ?>

    <?= $form->field($model, 'active_at')->widget(DatePicker::class) ?>

    <?= $this->render('../_detail_view_created', ['model' => $model])?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('rus', 'Сохранить'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
