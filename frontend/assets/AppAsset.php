<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css',
        'css/style.css',
    ];
    public $js = [
        'https://code.jquery.com/jquery-3.3.1.js',
        'https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js',
        'js/jquery.pjax.js',
        'js/script.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        //'frontend\assets\SweetAlertAsset',
    ];
}
