<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['public/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>嗨,您好  <?= Html::encode($user->nickname) ?>,</p>

    <p>点击下面的连接找回密码:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
