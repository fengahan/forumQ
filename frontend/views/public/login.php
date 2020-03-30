<?php
use yii\helpers\Url;
/**
 * User: ZRothschild
 * Data: 2019/11/17
 * Time: 15:53
 */
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="login">
    <!-- Login -->
    <div class="login__block active" id="l-login">
        <div class="login__block__header">
            <i class="zmdi zmdi-account-circle"></i>
            邮箱密码登陆
            <div class="actions actions--inverse login__block__actions">
                <div class="dropdown">
                    <i data-toggle="dropdown" class="zmdi zmdi-more-vert actions__item"></i>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="<?=Url::to(['public/resend-verification-email'])?>">重新发送验证链接?</a>
                        <a class="dropdown-item" data-ma-action="login-switch" data-ma-target="#l-register" href="">注册新账号</a>
                        <a class="dropdown-item" data-ma-action="login-switch" data-ma-target="#l-forget-password" href="">忘记密码?</a>
                    </div>
                </div>
            </div>

        </div>
        <div class="login__block__body">

            <form action="<?=Url::to("/public/login")?>" method="post">
                <?php if (isset($model->getErrorSummary(false)[0])):?>
                <div class="alert alert-danger" role="alert">
                    <?=$model->getErrorSummary(false)[0]?>
                </div>
                <?php endif;?>
                <div class="form-group form-group--float form-group--centered">
                    <input type="text" name="email" class="form-control">
                    <label>邮箱</label>
                    <i class="form-group__bar"></i>
                </div>

                <div class="form-group form-group--float form-group--centered">
                    <input type="password" name="password" class="form-control">
                    <label>密码</label>
                    <i class="form-group__bar"></i>
                </div>
                <button type="submit" class="btn btn--icon login__block__btn"><i class="zmdi zmdi-long-arrow-right"></i></button>
            </form>
        </div>
    </div>
    <!-- Register -->
    <div class="login__block" id="l-register">
        <div class="login__block__header palette-Blue bg">
            <i class="zmdi zmdi-account-circle"></i>
            注册账号
            <div class="actions actions--inverse login__block__actions">
                <div class="dropdown">
                    <i data-toggle="dropdown" class="zmdi zmdi-more-vert actions__item"></i>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" data-ma-action="login-switch" data-ma-target="#l-login" href="">已有账号?去登录?</a>
                        <a class="dropdown-item" data-ma-action="login-switch" data-ma-target="#l-forget-password" href="">忘记密码?</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="login__block__body">
            <div class="form-group form-group--float form-group--centered">
                <input type="text" id="nickname" class="form-control">
                <label>昵称</label>
                <i class="form-group__bar"></i>
            </div>

            <div class="form-group form-group--float form-group--centered">
                <input type="text" id="email" class="form-control">
                <label>邮箱</label>
                <i class="form-group__bar"></i>
            </div>

            <div class="form-group form-group--float form-group--centered">
                <input type="password" id="password" class="form-control">
                <label>密码</label>
                <i class="form-group__bar"></i>
            </div>

            <div class="form-group form-group--float form-group--centered">
                <input type="password" id="confirm_password" class="form-control">
                <label>确认密码</label>
                <i class="form-group__bar"></i>
            </div>

            <div class="form-group form-group--float form-group--centered">
                <input type="text" id="verify_code"  class="form-control">
                <label>验证码</label>
                <i class="form-group__bar"></i>
            </div>

            <div >
                <img onclick="changeCatptcha(this)" src="<?=Url::to(["/public/captcha"])?>" data-src="<?=Url::to(["/public/captcha"])?>" id="captcha">
            </div>

            <button onclick="register()"  class="btn btn--icon login__block__btn"><i class="zmdi zmdi-check"></i></button>
        </div>
    </div>
    <!-- Forgot Password -->
    <div class="login__block" id="l-forget-password">
        <div class="login__block__header palette-Purple bg">
            <i class="zmdi zmdi-account-circle"></i>
            忘记密码?
            <div class="actions actions--inverse login__block__actions">
                <div class="dropdown">
                    <i data-toggle="dropdown" class="zmdi zmdi-more-vert actions__item"></i>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" data-ma-action="login-switch" data-ma-target="#l-login" href="">已有账号?去登录?</a>
                        <a class="dropdown-item" data-ma-action="login-switch" data-ma-target="#l-forget-password" href="">注册新账号</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="login__block__body">
            <p class="mt-4">请输入需要找回的账号</p>
            <div class="form-group form-group--float form-group--centered">
                <input name="email" id="send_email" type="text" class="form-control">
                <label>邮箱地址</label>
                <i class="form-group__bar"></i>
            </div>
            <button class="btn btn--icon login__block__btn" onclick="sendEmail()"><i class="zmdi zmdi-check"></i></button>
        </div>
    </div>
</div>
<script type="text/javascript">


    function sendEmail() {
       var email=document.getElementById("send_email").value

        $.ajax({
            type: "POST",
            dataType: 'json',
            url:"<?=Url::to(['public/request-password-reset'])?>",
            data:{"email":email},
            success: function (res) {
                if (res.code==100){
                    notify("","","","success","","",res.msg);
                }else {
                    notify("","","","danger","","",res.msg);
                    window.location.href=res.data.url
                }
            }
        });

    }
    /***
     * 切换验证码
     */
    function changeCatptcha(e) {
        var capt = document.getElementById("captcha");

        $.ajax({
            type: "GET",
            dataType: 'json',
            url: capt.getAttribute("data-src") + "?refresh=1",
            success: function (res) {
                capt.src= res.url
            }
        });
    }


    function register() {
        var nickname;
        var password;
        var confirm_password;
        var email;
        var verify_code;
        nickname=document.getElementById("nickname").value
        password=document.getElementById("password").value
        confirm_password=document.getElementById("confirm_password").value
        email=document.getElementById("email").value
        verify_code=document.getElementById("verify_code").value

        if (password !==confirm_password || password===""){
            notify("","","","danger","", "","两次密码输入不一致");
            return false;
        }
        if (verify_code===""){
            notify("","","","danger","", "","验证码不能为空");
            return false;
        }
        if (email===""){
            notify("","","","danger","","","邮箱不能为空");
            return false;
        }else {
            var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
             if(!myreg.test(email))
             {
               notify("","","","danger","","","请输入有效的Email");
               return false;
             }
        }
        $.ajax({
            type: "POST",
            dataType: 'json',
            data:{"email":email,"nickname":nickname,"password":password,"confirm_password":confirm_password,"verify_code":verify_code},
            url:"<?=Url::to(['public/signup'])?>",
            success: function (res) {
                if (res.code==100){
                    notify("","","","success","","",res.msg);
                }else {
                    notify("","","","danger","","",res.msg);
                    window.location.href=res.data.url
                }
            }
        });
    }
</script>