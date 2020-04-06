<?php
use yii\helpers\Url;
use common\models\CommunityQuestion;
$this->title = '更新问答' .'-'.Yii::$app->name;
?>
<div class="content__inner">
    <div class="row ">
        <div class="col-md-10 offset-1">
            <header class="content__title">
                <h1><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">更新问答</font></font></h1>
            </header>
            <!-- style="word-wrap: normal;"  避免编辑器行数显示的数字出现自动换行问题-->
            <div class="card" style="word-wrap: normal;">
                <div class="card-body">
                    <form id= "create_ques" method="post" action="<?=Url::to("/question/update")?>">

                        <div class="row">
                            <label class="col-sm-2 col-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">标题</font></font></label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="title" value="<?=$ques_info['title']?>" placeholder="问答标题">
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">赏金</font></font></label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="money" value="<?=$ques_info['money']?>" placeholder="赏金">
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">标签</font></font></label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <div class="select">
                                        <select  name="tag_id" class="form-control">
                                            <?php foreach ($tag_list as $key=>$value):?>
                                                <option <?php if ($value['id']==$ques_info['tag_id']):?>selected="selected"<?php endif;?> value="<?=$value['id']?>"> <?=$value['title']?></option>
                                            <?php endforeach;?>
                                        </select>
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label" >
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;" >
                                        公开策略<i class="zmdi zmdi-help" data-toggle="tooltip" data-placement="right" data-original-title="是否公开最佳答案被其他人浏览."></i>
                                    </font>
                                </font>
                            </label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <div class="btn-group-toggle" data-toggle="buttons">
                                        <label class="btn <?php if (CommunityQuestion::PUBLIC_YES==$ques_info['is_public']):?>active<?php endif;?>" for="public_yes">
                                            <input type="radio"  value="<?=CommunityQuestion::PUBLIC_YES?>" name="is_public" id="public_yes"  <?php if (CommunityQuestion::PUBLIC_YES==$ques_info['is_public']):?>checked<?php endif;?> autocomplete="off"> 是
                                        </label>
                                        <label class="btn <?php if (CommunityQuestion::PUBLIC_NOT==$ques_info['is_public']):?>active<?php endif;?>" for="public_no">
                                            <input type="radio" value="<?=CommunityQuestion::PUBLIC_NOT?>" name="is_public" autocomplete="off" <?php if (CommunityQuestion::PUBLIC_YES==$ques_info['is_public']):?>checked<?php endif;?> > 否
                                        </label>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-2 col-form-label" >
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                        状态
                                    </font>
                                </font>
                            </label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <div class="btn-group-toggle" data-toggle="buttons">
                                        <label class="btn  <?php if (CommunityQuestion::STATUS_NORMAL==$ques_info['status']):?>active<?php endif;?>  ">
                                            <input type="radio"  value="<?=CommunityQuestion::STATUS_NORMAL?>" name="status" <?php if (CommunityQuestion::STATUS_NORMAL==$ques_info['status']):?>checked<?php endif;?>  autocomplete="off"> 开启
                                        </label>
                                        <label class="btn <?php if (CommunityQuestion::STATUS_CLOSE==$ques_info['status']):?>active<?php endif;?> ">
                                            <input type="radio" value="<?=CommunityQuestion::STATUS_CLOSE?>" name="status" autocomplete="off" <?php if (CommunityQuestion::STATUS_CLOSE==$ques_info['status']):?>checked<?php endif;?> > 隐藏
                                        </label>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-12">
                                <div id="ques-editormd">
                                    <textarea name="markdown_content" style="display:none;">
                                        <?=\yii\helpers\Html::encode($ques_info['markdown_content'])?></textarea>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?=$ques_info['id']?>">
                        <input type="hidden" name="html_content" value="">
                        <button type="button" onclick="createQues()" class="btn btn-primary float-right"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">更新问答</font></font></button>
                    </form>
                    <br>
                    <br>


                </div>
            </div>
        </div>
    </div>

</div>

<link rel="stylesheet" href="/editor/css/editormd.css" />

<script src="/editor/editormd.js"></script>
<script type="text/javascript">

    <?php if (isset($ques_model->getErrorSummary(false)[0])):?>
    notify("","","","danger","", "","<?=$ques_model->getErrorSummary(false)[0]?>");
    <?php endif;?>

    var editor = editormd("ques-editormd", {
        width  : "100%",
        height : 540,
        placeholder :"您想要知道点什么...",
        path   : "/editor/lib/",
        imageUpload : true,
        imageFormats : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
        imageUploadURL : "<?=Url::to(['/public/upload-img'])?>",
        onfullscreen         : function() {
            document.getElementsByClassName("header")[0].style.display='none';
        },
        onfullscreenExit     : function() {
            document.getElementsByClassName("header")[0].style.display='flex';
        },
    });
    function createQues() {
        var form=document.getElementById("create_ques");
        var title=document.getElementsByName("title")[0].value;
        var money=document.getElementsByName("money")[0].value;

        document.getElementsByName("html_content")[0].value=editor.getPreviewedHTML();

        if (title===""){
            notify("","","","danger","", "","标题不能为空");
            return false;
        }
        if (money===""){
            notify("","","","danger","", "","赏金不能为空");
            return false;
        }


        form.submit();
    }
</script>