<?php

use app\modules\office\models\OfficeTransaction;
use app\modules\office\widgets\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\office\models\OfficeAccounting */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="office-accounting-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'cost')->input('number') ?>

            <?= $form->field($model, 'type')->widget(Select2::className(), ['data' => OfficeTransaction::types()]) ?>

            <?= $form->field($model, 'note')->textarea() ?>

            <?= $form->field($model, 'target')->textarea() ?>

            <?= $form->field($model, 'transaction_id')->input('number')->label(Yii::t('rus', 'Идентификатор связаной транзакции')) ?>
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
