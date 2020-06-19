<?php


namespace app\widgets;


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
