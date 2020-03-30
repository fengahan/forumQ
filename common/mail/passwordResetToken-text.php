<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['public/reset-password', 'token' => $user->password_reset_token]);
?>
Hello <?= $user->nickname ?>,

Follow the link below to reset your password:

<?= $resetLink ?>
