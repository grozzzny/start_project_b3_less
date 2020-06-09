<?php

use app\modules\office\models\OfficeAccount;
use app\modules\office\models\OfficeCase;
use app\modules\office\models\OfficeClients;
use app\modules\office\models\OfficeEmployee;
use app\modules\office\widgets\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\modules\office\models\OfficeCase */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="office-case-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'client_id')->widget(Select2::className(), ['data' => OfficeClients::map($model->account_id)]) ?>

            <?= $form->field($model, 'category')->widget(Select2::className(), [
                'data' => OfficeCase::categories(),
                'pluginEvents' => ['change' => 'changeCategoryCase']
            ]) ?>

            <?= $form->field($model, 'object_category')->widget(Select2::className(), [
                'data' => current(OfficeCase::objectsCategory())
            ]) ?>

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

<?
$this->registerJsVar('data_object_category', OfficeCase::objectsCategoryFormat());

$js = <<<JS
    var changeCategoryCase = function() {
        var select = $(this),
        select_object_category = $("#officecase-object_category");
        
        select_object_category.empty();
        
        $.each(data_object_category[select.val()], function(i, ob) {
          select_object_category.append("<option value='"+ob.id+"'>"+ob.text+"</option");
        });
        
        select_object_category.trigger("change");
    }
JS;
$this->registerJs($js, View::POS_END);
?>