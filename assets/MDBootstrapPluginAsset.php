<?php


namespace app\assets;


class MDBootstrapPluginAsset extends \grozzzny\depends\mdbootstrap\MDBootstrapPluginAsset
{
    public $depends = [
        'app\assets\MDBootstrapAsset',
        'grozzzny\depends\popper\PopperAsset',
    ];
}
