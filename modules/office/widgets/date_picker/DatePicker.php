<?php


namespace app\modules\office\widgets\date_picker;


class DatePicker extends \kartik\date\DatePicker
{
    public $bsVersion = '4';

    public $options = [
        'placeholder'=>'__.__.____',
        'autocomplete' => 'off'
    ];

    public $pluginOptions = [
        'format' => 'dd.mm.yyyy',
    ];
}