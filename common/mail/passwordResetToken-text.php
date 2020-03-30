<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['public/reset-password', 'token' => $user->password_reset_token]);
?>
嗨,您好  <?= $user->nickname ?>,

点击下面的连接找回密码:

<?= $resetLink ?>
