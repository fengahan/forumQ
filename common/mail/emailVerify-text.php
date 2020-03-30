<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['public/verify-email', 'token' => $user->verification_token]);
?>
嗨,您好 <?= $user->nickname ?>,

点击下面的连接找回激活账号:

<?= $verifyLink ?>
