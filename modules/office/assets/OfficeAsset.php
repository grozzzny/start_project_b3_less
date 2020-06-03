<?php


namespace app\modules\office\assets;

class OfficeAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@app/modules/office/assets';

    public $css = [

    ];

    public $js = [

    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
        'grozzzny\depends\fontawesome5\FontAwesome5Asset',
    ];
}