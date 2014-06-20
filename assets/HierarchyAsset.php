<?php
/**
 * Author: Abramov A. aka MUTOgen
 *
 */

namespace mutogen\rbacw\assets;

use yii\web\AssetBundle;

class HierarchyAsset extends AssetBundle
{
    public $sourcePath = '@vendor/mutogen/yii2-rbac-widget';
    public $css = [];
    public $js = [
        'js/rbac-h.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
