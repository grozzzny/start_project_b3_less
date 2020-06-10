<?php

use app\models\User;
use app\modules\office\models\OfficeAccount;
use app\modules\office\models\OfficeEmployee;
use app\modules\office\widgets\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\office\models\OfficeEmployee */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="office-employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'user_id')->widget(Select2::className(), ['data' => User::map()]) ?>

            <?= $form->field($model, 'role')->widget(Select2::className(), ['data' => OfficeEmployee::roles()]) ?>

            <?= $form->field($model, 'full_name')->textInput() ?>

            <?= $form->field($model, 'priority')->input('number') ?>

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
