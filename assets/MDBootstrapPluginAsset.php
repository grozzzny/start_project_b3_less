<?php


namespace app\assets;


class MDBootstrapPluginAsset extends \grozzzny\depends\mdbootstrap\MDBootstrapPluginAsset
{
    public $depends = [
        'grozzzny\depends\mdbootstrap\MDBootstrapAsset',
        'grozzzny\depends\popper\PopperAsset',
    ];
}