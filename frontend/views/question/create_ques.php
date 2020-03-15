<div class="content__inner">
    <div class="row ">
        <div class="col-md-10 offset-1">
            <header class="content__title">
                <h1><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">发布新问答</font></font></h1>
            </header>
            <!-- style="word-wrap: normal;"  避免编辑器行数显示的数字出现自动换行问题-->
            <div class="card" style="word-wrap: normal;">
                <div class="card-body">
                    <form>
                        <div class="row">
                            <label class="col-sm-2 col-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">标题</font></font></label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="问答标题">
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">赏金</font></font></label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="赏金">
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">标签</font></font></label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <div class="select">
                                        <select class="form-control">
                                            <?php foreach ($tag_list as $key=>$value):?>
                                            <option  value="<?=$value['id']?>"> <?=$value['title']?></option>
                                            <?php endforeach;

                                            use common\models\CommunityQuestion; ?>
                                        </select>
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label" >
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;" data-toggle="tooltip" data-placement="right" data-original-title="是否公开最佳答案被其他人浏览.">
                                        公开策略
                                    </font>
                                </font>
                            </label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <div class="btn-group-toggle" data-toggle="buttons">
                                        <label class="btn active" for="public_yes">
                                            <input type="radio"  value="<?=CommunityQuestion::PUBLIC_YES?>"name="is_public" id="public_yes" autocomplete="off"> 是
                                        </label>
                                        <label class="btn" for="public_no">
                                            <input type="radio" value="<?=CommunityQuestion::PUBLIC_NOT?>" name="is_public" autocomplete="off"  id="public_no"> 否
                                        </label>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-12">
                                    <div id="ques-editormd">
                                         <textarea style="display:none;"></textarea>
                                    </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">创建问答</font></font></button>
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
    $(function() {
        var editor = editormd("ques-editormd", {
             width  : "100%",
             height : 540,
             placeholder :"您想要知道点什么...",
             path   : "/editor/lib/",

        });
    });
</script>