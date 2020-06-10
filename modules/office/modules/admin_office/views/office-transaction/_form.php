<?php

use app\modules\office\models\OfficeAccount;
use app\modules\office\models\OfficeCase;
use app\modules\office\models\OfficeConsultation;
use app\modules\office\models\OfficeDocuments;
use app\modules\office\models\OfficeEmployee;
use app\modules\office\models\OfficeTransaction;
use app\modules\office\models\Relation;
use app\modules\office\modules\admin_office\AdminOfficeModule;
use app\modules\office\widgets\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\office\models\OfficeTransaction */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="office-transaction-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'relation')->widget(Select2::className(), [
                'data' => OfficeTransaction::relations(),
                'pluginEvents' => ['change' => 'changeRelations'],
            ]) ?>


            <div data-relation="<?= Relation::RELATION_CASE?>">
                <?= $form->field($model, 'case_id')->widget(Select2::className(), [
                    'data' => OfficeCase::map($model->account_id),
                    'pluginOptions' => [
                        'allowClear' => true,
                        'placeholder' => Yii::t('rus', 'Выберите значение'),
                    ],
                ]) ?>
            </div>
            <div data-relation="<?= Relation::RELATION_CONSULTATION?>">
                <?= $form->field($model, 'consultation_id')->widget(Select2::className(), [
                    'data' => OfficeConsultation::map($model->account_id),
                    'pluginOptions' => [
                        'allowClear' => true,
                        'placeholder' => Yii::t('rus', 'Выберите значение'),
                    ],
                ]) ?>
            </div>

            <?= $form->field($model, 'type')->widget(Select2::className(), ['data' => OfficeTransaction::types()]) ?>

            <?= $form->field($model, 'cost')->input('number') ?>

            <?= $form->field($model, 'is_account')->checkbox(AdminOfficeModule::checkboxSettings()) ?>

            <?= $form->field($model, 'employee_id')->widget(Select2::className(), [
                'data' => OfficeEmployee::map($model->account_id),
                'pluginOptions' => [
                    'allowClear' => true,
                    'placeholder' => Yii::t('rus', 'Выберите значение'),
                ],
            ]) ?>

            <?= $form->field($model, 'note')->textarea() ?>
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

<? Relation::registerJsChangeRelations($model); ?>
