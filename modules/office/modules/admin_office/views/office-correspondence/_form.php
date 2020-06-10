<?php

use app\modules\office\models\OfficeAccount;
use app\modules\office\models\OfficeCase;
use app\modules\office\models\OfficeConsultation;
use app\modules\office\models\OfficeCorrespondence;
use app\modules\office\models\OfficeDocuments;
use app\modules\office\models\OfficeEmployee;
use app\modules\office\models\Relation;
use app\modules\office\widgets\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\office\models\OfficeCorrespondence */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="office-correspondence-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'relation')->widget(Select2::className(), [
                'data' => OfficeCorrespondence::relations(),
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

            <?= $form->field($model, 'employee_id')->widget(Select2::className(), ['data' => OfficeEmployee::map($model->account_id)]) ?>

            <?= $form->field($model, 'sender')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'recipient')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textarea() ?>

            <?= $form->field($model, 'mail_number')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'cost')->input('number') ?>
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