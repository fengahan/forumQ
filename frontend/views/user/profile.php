<?php
use common\models\CommunityUserTag;

use yii\helpers\Url;
use common\models\CommunityUsers;

?>
<div class="content__inner">
    <div class="row">
        <div class="col-lg-3 col-md-3">
            <div class="card">
                <div class="card-body">
                    <!--非大咖去掉badge-success-ext 这个样式-->
                    <div class="user badge-success-ext">
                        <div class="user__info" id="k">
                        <img id="dropzs" class="user__img " src="<?=Yii::$app->user->identity->avatar?>" alt="">
                            <div>
                                <div><?=Yii::$app->user->identity->nickname?></div>
                                <div>等级:<code><?=Yii::$app->user->identity->level;?></code></div>
                                <div><?=Yii::$app->user->identity->email;?></div>
                            </div>
                        </div>
                    </div>
                    <p class="card-text"><?=Yii::$app->user->identity->self_signature?></p>
                    <div class="flot-chart-legends hidden-sm-down">
                        <a href="" data-toggle="tooltip" data-placement="top" data-original-title="发布提问<?=$question_count?>次" class="badge badge-secondary">问(<?=$question_count?>)</a>
                        <a href="" data-toggle="tooltip" data-placement="top" data-original-title="最佳回答6次" class="badge badge-success">答(6)</a>
                        <a href="" data-toggle="tooltip" data-placement="top" data-original-title="技术分享50次" class="badge badge-dark">分享(50)</a>
                    </div>
                    <div class="tags flot-chart-legends" >
                        <?php foreach ($question_user_tag as $key=>$value):?>
                            <a href="" data-toggle="tooltip" data-placement="top" data-original-title="级别:<?=CommunityUserTag::LEVEL[$value['level']]?>">
                                <div class="legendColorBox" style="display: inline-block">
                                    <div style="border:1px solid #fff;padding:1px">
                                        <div style="width:4px;height:0;border:5px solid <?=CommunityUserTag::LEVEL_STYLE_COLOR[$value['level']]?>;overflow:hidden">

                                        </div>
                                    </div>
                                </div>
                                <?=$value['title']?>
                            </a>
                        <?php endforeach;?>
                    </div>

                    <div class="team__social text-center">
                        <?php foreach ($user_link as $key=>$value):?>
                            <a href="<?=$value['href']?>" class="zmdi <?=$value['icon']?> <?=$value['color']?>"  data-toggle="tooltip" data-title="<?=$value['name']?>&nbsp;点击次数：<?=$value['click_number']?>" ></a>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">发布新内容</h4>
                    <a href="<?=Url::to(['question/create'])?>" class="badge badge-warning"><i class="zmdi zmdi-help"></i>新问答</a>
                    <a href="<?=Url::to(['question/create'])?>" class="badge badge-success"><i class="zmdi zmdi-windows"></i>新技术</a>
                    <a href="<?=Url::to(['question/create'])?>" class="badge badge-info"><i class="zmdi zmdi-share"></i>新专题</a>

                </div>
            </div>
        </div>

        <div class="col-lg-9 col-md-9">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">个人信息</h4>
                    <h6 class="card-subtitle">
                        <?=Yii::$app->name?> 友情提示您:<span class="text-red">请如实完善个人信息,更有助于彼此到成长。</span>
                    </h6>

                    <form class="row" action="<?=Url::to(['user/update-profile'])?>" method="post">
                        <div class="col-md-6">
                            <?php if (Yii::$app->session->getFlash("update_status")==='200'):?>
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <?=  Yii::$app->session->getFlash("update_error_message")?>
                                </div>
                            <?php elseif (Yii::$app->session->getFlash("update_status")==='100'):?>
                                 <div class="alert alert-success" role="alert">
                                        更新个人信息成功
                                 </div>
                            <?php endif;?>
                            <div class="form-group">
                                <label>昵称</label>
                                <input type="text" class="form-control" name="nickname" value="<?=$user_info['nickname']?>" readonly>
                                <i class="form-group__bar"></i>
                            </div>

                            <div class="form-group">
                                <label>邮箱地址</label>
                                <input type="email" class="form-control" name="email" value="<?=$user_info['email']?>" readonly>
                                <i class="form-group__bar"></i>
                            </div>
                            <div class="form-group">
                                <label>性别</label>
                                <div class="select">
                                    <select class="form-control" name="gender">
                                        <option value="<?=CommunityUsers::GENDER_MAN?>"
                                            <?php if ($user_info['gender']==CommunityUsers::GENDER_MAN):?>
                                                selected="selected"
                                            <?php endif;?>>男</option>
                                        <option value="<?=CommunityUsers::GENDER_WOMAN?>"
                                            <?php if ($user_info['gender']==CommunityUsers::GENDER_WOMAN):?>
                                                selected="selected"
                                            <?php endif;?>>女</option>
                                        <option value="<?=CommunityUsers::GENDER_PRIVATE?>"
                                            <?php if ($user_info['gender']==CommunityUsers::GENDER_PRIVATE):?>
                                                selected="selected"
                                            <?php endif;?>>保密</option>
                                    </select>
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>个性签名</label>
                                <input type="text" class="form-control" name="self_signature" value="<?=$user_info['self_signature']?>" placeholder="不可以超过30个字符">
                                <i class="form-group__bar"></i>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">更新信息</button>
                        </div>

                    </form>

                    <br>
                    <br>

                </div>
            </div>
        </div>


    </div>

</div>

<script type="text/javascript">


    var myDropzone = new Dropzone("#dropzs",
        {
            url: "<?=Url::to(['user/update-avatar'])?>",
            paramName: "file",
            maxFiles:1,
            maxFilesize: 1, // 上传图片大小，单位：MB
            acceptedFiles: ".png, .jpg",
            addRemoveLinks: true,
            parallelUploads:1,
            dictDefaultMessage: '拖拽或点击上传 商品图片',
            dictFileTooBig: "File is too big ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB.",
            dictInvalidFileType: "文件类型只能是" + ".png, .jpg",
            dictRemoveFile: "移除图片",
            dictMaxFilesExceeded: "您一次最多只能上传" + 1+ "张图片！",
            dictResponseError: "上传图片失败！",
            init: function () {
                this.on("success", function (file, data) {
                    if (data.success==1){
                        notify("","","","success","", "","更新头像成功");
                        document.getElementsByClassName("user__img")[0].src=data.url//更新导航栏头像
                        document.getElementById('dropzs').src=data.url
                    }else {
                        notify("","","","danger","", "","更新头像失败");
                    }

                   console.log(data.message)
                    // document.getElementById('dropzs').src=data.data.url
                });
                this.on('error', function (files, data) {
                    notify("","","","danger","", "","请稍后再试试");
                });
            }
        });


</script>

