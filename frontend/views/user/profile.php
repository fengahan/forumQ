<?php

use common\models\CommunityQuestion;
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
                        <a href="" data-toggle="tooltip" data-placement="top" data-original-title="发布提问<?=$question_count??0?>次" class="badge badge-secondary">问(<?=$question_count??0?>)</a>
                        <a href="" data-toggle="tooltip" data-placement="top" data-original-title="最佳回答<?=$best_reply_count??0?>次" class="badge badge-success">答(<?=$best_reply_count??0?>)</a>
                        <a href="" data-toggle="tooltip" data-placement="top" data-original-title="技术分享<?=$article_count??0?>次" class="badge badge-dark">技术分享(<?=$article_count??0?>)</a>
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
                            <a target="_blank" href="<?=Url::to(['public/user-link-jump','id'=>$value['id']])?>" class="zmdi <?=$value['icon']?> <?=$value['color']?>"  data-toggle="tooltip" data-title="<?=$value['name']?>&nbsp;点击次数：<?=$value['click_number']?>" ></a>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">发布新内容</h4>
                    <a href="<?=Url::to(['question/create'])?>" class="btn btn-warning btn--icon-text float-left"><i class="zmdi zmdi-help"></i>新问答</a>
                    <a href="<?=Url::to(['article/create'])?>" class="btn btn-success btn--icon-text float-right"><i class="zmdi zmdi-windows"></i>新技术</a>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="tab-container">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link<?php if ($tab=='profile'):?> show active<?php endif;?>" href="<?=Url::to(['/user/profile','tab'=>'profile'])?>" aria-selected="false">个人信息</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link<?php if ($tab=='user_tag'):?> show active<?php endif;?>"   href="<?=Url::to(['/user/profile','tab'=>'user_tag'])?>" aria-selected="false">技能标签</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link<?php if ($tab=='user_link'):?> show active<?php endif;?>" href="<?=Url::to(['/user/profile','tab'=>'user_link'])?>" aria-selected="false">个人链接</a>
                            </li>

                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade<?php if ($tab=='profile'):?> show active<?php endif;?>" >
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
                            <div class="tab-pane fade<?php if ($tab=='user_tag'):?> show active<?php endif;?>" >
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">个人标签</h4>
                                        <h6 class="card-subtitle">
                                            <?=Yii::$app->name?> 友情提示您:<span class="text-red">请如实完善个人信息,更有助于彼此到成长。</span>
                                        </h6>

                                        <form class="row" >
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
                                                    <label>选择技能标签</label>
                                                    <select class="select2" id="tag_select" multiple data-placeholder="选择一个或者多个标签" name="tag">
                                                        <?php foreach ($tag_list as $key=>$value):?>
                                                            <option value="<?=$value['id']?>"><?=$value['title']?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </div>
                                                <a class="btn btn-primary text-white float-right" data-toggle="modal" data-target="#tag_confirm">更新信息</a>
                                            </div>

                                        </form>

                                        <br>
                                        <br>

                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade<?php if ($tab=='user_link'):?> show active<?php endif;?>" >
                                <div class="row notes">
                                    <?php foreach ($user_link as $key=>$value):?>
                                        <div class="col-xl-2 col-lg-3 col-sm-4 col-6 " >
                                            <div class="groups__item notes__item">
                                                <div class="team__social text-center">
                                                    <a href="#edit-link_<?=$value['id']?>"  data-toggle="modal" class="zmdi <?=$value['icon']?> <?=$value['color']?>" ></a>
                                                </div>
                                                <div class="groups__info">
                                                    <strong>  <?=$value['name']?></strong>
                                                    <small>点击次数:<?=$value['click_number']?></small>
                                                </div>

                                                <div class="notes__actions" data-demo-action="delete-listing"   data-toggle="modal" data-target="#delete-link_<?=$value['id']?>">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade note-view" id="edit-link_<?=$value['id']?>" data-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="note-view__field">
                                                        <input type="text" class="form-control" id="update—link_name<?=$value['id']?>" name="name" value="<?=$value['name']?>" placeholder="名称">
                                                    </div>
                                                    <div class="note-view__field">
                                                        <input type="text" class="form-control" id="update—link_href<?=$value['id']?>" name="href"  value="<?=$value['href']?>" placeholder="链接">
                                                    </div>
                                                    <div class="note-view__field">
                                                        <input type="text" class="form-control" id="update—link_icon<?=$value['id']?>" name="icon"  value="<?=ltrim($value['icon'],'zmdi-')?>" placeholder="图标名称">
                                                    </div>
                                                    <div class="note-view__field note-view__field--color">
                                                        <div class="note-view__label hidden-xs-down">Color</div>
                                                        <div class="btn-group btn-group-toggle btn-group--colors" data-toggle="buttons">
                                                        <label class="btn bg-light-blue <?php if ($value['color']=='bg-light-blue'):?>active<?php endif;?>"><input type="radio" name="update—link_color<?=$value['id']?>" value="bg-light-blue" <?php if ($value['color']=='bg-light-blu'):?>checked=checked<?php endif;?>autocomplete="off"></label>
                                                            <label class="btn bg-teal <?php if ($value['color']=='bg-teal'):?>active<?php endif;?> "><input type="radio" name="update—link_color<?=$value['id']?>" value="bg-teal" <?php if ($value['color']=='bg-teal'):?>checked=checked<?php endif;?> autocomplete="off"></label>
                                                            <label class="btn bg-red <?php if ($value['color']=='bg-red'):?>active<?php endif;?>"><input type="radio" name="update—link_color<?=$value['id']?>"  value="bg-red" <?php if ($value['color']=='bg-red'):?>checked=checked<?php endif;?> autocomplete="off"></label>
                                                            <label class="btn bg-purple <?php if ($value['color']=='bg-purple'):?>active<?php endif;?>"><input type="radio" name="update—link_color<?=$value['id']?>" value="bg-purple" <?php if ($value['color']=='bg-purple'):?>checked=checked<?php endif;?> autocomplete="off"></label>
                                                            <label class="btn bg-amber <?php if ($value['color']=='bg-amber'):?>active<?php endif;?> "><input type="radio" name="update—link_color<?=$value['id']?>" value="bg-amber"  <?php if ($value['color']=='bg-amber'):?>checked=checked<?php endif;?>autocomplete="off"></label>
                                                            <label class="btn bg-cyan <?php if ($value['color']=='bg-cyan'):?>active<?php endif;?>"><input type="radio" name="update—link_color<?=$value['id']?>"  value="bg-cyan"   <?php if ($value['color']=='bg-cyan'):?>checked=checked<?php endif;?>autocomplete="off"></label>
                                                            <label class="btn bg-indigo <?php if ($value['color']=='bg-indigo'):?>active<?php endif;?> "><input type="radio" name="update—link_color<?=$value['id']?>"  value="bg-indigo"  <?php if ($value['color']=='bg-indigo'):?>checked=checked<?php endif;?>autocomplete="off"></label>

                                                        </div>
                                                    </div>
                                                    <div class="note-view__field">
                                                        <div class="alert alert-success" role="alert">
                                                            <a  target="_blank" href="<?=Url::to(['public/show-icons'])?>" class="alert-link">  点击此处显示所有图标. </a>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer modal-footer--bordered">
                                                        <button type="button" class="btn btn-link" data-dismiss="modal">取消</button>
                                                        <button type="button" onclick="update_link(<?=$value['id']?>)" class="btn btn-link">更新链接</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="delete-link_<?=$value['id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title pull-left">删除友情链接</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        您确定删除友情链接吗？此操作不可回滚
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" onclick="delete_link(<?=$value['id']?>)" class="btn  btn-danger">确定</button>
                                                        <button type="button" id="closeModal" class="btn btn-link" data-dismiss="modal">关闭</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach;?>
                                    <div class="col-xl-2 col-lg-3 col-sm-4 col-6">
                                        <div class="groups__item">
                                            <div class="team__social text-center">
                                                <button class="btn btn-danger zmdi zmdi-plus" data-toggle="modal" data-target="#add-link"></button>
                                            </div>
                                            <div class="groups__info">
                                                <strong class="text-red">添加新链接</strong>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div

        </div>


    </div>

</div>
<div class="modal fade note-view" id="add-link" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="note-view__field">
                <input type="text" class="form-control" id="link_name" name="name" placeholder="名称">
            </div>
            <div class="note-view__field">
                <input type="text" class="form-control" id="link_href" name="href" placeholder="链接">
            </div>
            <div class="note-view__field">
                <input type="text" class="form-control" id="link_icon" name="icon" placeholder="图标名称">
            </div>
            <div class="note-view__field note-view__field--color">
                <div class="note-view__label hidden-xs-down">Color</div>
                <div class="btn-group btn-group-toggle btn-group--colors" data-toggle="buttons">
                    <label class="btn bg-light-blue"><input type="radio" name="link_color" value="bg-light-blu" autocomplete="off"></label>
                    <label class="btn bg-teal"><input type="radio" name="link_color" value="bg-teal" autocomplete="off"></label>
                    <label class="btn bg-red"><input type="radio" name="link_color"  value="bg-red" autocomplete="off"></label>
                    <label class="btn bg-purple"><input type="radio" name="link_color" value="bg-purple" autocomplete="off"></label>
                    <label class="btn bg-amber"><input type="radio" name="link_color" value="bg-amber" autocomplete="off"></label>
                    <label class="btn bg-cyan"><input type="radio" name="link_color"  value="bg-cyan" autocomplete="off"></label>
                    <label class="btn bg-indigo"><input type="radio" name="link_color"  value="bg-indigo" autocomplete="off"></label>

                </div>
            </div>
            <div class="note-view__field">
                <div class="alert alert-success" role="alert">
                    <a href="<?=Url::to(['public/show-icons'])?>" class="alert-link">  点击此处显示所有图标. </a>
                </div>
            </div>


            <div class="modal-footer modal-footer--bordered">
                <button type="button" class="btn btn-link" data-dismiss="modal">取消</button>
                <button type="button" onclick="submit_link()" class="btn btn-link">创建链接</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tag_confirm" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title pull-left">友情提示</h5>
            </div>
            <div class="modal-body">
                删除旧标签将会重新计算标签等级 请谨慎操作,该操作无法回滚
            </div>
            <div class="modal-footer">
                <button type="button" onclick="submit_tag()" class="btn  btn-danger">确定</button>
                <button type="button" id="closeModal" class="btn btn-link" data-dismiss="modal">关闭</button>
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
    $("#tag_select").val(<?=json_encode(array_column($question_user_tag,'tag_id'),32)?>).trigger("change");

    function submit_tag() {

        var tag_vals=$('#tag_select').select2('val')
        $.ajax({
            type: "POST",
            dataType: 'json',
            data:{"tag_vals":tag_vals},
            url:"<?=Url::to(['user/update-user-tag'])?>",
            success: function (res) {
                if (res.code==100){
                    $('#tag_confirm').modal('hide')
                    notify("","","","success","","",res.msg);
                }else {
                    notify("","","","danger","","",res.msg);
                }
            }

        });
        return  false;
    }
    function submit_link() {
        var name =document.getElementById("link_name").value;
        var href =document.getElementById("link_href").value;
        var color = $('input[name="link_color"]:checked').val();
        var icon =document.getElementById("link_icon").value;
        $.ajax({
            type: "POST",
            dataType: 'json',
            data:{"name":name,"href":href,"color":color,"icon":icon},
            url:"<?=Url::to(['user/user-link-create'])?>",
            success: function (res) {
                $('#add-link').modal('hide')
                if (res.code==100){
                    notify("","","","success","","",res.msg);
                }else {
                    notify("","","","danger","","",res.msg);
                }
            }

        });
        return  false;
    }
    function update_link(id) {
       var node="edit-link_"+id;

        var name =document.getElementById("update—link_name"+id).value;
        var href =document.getElementById("update—link_href"+id).value;
        var color = '';
        var icon =document.getElementById("update—link_icon"+id).value;


        var check= document.getElementsByName('update—link_color'+id);
        for (var i = 0; i < check.length; i++) {
            if (check[i].checked == true) {//如果选中，下面的alert就会弹出选中的值
                color=check[i].value;
            }
        }
        $.ajax({
            type: "POST",
            dataType: 'json',
            data:{"id":id,"name":name,"href":href,"color":color,"icon":icon},
            url:"<?=Url::to(['user/user-link-update'])?>",
            success: function (res) {
                $('#'+node).modal('hide')
                if (res.code==100){
                    notify("","","","success","","",res.msg);
                }else {
                 //  ele.modal('hide')
                    notify("","","","danger","","",res.msg);
                }

                window.location.reload();
            }

        });
        return  false;
    }
    function delete_link(id) {
        var node="delete-link_"+id;

        $.ajax({
            type: "POST",
            dataType: 'json',
            data:{"id":id},
            url:"<?=Url::to(['user/user-link-delete'])?>",
            success: function (res) {
                $('#'+node).modal('hide')
                if (res.code==100){
                    notify("","","","success","","",res.msg);
                }else {
                    //  ele.modal('hide')
                    notify("","","","danger","","",res.msg);
                }

                window.location.reload();
            }

        });
        return  false;
    }


</script>

