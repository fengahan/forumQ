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
        //  Vendor styles
        'mutui/vendors/material-design-iconic-font/css/material-design-iconic-font.min.css',
        'mutui/vendors/animate.css/animate.min.css',
        'mutui/vendors/jquery-scrollbar/jquery.scrollbar.css',
        //App styles
        'css/style.css',
        'mutui/css/app.min.css',
    ];
    public $js = [
        //Javascript Vendors
        'mutui/vendors/jquery/jquery.min.js',
        'mutui/vendors/popper.js/popper.min.js',
        'mutui/vendors/bootstrap/js/bootstrap.min.js',
        'mutui/vendors/jquery-scrollbar/jquery.scrollbar.min.js',
        'mutui/vendors/jquery-scrollLock/jquery-scrollLock.min.js',
        //App functions and actions
        'mutui/js/app.min.js',
    ];

    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];

    /**
     * 添加js
     * @param $view
     * @param $jsFile
     */
    public static function addScript($view, $jsFile)
    {
        $view->registerJsFile($jsFile, [AppAsset::className(), 'depends' => 'frontend\assets\AppAsset']);
    }
}
