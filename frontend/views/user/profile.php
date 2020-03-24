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
                            <a target="_blank" href="<?=Url::to(['public/user-link-jump','id'=>$value['id']])?>" class="zmdi <?=$value['icon']?> <?=$value['color']?>"  data-toggle="tooltip" data-title="<?=$value['name']?>&nbsp;点击次数：<?=$value['click_number']?>" ></a>
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
                                                <a class="btn btn-primary text-white float-right" data-toggle="modal" data-target="#modal-centered">更新信息</a>
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
                                        <div class="col-xl-2 col-lg-3 col-sm-4 col-6">
                                            <div class="groups__item">
                                                <div class="team__social text-center">
                                                    <a href="<?=$value['href']?>" class="zmdi <?=$value['icon']?> <?=$value['color']?>"  data-toggle="tooltip" data-title="<?=$value['href']?>" ></a>
                                                </div>
                                                <div class="groups__info">
                                                    <strong>  <?=$value['name']?></strong>
                                                    <small>点击次数:<?=$value['click_number']?></small>
                                                </div>

                                                <div class="actions">
                                                    <div class="dropdown actions__item">
                                                        <i class="zmdi zmdi-more-vert" data-toggle="dropdown" aria-expanded="false"></i>
                                                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(30px, 26px, 0px);">
                                                            <a class="dropdown-item" href="">编辑</a>
                                                            <a class="dropdown-item" href="" data-demo-action="delete-listing">删除</a>
                                                        </div>
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


            <div class="modal-footer modal-footer--bordered">
                <button type="button" class="btn btn-link" data-dismiss="modal">取消</button>
                <button type="button" onclick="submit_link()" class="btn btn-link">创建链接</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade note-view" id="edit-note" data-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="note-view__field">
                <input type="text" class="form-control" placeholder="Note Title" value="Morbi leo risus porta consectetur vestibulum eros">
            </div>

            <div class="note-view__field note-view__field--color">
                <div class="note-view__label hidden-xs-down">Color</div>

                <div class="btn-group btn-group-toggle btn-group--colors" data-toggle="buttons">
                    <label class="btn active"><input type="radio" name="notes-color" autocomplete="off" checked=""></label>
                    <label class="btn bg-light-blue"><input type="radio" name="notes-color" autocomplete="off"></label>
                    <label class="btn bg-teal"><input type="radio" name="notes-color" autocomplete="off"></label>
                    <label class="btn bg-red"><input type="radio" name="notes-color" autocomplete="off"></label>
                    <label class="btn bg-purple"><input type="radio" name="notes-color" autocomplete="off"></label>
                    <label class="btn bg-amber"><input type="radio" name="notes-color" autocomplete="off"></label>
                    <label class="btn bg-cyan"><input type="radio" name="notes-color" autocomplete="off"></label>
                </div>
            </div>


            <div class="trumbowyg-box trumbowyg-editor-visible trumbowyg-en trumbowyg"><div class="trumbowyg-button-pane"><div class="trumbowyg-button-group "><button type="button" class="trumbowyg-viewHTML-button trumbowyg-not-disable" title="View HTML" tabindex="-1"><svg><use xlink:href="#trumbowyg-view-html"></use></svg></button></div><div class="trumbowyg-button-group "><button type="button" class="trumbowyg-undo-button " title="Undo (Ctrl + Z)" tabindex="-1"><svg><use xlink:href="#trumbowyg-undo"></use></svg></button><button type="button" class="trumbowyg-redo-button " title="Redo (Ctrl + Y)" tabindex="-1"><svg><use xlink:href="#trumbowyg-redo"></use></svg></button></div><div class="trumbowyg-button-group "><button type="button" class="trumbowyg-formatting-button trumbowyg-open-dropdown" title="Formatting" tabindex="-1"><svg><use xlink:href="#trumbowyg-p"></use></svg></button></div><div class="trumbowyg-button-group "><button type="button" class="trumbowyg-strong-button " title="Strong (Ctrl + B)" tabindex="-1"><svg><use xlink:href="#trumbowyg-strong"></use></svg></button><button type="button" class="trumbowyg-em-button " title="Emphasis (Ctrl + I)" tabindex="-1"><svg><use xlink:href="#trumbowyg-em"></use></svg></button><button type="button" class="trumbowyg-del-button " title="Deleted" tabindex="-1"><svg><use xlink:href="#trumbowyg-del"></use></svg></button></div><div class="trumbowyg-button-group "><button type="button" class="trumbowyg-superscript-button " title="Superscript" tabindex="-1"><svg><use xlink:href="#trumbowyg-superscript"></use></svg></button><button type="button" class="trumbowyg-subscript-button " title="Subscript" tabindex="-1"><svg><use xlink:href="#trumbowyg-subscript"></use></svg></button></div><div class="trumbowyg-button-group "><button type="button" class="trumbowyg-link-button trumbowyg-open-dropdown" title="Link" tabindex="-1"><svg><use xlink:href="#trumbowyg-link"></use></svg></button></div><div class="trumbowyg-button-group "><button type="button" class="trumbowyg-insertImage-button " title="Insert Image" tabindex="-1"><svg><use xlink:href="#trumbowyg-insert-image"></use></svg></button></div><div class="trumbowyg-button-group "><button type="button" class="trumbowyg-justifyLeft-button " title="Align Left" tabindex="-1"><svg><use xlink:href="#trumbowyg-justify-left"></use></svg></button><button type="button" class="trumbowyg-justifyCenter-button " title="Align Center" tabindex="-1"><svg><use xlink:href="#trumbowyg-justify-center"></use></svg></button><button type="button" class="trumbowyg-justifyRight-button " title="Align Right" tabindex="-1"><svg><use xlink:href="#trumbowyg-justify-right"></use></svg></button><button type="button" class="trumbowyg-justifyFull-button " title="Align Justify" tabindex="-1"><svg><use xlink:href="#trumbowyg-justify-full"></use></svg></button></div><div class="trumbowyg-button-group "><button type="button" class="trumbowyg-unorderedList-button " title="Unordered list" tabindex="-1"><svg><use xlink:href="#trumbowyg-unordered-list"></use></svg></button><button type="button" class="trumbowyg-orderedList-button " title="Ordered list" tabindex="-1"><svg><use xlink:href="#trumbowyg-ordered-list"></use></svg></button></div><div class="trumbowyg-button-group "><button type="button" class="trumbowyg-horizontalRule-button " title="Insert horizontal rule" tabindex="-1"><svg><use xlink:href="#trumbowyg-horizontal-rule"></use></svg></button></div><div class="trumbowyg-button-group "><button type="button" class="trumbowyg-removeformat-button " title="Remove format" tabindex="-1"><svg><use xlink:href="#trumbowyg-removeformat"></use></svg></button></div><div class="trumbowyg-button-group trumbowyg-right"><button type="button" class="trumbowyg-fullscreen-button trumbowyg-not-disable" title="Fullscreen" tabindex="-1"><svg><use xlink:href="#trumbowyg-fullscreen"></use></svg></button></div></div><div class="trumbowyg-editor" contenteditable="true" dir="ltr">                                Nulla vitae elit libero, a pharetra augue. Vestibulum id ligula porta felis euismod semper. Donec id elit non mi porta gravida at eget metus. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Etiam porta sem malesuada magna mollis euismod. Cras mattis consectetur purus sit amet fermentum. Donec id elit non mi porta gravida at eget metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                </div><textarea class="wysiwyg-editor trumbowyg-textarea" tabindex="-1" style="height: 0px;">                                Nulla vitae elit libero, a pharetra augue. Vestibulum id ligula porta felis euismod semper. Donec id elit non mi porta gravida at eget metus. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Etiam porta sem malesuada magna mollis euismod. Cras mattis consectetur purus sit amet fermentum. Donec id elit non mi porta gravida at eget metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            </textarea><div class="trumbowyg-dropdown-formatting trumbowyg-dropdown trumbowyg-fixed-top" data-trumbowyg-dropdown="formatting" style="display: none;"><button type="button" class="trumbowyg-p-dropdown-button"><svg><use xlink:href="#trumbowyg-p"></use></svg>Paragraph</button><button type="button" class="trumbowyg-blockquote-dropdown-button"><svg><use xlink:href="#trumbowyg-blockquote"></use></svg>Quote</button><button type="button" class="trumbowyg-h1-dropdown-button"><svg><use xlink:href="#trumbowyg-h1"></use></svg>Header 1</button><button type="button" class="trumbowyg-h2-dropdown-button"><svg><use xlink:href="#trumbowyg-h2"></use></svg>Header 2</button><button type="button" class="trumbowyg-h3-dropdown-button"><svg><use xlink:href="#trumbowyg-h3"></use></svg>Header 3</button><button type="button" class="trumbowyg-h4-dropdown-button"><svg><use xlink:href="#trumbowyg-h4"></use></svg>Header 4</button></div><div class="trumbowyg-dropdown-link trumbowyg-dropdown trumbowyg-fixed-top" data-trumbowyg-dropdown="link" style="display: none;"><button type="button" class="trumbowyg-createLink-dropdown-button" title=" (Ctrl + K)"><svg><use xlink:href="#trumbowyg-create-link"></use></svg>Insert link</button><button type="button" class="trumbowyg-unlink-dropdown-button"><svg><use xlink:href="#trumbowyg-unlink"></use></svg>Remove link</button></div><div class="trumbowyg-overlay"></div></div>

            <div class="modal-footer modal-footer--bordered">
                <button type="button" class="btn btn-link" data-dismiss="modal">Dismiss</button>
                <button type="button" class="btn btn-link">Update</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-centered" tabindex="-1" style="display: none;" aria-hidden="true">
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
                if (res.code==100){
                    $('#add-link').modal('hide')
                    notify("","","","success","","",res.msg);
                }else {
                    $('#add-link').modal('hide')
                    notify("","","","danger","","",res.msg);
                }
            }

        });
        return  false;
    }
</script>

