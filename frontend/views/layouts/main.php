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
