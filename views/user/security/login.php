<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use Da\User\Widget\ConnectWidget;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/**
 * @var yii\web\View            $this
 * @var \Da\User\Form\LoginForm $model
 * @var \Da\User\Module         $module
 */

$this->title = Yii::t('usuario', 'Sign in');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/shared/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="text-center">
    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
</div>
<div class="text-center">
    <?php $form = ActiveForm::begin(
        [
            'id' => $model->formName(),
            'enableAjaxValidation' => true,
            'enableClientValidation' => false,
            'validateOnBlur' => false,
            'validateOnType' => false,
            'validateOnChange' => false,
            'options' => ['class' => 'form-theme-narrow text-left']
        ]
    ) ?>

    <?= $form->field(
        $model,
        'login',
        ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']]
    ) ?>

    <?= $form
        ->field(
            $model,
            'password',
            ['inputOptions' => ['class' => 'form-control', 'tabindex' => '2']]
        )
        ->passwordInput()
        ->label(
            Yii::t('usuario', 'Password')
            . ($module->allowPasswordRecovery ?
                ' (' . Html::a(
                    Yii::t('usuario', 'Forgot password?'),
                    ['/user/recovery/request'],
                    ['tabindex' => '5']
                )
                . ')' : '')
        ) ?>

    <?= $form->field($model, 'rememberMe')->checkbox(['tabindex' => '4']) ?>

    <?= Html::submitButton(
        Yii::t('usuario', 'Sign in'),
        ['class' => 'btn btn-yellow btn-block', 'tabindex' => '3']
    ) ?>

    <?php if ($module->enableEmailConfirmation): ?>
        <br>
        <p class="text-center">
            <?= Html::a(
                Yii::t('usuario', 'Didn\'t receive confirmation message?'),
                ['/user/registration/resend']
            ) ?>
        </p>
    <?php endif ?>
    <?php if ($module->enableRegistration): ?>
        <p class="text-center">
            <?= Html::a(Yii::t('usuario', 'Don\'t have an account? Sign up!'), ['/user/registration/register']) ?>
        </p>
    <?php endif ?>
    <?= ConnectWidget::widget(
        [
            'baseAuthUrl' => ['/user/security/auth'],
        ]
    ) ?>

    <?php ActiveForm::end(); ?>
</div>
