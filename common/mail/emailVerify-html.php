<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['public/verify-email', 'token' => $user->verification_token]);
?>
<div class="verify-email">
    <p>嗨,您好 <?= Html::encode($user->nickname) ?>,</p>

    <p>点击下面的连接找回激活账号:</p>

    <p><?= Html::a(Html::encode($verifyLink), $verifyLink) ?></p>
</div>
