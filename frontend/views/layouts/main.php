<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
/* 动态添加js */
if (Url::to("/user/index") === Url::current()){
    AppAsset::addScript($this,'@web/mutui/vendors/flot/jquery.flot.js');
    AppAsset::addScript($this,'@web/mutui/vendors/flot/jquery.flot.pie.js');
    AppAsset::addScript($this,'@web/mutui/demo/js/flot-charts/chart-tooltips.js');
    AppAsset::addScript($this,'@web/mutui/demo/js/flot-charts/pie.js');
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body data-ma-theme="green">
<?php $this->beginBody() ?>
<main class="main">
    <!-- 刷新加载的loading图片-->
    <?php echo $this->render('@app/views/common/loader.php');?>
    <header class="header">
        <div class="header__logo hidden-sm-down">
            <h1><a href="<?= Url::to(['index/index']); ?>">赵日天实验室</a></h1>
        </div>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link nav-text active" href="<?= Url::to(['article/index']); ?>">文章详情</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-text " href="<?= Url::to(['public/login']); ?>">登陆注册</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-text " href="">名人专题</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-text" href="">其他</a>
            </li>
        </ul>
        <ul class="top-nav">
            <!-- 搜索图标-->
            <li class="hidden-xl-up"><a href="" data-ma-action="search-open"><i class="zmdi zmdi-search"></i></a></li>
            <li class="dropdown top-nav__notifications">
                <!-- 铃铛 红点-->
                <a href="" data-toggle="dropdown" class="top-nav__notify">
                    <i class="zmdi zmdi-notifications"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu--block">
                    <!-- 通知栏标题-->
                    <div class="listview listview--hover">
                        <div class="listview__header">
                             通知消息
                            <div class="actions">
                                <a href="" class="actions__item zmdi zmdi-check-all" data-ma-action="notifications-clear"></a>
                            </div>
                        </div>
                        <!-- 通知列表内容-->
                        <div class="listview__scroll scrollbar-inner">
                            <a href="" class="listview__item">
                                <img src="mutui/demo/img/profile-pics/5.jpg" class="listview__img" alt="">
                                <div class="listview__content">
                                    <div class="listview__heading">Bill Phillips</div>
                                    <p>Proin laoreet commodo eros id faucibus. Donec ligula quam, imperdiet vel ante placerat</p>
                                </div>
                            </a>
                            <a href="" class="listview__item">
                                <img src="mutui/demo/img/profile-pics/1.jpg" class="listview__img" alt="">

                                <div class="listview__content">
                                    <div class="listview__heading">David Belle</div>
                                    <p>Cum sociis natoque penatibus et magnis dis parturient montes</p>
                                </div>
                            </a>
                        </div>
                        <div class="p-1"></div>
                    </div>
                </div>
            </li>
            <li class="dropdown hidden-xs-down">
                <!-- 用户信息-->
                <div class="user__info" data-toggle="dropdown">
                    <img class="user__img" src="mutui/demo/img/profile-pics/8.jpg" alt="">
                    <div>
                        <div class="user__name" style="color: snow">小塞塞</div>
                        <div class="user__email" style="color: snow">等级:V1</div>
                    </div>
                </div>
                <!-- 用户操作菜单-->
                <div class="dropdown-menu dropdown-menu-right dropdown-menu--block" role="menu">
                    <div class="row app-shortcuts">
                        <a class="col-4 app-shortcuts__item" href="<?= Url::to(['user/index']); ?>">
                            <i class="zmdi zmdi-account-o"></i>
                            <small class="">个人中心</small>
                            <span class="app-shortcuts__helper bg-red"></span>
                        </a>
                        <a class="col-4 app-shortcuts__item" href="">
                            <i class="zmdi zmdi-file-text"></i>
                            <small class="">待定</small>
                            <span class="app-shortcuts__helper bg-blue"></span>
                        </a>
                        <a class="col-4 app-shortcuts__item" href="">
                            <i class="zmdi zmdi-power"></i>
                            <small class="">退出登陆</small>
                            <span class="app-shortcuts__helper bg-teal"></span>
                        </a>
                    </div>
                </div>
            </li>
        </ul>
    </header>
    <!-- 错误报告 -->
    <?= Alert::widget() ?>
    <section class="content">
    <?= $content ?>
    </section>
</main>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>
<!-- Older IE warning message -->
<!--[if IE]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade to any of the following web browsers to access this website.</p>
    <div class="ie-warning__downloads">
        <a href="http://www.google.com/chrome">
            <img src="img/browsers/chrome.png" alt="">
        </a>
        <a href="https://www.mozilla.org/en-US/firefox/new">
            <img src="img/browsers/firefox.png" alt="">
        </a>
        <a href="http://www.opera.com">
            <img src="img/browsers/opera.png" alt="">
        </a>
        <a href="https://support.apple.com/downloads/safari">
            <img src="img/browsers/safari.png" alt="">
        </a>
        <a href="https://www.microsoft.com/en-us/windows/microsoft-edge">
            <img src="img/browsers/edge.png" alt="">
        </a>
        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
            <img src="img/browsers/ie.png" alt="">
        </a>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
