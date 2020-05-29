<?php

use grozzzny\admin\modules\feedback\widgets\form\FeedbackFormWidget;
use grozzzny\admin\modules\text\LiveEditText;
use yii\bootstrap4\Alert;
use yii\bootstrap4\Html;
use yii\web\View;
use yii\widgets\MaskedInput;

/**
 * @var View $this
 */

?>

<? $form = FeedbackFormWidget::begin([
    'options' => ['class' => 'p-5 bg-white'],
    'fieldConfig' => [
        'options' => ['class' => ['widget' => '']],
        'template' => "{label}\n{input}\n{hint}\n{error}",
        'labelOptions' => ['class' => 'text-black'],
        'inputOptions' => ['class' => 'form-control rounded-0'],
    ]
])?>
    <h2 class="h4 text-black mb-5">
        <?=LiveEditText::widget(['slug' => 'section-contact-form-heading', 'label' => Yii::t('rus', 'Форма обратной связи')])?>
    </h2>

    <div class="row form-group">
        <div class="col-md-6 mb-3 mb-md-0">
            <?= $form->fieldActive('name')->label(Yii::t('rus', 'Ваше имя'))?>
        </div>
        <div class="col-md-6">
            <?= $form->fieldActive('email')?>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-12">
            <?= $form->fieldActive('phone')
                ->widget(MaskedInput::className(),['mask'=>'+7 (999) 999-99-99'])
                ->textInput(['placeholder'=>'+7 (___) ___-__-__']);
            ?>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-12">
            <?= $form->fieldActive('message')->textarea([
                'cols' => 30,
                'rows' => 7,
                'placeholder' => Yii::t('rus', 'Оставьте свое сообщение')
            ])?>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-12">
            <?= Alert::widget([
                'options' => [
                    'class' => 'alert-success rounded-0 mb-0 js-alert',
                    'style' => 'display: none;',
                ],
                'closeButton' => false,
                'body' => Yii::t('rus', 'Ваша заявка принята')
            ])?>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-12">
            <?= Html::submitButton(Yii::t('rus', 'Отправить сообщение'), ['class' => 'btn btn-primary mr-2 mb-2'])?>
        </div>
    </div>

<? FeedbackFormWidget::end()?>