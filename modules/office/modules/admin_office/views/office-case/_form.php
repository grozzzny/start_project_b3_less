<?php

use app\modules\office\models\OfficeCase;
use app\modules\office\models\OfficeClients;
use app\modules\office\models\OfficeCourts;
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

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'client_id')->widget(Select2::className(), [
                'data' => OfficeClients::map($model->account_id),
                'pluginOptions' => [
                    'allowClear' => true,
                    'placeholder' => Yii::t('rus', 'Выберите значение'),
                ],
            ]) ?>

            <?= $form->field($model, 'category')->widget(Select2::className(), [
                'data' => OfficeCase::categories(),
                'pluginEvents' => ['change' => 'changeCategoryCase']
            ]) ?>

            <div data-category="<?= OfficeCase::CATEGORY_CIVIL?>">
                <?= $form->field($model, 'civil_plaintiff')->textInput() ?>
                <?= $form->field($model, 'civil_respondent')->textInput() ?>
                <?= $form->field($model, 'civil_subject_dispute')->textarea() ?>
                <?= $form->field($model, 'civil_court_id')->widget(Select2::className(), ['data' => OfficeCourts::map($model->account_id)]) ?>
            </div>

            <div data-category="<?= OfficeCase::CATEGORY_CRIMINAL?>">
                <?= $form->field($model, 'criminal_suspect')->textInput() ?>
                <?= $form->field($model, 'criminal_victim')->textInput() ?>
                <?= $form->field($model, 'criminal_essence_charge')->textarea() ?>
                <?= $form->field($model, 'criminal_stage')->widget(Select2::className(), ['data' => OfficeCase::stages()]) ?>
                <?= $form->field($model, 'criminal_court_id')->widget(Select2::className(), ['data' => OfficeCourts::map($model->account_id)]) ?>
            </div>

            <div data-category="<?= OfficeCase::CATEGORY_EXECUTION?>">
                <?= $form->field($model, 'execution_recoverer')->textInput() ?>
                <?= $form->field($model, 'execution_debtor')->textInput() ?>
                <?= $form->field($model, 'execution_bailiff_service')->textInput() ?>
                <?= $form->field($model, 'execution_subject_execution')->textarea() ?>
            </div>

            <div data-category="<?= OfficeCase::CATEGORY_ADMINISTRATIVE?>">
                <?= $form->field($model, 'administrative_plaintiff')->textInput() ?>
                <?= $form->field($model, 'administrative_respondent')->textInput() ?>
                <?= $form->field($model, 'administrative_offender')->textInput() ?>
                <?= $form->field($model, 'administrative_court_id')->widget(Select2::className(), ['data' => OfficeCourts::map($model->account_id)]) ?>
                <?= $form->field($model, 'administrative_subject_dispute')->textarea() ?>
            </div>

            <div data-category="<?= OfficeCase::CATEGORY_INSTRUCTION?>">
                <?= $form->field($model, 'instruction_applicant')->textInput() ?>
                <?= $form->field($model, 'instruction_essence_order')->textarea() ?>
            </div>

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

<? OfficeCase::registerJsChangeCategory($model); ?>