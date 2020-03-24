<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

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
        'mutui/vendors/select2/css/select2.min.css',
        'editor/css/editormd.css',
        'css/style.css',
        'mutui/css/app.min.css',
        'https://unpkg.com/tippy.js@6.1.0/themes/light-border.css'

    ];
    public $js = [
        //Javascript Vendors
        'https://cdn.bootcss.com/dropzone/5.5.1/min/dropzone.min.js',
        'mutui/vendors/jquery/jquery.min.js',
        'mutui/vendors/popper.js/popper.min.js',
        'mutui/vendors/bootstrap/js/bootstrap.min.js',
        'mutui/vendors/jquery-scrollbar/jquery.scrollbar.min.js',
        'mutui/vendors/jquery-scrollLock/jquery-scrollLock.min.js',
        "mutui/vendors/bootstrap-notify/bootstrap-notify.min.js",
        "mutui/vendors/sweetalert2/sweetalert2.min.js",
        //App functions and actions
        'js/func.js',
        'mutui/js/app.min.js',
        'mutui/vendors/select2/js/select2.full.min.js',

    ];

    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD,   // 这是设置所有js放置的位置
    ];

    /**
     * 添加js
     * @param $view View
     * @param $jsFile
     * @throws \yii\base\InvalidConfigException
     */
    public static function addScript($view, $jsFile)
    {
        $view->registerJsFile($jsFile, [AppAsset::class, 'depends' => 'frontend\assets\AppAsset']);
    }
}
