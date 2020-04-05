<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;

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
    <!-- 刷新加载的loading图片-->
    <?php echo $this->render('@app/views/common/loader.php');?>
    <header class="header">

        <div class="header__logo hidden-sm-down">

            <h1><a href="<?= Url::to(['index/index']); ?>"><?=Yii::$app->name?></a></h1>

        </div>

        <ul class="nav">

            <li class="nav-item">
                <a class="nav-link nav-text active" href="<?= Url::to(['index/index']); ?>">问答</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-text " href="<?= Url::to(['article/index']); ?>">技术分享</a>
            </li>
        </ul>

        <ul class="top-nav">

            <?php if (Yii::$app->user->isGuest==false):?>

            <li class="dropdown top-nav__notifications">

                <!-- 铃铛 红点class="top-nav__notify"-->
                <?php
                $message_un_read=[];
                if (Yii::$app->user->isGuest==false){
                    $message_un_read=\common\models\UserMessage::getUnRead(Yii::$app->user->identity->getId());
                }
                ?>
                <a href="" data-toggle="dropdown" <?php if (count($message_un_read)>0):?>class="top-nav__notify"<?php endif;?>>

                    <i class="zmdi zmdi-notifications"></i>

                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu--block">
                    <!-- 通知栏标题-->
                    <div class="listview listview--hover">

                        <div class="listview__header">
                            通知消息
<!--                            <div class="actions">-->
<!---->
<!--                                <a href="" class="actions__item zmdi zmdi-check-all" data-ma-action="notifications-clear"></a>-->
<!---->
<!--                            </div>-->
                        </div>

                        <!-- 通知列表内容-->

                        <div class="listview__scroll scrollbar-inner">
                            <?php foreach ($message_un_read as $key=>$value):?>
                            <a href="" class="listview__item">
                                <div class="listview__content">
                                    <p><?=\yii\helpers\StringHelper::truncate($value['content'],22)?></p>
                                </div>

                            </a>
                            <?php endforeach;?>
                            <a href="<?=Url::to(['user/center','tab'=>'message'])?>" class="listview__item">
                                <div class="listview__content text-center">
                                    <div class="listview__content text-center btn tn-success">
                                     <p class="text-blue">查看全部</p>
                                    </div>
                                </div>
                            </a>

                        </div>
                        <div class="p-1"></div>

                    </div>
                </div>
            </li>
            <?php endif;?>

            <?php if (Yii::$app->user->isGuest):?>

                <li>

                    <a href="<?= Url::to(['public/login']); ?>">登陆注册</a>

                </li>

            <?php else:?>

                <li class="dropdown hidden-xs-down">

                    <!-- 用户信息-->

                    <div class="user__info" data-toggle="dropdown">

                        <img class="user__img" src="<?=Yii::$app->user->identity->avatar?>" alt="">

                        <div>

                            <div class="user__name" style="color: snow"><?=Yii::$app->user->identity->nickname?></div>

                            <div class="user__email" style="color: snow">等级:<?=Yii::$app->user->identity->level?></div>

                        </div>

                    </div>

                    <!-- 用户操作菜单-->

                    <div class="dropdown-menu dropdown-menu-right dropdown-menu--block" role="menu">

                        <div class="row app-shortcuts">

                            <a class="col-4 app-shortcuts__item" href="<?= Url::to(['user/center']); ?>">

                                <i class="zmdi zmdi-account-o"></i>

                                <small class="">个人中心</small>

                                <span class="app-shortcuts__helper bg-red"></span>

                            </a>

                            <a class="col-4 app-shortcuts__item" href="<?= Url::to(['user/profile']); ?>">

                                <i class="zmdi zmdi-file-text"></i>

                                <small class="">个人信息</small>

                                <span class="app-shortcuts__helper bg-blue"></span>

                            </a>

                            <a class="col-4 app-shortcuts__item" onclick="document.getElementById('_form').submit();" >

                                <i class="zmdi zmdi-power"></i>

                                <small class="">退出登陆</small>

                                <span class="app-shortcuts__helper bg-teal"></span>

                            </a>

                            <form id="_form" method="post" action="<?=Url::to('/public/logout')?>">

                            </form>

                        </div>

                    </div>

                </li>

            <?php endif;?>

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
        <p>&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p>站点Bug反馈请发邮件到studyiris@vip.qq.com</p>
    </div>
</footer>
<!-- Older IE warning message -->
<!--[if IE]>
<div class="ie-warning">
    <h1>注意!!</h1>
    <p>为了您能够最佳浏览该站点，请升级至下列任何一种浏览器.</p>
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
