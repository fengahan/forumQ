<?php
use yii\helpers\Url;
use yii\web\View;

/**
 * User: ZRothschild
 * Data: 2019/11/17
 * Time: 15:53
 */
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="login">
    <!-- Forgot Password -->
    <div class="login__block" id="l-forget-password" style="display: block">
        <div class="login__block__header palette-Purple bg">
            <i class="zmdi zmdi-account-circle"></i>
           找回密码
        </div>
        <div class="login__block__body">
            <p class="mt-4">请输入新密码</p>
            <div class="form-group form-group--float form-group--centered">
                <input name="password" id="password" type="text" class="form-control">
                <label>新密码</label>
                <i class="form-group__bar"></i>
            </div>
            <button class="btn btn--icon login__block__btn" onclick="restPassword()"><i class="zmdi zmdi-check"></i></button>
        </div>
    </div>
</div>
<script type="text/javascript">


    function restPassword() {
        var password=document.getElementById("password").value

        $.ajax({
            type: "POST",
            dataType: 'json',
            url:window.location.href,
            data:{"password":password},
            success: function (res) {
                if (res.code==100){
                    notify("","","","success","","",res.msg);
                    window.location.href=res.data.url
                }else {
                    notify("","","","danger","","",res.msg);
                }
            }
        });

    }
    /***
     * 切换验证码
     */




</script>