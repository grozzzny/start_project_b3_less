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
        'scss/style.css',
    ];
    public $js = [
        'js/scripts.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'yii\bootstrap4\BootstrapAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
        'grozzzny\depends\bootstrap_datepicker\BootstrapDatepickerAsset',
        'grozzzny\depends\fancybox\FancyboxAsset',
        'app\assets\MDBootstrapAsset',
        'app\assets\MDBootstrapPluginAsset',
        'grozzzny\depends\wow_animations\WowAnimationsAsset',
        'grozzzny\depends\jarallax\JarallaxAsset',
    ];
}
