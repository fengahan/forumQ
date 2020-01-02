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
                        <a class="dropdown-item" data-ma-action="login-switch" data-ma-target="#l-register" href="">注册新账号</a>
                        <a class="dropdown-item" data-ma-action="login-switch" data-ma-target="#l-forget-password" href="">忘记密码?</a>
                    </div>
                </div>
            </div>

        </div>
        <div class="login__block__body">
            <div class="form-group form-group--float form-group--centered">
                <input type="text" class="form-control">
                <label>邮箱</label>
                <i class="form-group__bar"></i>
            </div>

            <div class="form-group form-group--float form-group--centered">
                <input type="password" class="form-control">
                <label>密码</label>
                <i class="form-group__bar"></i>
            </div>

            <button href="index.html" class="btn btn--icon login__block__btn"><i class="zmdi zmdi-long-arrow-right"></i></button>
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
                <img onclick="changeCatptcha(this)" src="<?=Url::to(["/site/captcha"])?>" data-src="<?=Url::to(["/site/captcha"])?>" id="captcha">
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
                <input type="text" class="form-control">
                <label>邮箱地址</label>
                <i class="form-group__bar"></i>
            </div>
            <button class="btn btn--icon login__block__btn"><i class="zmdi zmdi-check"></i></button>
        </div>
    </div>
</div>
<script type="text/javascript">
    /***
     * 切换验证码
     */
    function changeCatptcha(e) {
        var capt = document.getElementById("captcha");
        console.log(capt.src)
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
        nickname=document.getElementById("nickname")
        password=document.getElementById("password")
        confirm_password=document.getElementById("confirm_password")
        email=document.getElementById("email")
        verify_code=document.getElementById("verify_code")
        if (password !=confirm_password || password==""){
            notify("","","","danger","", "","两次密码输入不一致");
        }

    }
</script>