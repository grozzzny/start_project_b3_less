<?php

use app\modules\office\models\OfficeAccount;
use app\modules\office\models\OfficeClients;
use app\modules\office\models\OfficeConsultation;
use app\modules\office\models\OfficeEmployee;
use app\modules\office\widgets\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\office\models\OfficeConsultation */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="office-consultation-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'client_id')->widget(Select2::className(), [
                'data' => OfficeClients::map($model->account_id),
                'pluginOptions' => [
                    'allowClear' => true,
                    'placeholder' => Yii::t('rus', 'Выберите значение'),
                ],
            ]) ?>

            <?= $form->field($model, 'cost')->input('number') ?>

            <?= $form->field($model, 'type')->widget(Select2::className(), ['data' => OfficeConsultation::types()]) ?>

            <?= $form->field($model, 'curator_id')->widget(Select2::className(), [
                'data' => OfficeEmployee::map($model->account_id),
                'pluginOptions' => [
                    'allowClear' => true,
                    'placeholder' => Yii::t('rus', 'Выберите значение'),
                ],
            ]) ?>
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
