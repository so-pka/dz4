<?php
namespace app\assets;

use yii\web\AssetBundle;

class CssAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/admin/web';

    public $css = [
        'site.css',
    ];
    public $js = [
//        'js/admin.js',
    ];

    public $depends = [];
}