<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="error" style="height: auto">
    <div class="error__inner">
        <h3><?= Html::encode($this->title) ?></h3>

        <div class="alert alert-danger">
            <?= nl2br(Html::encode($message)) ?>
        </div>
        <p>
            您想要访问的页面暂时丢失了,请浏览其他页面
        </p>

    </div>
</div>