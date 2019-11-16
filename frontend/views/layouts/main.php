<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
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
    //刷新加载的loading图片
    <div class="page-loader">
        <div class="page-loader__spinner">
            <svg viewBox="25 25 50 50">
                <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <header class="header">
        <div class="header__logo hidden-sm-down">
            <h1><a href="index.html">赵日天实验室</a></h1>
        </div>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link nav-text active" href="">问答</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-text " href="">技术分享</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-text " href="">名人专题</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-text" href="">其他</a>
            </li>
        </ul>
        <ul class="top-nav">
            <li class="hidden-xl-up"><a href="" data-ma-action="search-open"><i class="zmdi zmdi-search"></i></a></li>
            <li class="dropdown top-nav__notifications">
                <a href="" data-toggle="dropdown" class="top-nav__notify">
                    <i class="zmdi zmdi-notifications"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu--block">
                    <div class="listview listview--hover">
                        <div class="listview__header">
                            通知消息
                            <div class="actions">
                                <a href="" class="actions__item zmdi zmdi-check-all" data-ma-action="notifications-clear"></a>
                            </div>
                        </div>

                        <div class="listview__scroll scrollbar-inner">
                            <a href="" class="listview__item">
                                <img src="mutui/demo/img/profile-pics/1.jpg" class="listview__img" alt="">
                                <div class="listview__content">
                                    <div class="listview__heading">张三</div>
                                    <p>付费30元邀请您回答问题</p>
                                </div>
                            </a>

                            <a href="" class="listview__item">
                                <img src="mutui/demo/img/profile-pics/zhihu.jpg" class="listview__img" alt="">

                                <div class="listview__content">
                                    <div class="listview__heading">系统</div>
                                    <p>您发布对文章已经通过审核。</p>
                                </div>
                            </a>

                            <a href="" class="listview__item">
                                <img src="mutui/demo/img/profile-pics/3.jpg" class="listview__img" alt="">

                                <div class="listview__content">
                                    <div class="listview__heading">李四</div>
                                    <p>回答了您的问题 "如何对redis 分区" </p>
                                </div>
                            </a>
                            <a href="" class="listview__item">
                                <img src="mutui/demo/img/profile-pics/4.jpg" class="listview__img" alt="">

                                <div class="listview__content">
                                    <div class="listview__heading">Glenn Jecobs</div>
                                    <p>Ut vitae lacus sem ellentesque maximus, nunc sit amet varius dignissim, dui est consectetur neque</p>
                                </div>
                            </a>
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

                            <a href="" class="listview__item">
                                <img src="mutui/demo/img/profile-pics/2.jpg" class="listview__img" alt="">

                                <div class="listview__content">
                                    <div class="listview__heading">Jonathan Morris</div>
                                    <p>Nunc quis diam diamurabitur at dolor elementum, dictum turpis vel</p>
                                </div>
                            </a>

                            <a href="" class="listview__item">
                                <img src="mutui/demo/img/profile-pics/3.jpg" class="listview__img" alt="">

                                <div class="listview__content">
                                    <div class="listview__heading">Fredric Mitchell Jr.</div>
                                    <p>Phasellus a ante et est ornare accumsan at vel magnauis blandit turpis at augue ultricies</p>
                                </div>
                            </a>
                        </div>

                        <div class="p-1"></div>
                    </div>
                </div>
            </li>
            <li class="dropdown hidden-xs-down">
                <div class="user__info" data-toggle="dropdown">
                    <img class="user__img" src="mutui/demo/img/profile-pics/8.jpg" alt="">
                    <div>
                        <div class="user__name" style="color: snow">小塞塞</div>
                        <div class="user__email" style="color: snow">等级:V1</div>
                    </div>
                </div>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu--block" role="menu">
                    <div class="row app-shortcuts">
                        <a class="col-4 app-shortcuts__item" href="">
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
