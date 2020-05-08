<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://fonts.googleapis.com/css?family=Nunito:300,400,700',
        'fonts/flaticon/font/flaticon.css',
        //'css/bootstrap.min.css',
        'scss/style.css',
    ];
    public $js = [
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'yii\bootstrap4\BootstrapAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
        'grozzzny\depends\jquery_ui\JqueryUiAsset',
        'grozzzny\depends\popper\PopperAsset',
        'grozzzny\depends\owl_carousel\OwlAsset',
        'grozzzny\depends\countdown\CountdownAsset',
        'grozzzny\depends\bootstrap_datepicker\BootstrapDatepickerAsset',
        'grozzzny\depends\easing\EasingAsset',
        'grozzzny\depends\aos\AosAsset',
        'grozzzny\depends\fancybox\FancyboxAsset',
        'grozzzny\depends\sticky\StickyAsset',
        'grozzzny\depends\icomoon\IcomoonAsset',
    ];
}
