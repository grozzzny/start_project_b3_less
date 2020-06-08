<?php


namespace app\modules\office\widgets\date_time_picker;


class DateTimePicker extends \kartik\datetime\DateTimePicker
{
    public $bsVersion = '4';

    public $options = [
        'placeholder'=>'__.__.____ __:__',
        'autocomplete' => 'off'
    ];

    public $pluginOptions = [
        'format' => 'dd.mm.yyyy HH:ii',
    ];
}