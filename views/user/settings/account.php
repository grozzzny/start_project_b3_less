<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;

/**
 * @var yii\web\View               $this
 * @var yii\widgets\ActiveForm     $form
 * @var \Da\User\Form\SettingsForm $model
 */

$this->title = Yii::t('usuario', 'Account settings');
$this->params['breadcrumbs'][] = $this->title;

/** @var \Da\User\Module $module */
$module = Yii::$app->getModule('user');
?>
<div class="clearfix"></div>

<?= $this->render('/shared/_alert', ['module' => Yii::$app->getModule('user')]) ?>


<div class="row">
    <div class="col-md-3">
        <div class="my-3">
            <?= $this->render('/settings/_menu') ?>
        </div>
    </div>
    <div class="col-md-9">
        <div class="my-3">
            <h3 class="h3"><?= Html::encode($this->title) ?></h3>

            <?php $form = ActiveForm::begin(
                [
                    'id' => $model->formName(),
                    'options' => ['class' => 'form-horizontal'],
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                ]
            ); ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'username') ?>

            <?= $form->field($model, 'new_password')->passwordInput() ?>

            <hr/>

            <?= $form->field($model, 'current_password')->passwordInput() ?>

            <?= Html::submitButton(Yii::t('usuario', 'Save'), ['class' => 'btn btn-block btn-yellow']) ?>

            <?php ActiveForm::end(); ?>
        </div>

    </div>
</div>


