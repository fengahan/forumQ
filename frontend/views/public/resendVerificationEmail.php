<?php
use yii\helpers\Url;
use yii\web\View;

/**
 * User: ZRothschild
 * Data: 2019/11/17
 * Time: 15:53
 */
/* @var $this yii\web\View */

$this->title = '验证'.'-'.Yii::$app->name;
?>

<div class="login">


    <div class="login__block" id="l-forget-password" style="display: block">
        <div class="login__block__header palette-Purple bg">
            <i class="zmdi zmdi-account-circle"></i>
            重新邮箱发送验证码

        </div>
        <?php if (isset($model->getErrorSummary(false)[0])):?>
            <div class="alert alert-danger" role="alert">
                <?=$model->getErrorSummary(false)[0]?>
            </div>
        <?php endif;?>
        <?php $_success= Yii::$app->session->getFlash('resend_email_success'); ?>
        <?php $_error= Yii::$app->session->getFlash('resend_email_error'); ?>
        <?php if (!empty($_success)):?>
        <div class="alert alert-success" role="alert">
           <?=$_success?>
        </div>
        <?endif;?>
        <?php if (!empty($_error)):?>
        <div class="alert alert-danger" role="alert">
            <?=$_error?>
        </div>
        <?endif;?>
        <form action="<?=Url::to(['public/resend-verification-email'])?> " method="post">
            <div class="login__block__body">
                <p class="mt-4">请输入邮箱</p>
                <div class="form-group form-group--float form-group--centered">
                    <input name="email" id="email" type="text" class="form-control">
                    <label>邮箱</label>
                    <i class="form-group__bar"></i>
                </div>
                <button class="btn btn--icon login__block__btn"  type="submit"><i class="zmdi zmdi-check"></i></button>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">



</script>