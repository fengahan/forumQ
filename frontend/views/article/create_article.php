<?php
use yii\helpers\Url;

$this->title = "创建技术分享".'-'.Yii::$app->name;
?>
<div class="content__inner">
    <div class="row ">
        <div class="col-md-10 offset-1">
            <header class="content__title">
                <h1><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">发布技术分享</font></font></h1>
            </header>
            <!-- style="word-wrap: normal;"  避免编辑器行数显示的数字出现自动换行问题-->
            <div class="card" style="word-wrap: normal;">
                <div class="card-body">
                    <form id= "create_article" method="post" action="<?=Url::to("/article/create")?>">

                        <div class="row">
                            <label class="col-sm-2 col-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">标题</font></font></label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="title" placeholder="请输入标题">
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
                                                <option  value="<?=$value['id']?>"> <?=$value['title']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <i class="form-group__bar"></i>
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
                                        <label class="btn ">
                                            <input type="radio"  value="<?=\common\models\Articles::STATUS_NORMAL?>" name="status" autocomplete="off"> 开启
                                        </label>
                                        <label class="btn active">
                                            <input type="radio" value="<?=\common\models\Articles::STATUS_CLOSE?>" name="status" autocomplete="off" checked > 隐藏
                                        </label>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-12">
                                <div id="article-editormd">
                                    <textarea name="markdown_content" style="display:none;"></textarea>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="html_content" value="">
                        <button type="button" onclick="createArticle()" class="btn btn-primary  float-right"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">创建技术分享</font></font></button>
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

    <?php if (isset($article_model->getErrorSummary(false)[0])):?>
    notify("","","","danger","", "","<?=$article_model->getErrorSummary(false)[0]?>");
    <?php endif;?>

    var editor = editormd("article-editormd", {
        width  : "100%",
        height : 540,
        placeholder :"您想要说点什么...",
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
    function createArticle() {
        var form=document.getElementById("create_article");
        var title=document.getElementsByName("title")[0].value;
        document.getElementsByName("html_content")[0].value=editor.getPreviewedHTML();
        if (title===""){
            notify("","","","danger","", "","标题不能为空");
            return false;
        }
        form.submit();
    }
</script>