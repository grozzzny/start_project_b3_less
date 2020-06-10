<?php


namespace app\modules\office\components;


use Yii;

class FileBehavior extends \grozzzny\admin\widgets\file_input\components\FileBehavior
{
    protected function uploadPath()
    {
        return strtr($this->uploadPath, [
            '{account_id}' => $this->owner->account_id,
        ]);
    }
}