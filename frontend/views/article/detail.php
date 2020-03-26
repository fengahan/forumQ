<?php
use common\models\CommunityUsers;
use common\models\CommunityQuestion;
use common\models\CommunityUserTag;
use yii\helpers\Url;
use common\models\CommunityQuesReply;
?>
<div class="content__inner">
    <div class="row">
        <div class="col-lg-9 col-md-9">
            <div class="q-a__question">
                    <div class="q-a__vote hidden-sm-down">
                        <div class="q-a__vote__votes">
                            <i id="heart_number"><?=$article['get_heart']?></i>
                        </div>
                        <div class="team__social text-center" style="margin-top: 0px">
                            <a id="to_heart" href="#" onclick="heart('<?=$article['id']?>')" class="zmdi zmdi-favorite <?php if ($is_heart==1):?>bg-green<?php else:?> bg-dark<?php endif;?>" data-toggle="tooltip" data-title="点赞" data-original-title="" title=""></a>
                        </div>
                    </div>

                <h2><?=$article['title']?></h2>

                <div class="markdown-body editormd-preview-container">
                    <p>
                        <?=$article['html_content']?>
                    </p>
                </div>

                <div class="q-a__info">
                    <div class="q-a__op">
                        <a href=""><img src="<?=$article['avatar']?>" alt=""></a>
                        <span><?=$article['nickname']?>发布于<?=Yii::$app->formatter->asRelativeTime($article['created_at'])?></span>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="toolbar toolbar--inner">
                    <div class="toolbar__label">总计
                        <span class="issue-tracker__tag bg-green"><?=$article['reply_number']?></span>
                        条回复
                    </div>
                </div>

                <div class="listview listview--bordered listview--block">
                    <?php foreach ( $reply_list as $key=>$value):?>
                    <div class="listview__item" id="<?='reply-content'.$value['id']?>">

                        <div class="q-a__info">
                            <div class="q-a__op">
                                <a href="" data-toggle="tooltip" data-placement="top" data-original-title="<?=$value['nickname']?>"><img src="<?=$value['avatar']?>" alt=""></a>
                                <span>发布于<?=Yii::$app->formatter->asRelativeTime($value['created_at'])?></span>
                            </div>
                            <!--em 评论start-->
                            <div class="team__social text-center mt-0 ml-4 p-1" >

                            </div>
                            <!--em 评论end-->
                            <div class="q-a__vote-answer hidden-sm-down">

                                <div class="listview__attrs">

                                    <?php if ($value['user_id']==$value['article_user_id']):?>
                                        <span title="" data-toggle="tooltip"
                                              data-placement="top" data-original-title="该用户是本文章的作者">
                                                       作者
                                                    </span>
                                    <?php endif;?>
                                    <?php if ($value['type']==CommunityUsers::TYPE_FROM_CODE):?>
                                        <span title="" data-toggle="tooltip"
                                              data-placement="top" data-original-title="该用户是平台邀请来的大咖.">
                                                   专家
                                                </span>
                                    <?php endif;?>


                                    <?php if (Yii::$app->user->isGuest==false):?>
                                        <div class="icon-toggle <?php if (!empty(\common\models\ArticleReplyPraise::getRow($value['id'],Yii::$app->user->identity->getId()))):?>icon-toggle--green<?php endif;?>">
                                            <input type="checkbox" onclick="replyPraise(<?=$value['id']?>)" <?php if (!empty(\common\models\ArticleReplyPraise::getRow($value['id'],Yii::$app->user->identity->getId()))):?> checked<?php endif;?>>
                                            <i class="zmdi zmdi-thumb-up zmdi-hc-fw " ></i><?=$value['praise_nums']?>
                                        </div>
                                    <?php else:?>
                                        <div class="icon-toggle"  onclick="replyPraise(<?=$value['id']?>)">
                                            <input type="checkbox" checked="">
                                            <i class="zmdi zmdi-thumb-up zmdi-hc-fw  "></i><?=$value['praise_nums']?>
                                        </div>
                                    <?php endif;?>


                                    <div class="dropdown actions__item">

                                        <i class="zmdi zmdi-more" data-toggle="dropdown" ></i>
                                        <div class="dropdown-menu dropdown-menu-right">

                                            <?php if (Yii::$app->user->isGuest==false && $value['user_id']!=Yii::$app->user->identity->getId()):?>
                                                <a class="dropdown-item"  onclick="reply(<?=$value['id']?>)">回复</a>
                                            <?php endif;?>
                                            <a class="dropdown-item" data-toggle="modal" data-target="#modal-share-comment<?=$value['id']?>" >分享</a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <?php if ($value['parent_id']>0):?>
                        <?php $parent_reply=\common\models\ArticlesReply::getReplyInfo($value['parent_id'])?>
                        <div class="reply_block" >
                            <div class="q-a__op">
                                对
                                <a  data-toggle="collapse" href="#collapseReply<?=$value['id']?>" role="button" aria-expanded="false" aria-controls="collapseReply<?=$value['id']?>">
                                    <img src="<?=$parent_reply['avatar']?>" alt="">
                                    <?=$parent_reply['nickname']?>#
                                </a>
                                回复
                            </div>
                            <div class="mt-2 collapse markdown-body editormd-preview-container" id="collapseReply<?=$value['id']?>">
                                <?=$parent_reply['html_content']?>
                            </div>
                        </div>
                        <?php endif;?>
                        <div class="markdown-body editormd-preview-container">
                             <?=$value['html_content']?>
                        </div>
                </div>
                <div class="modal fade" id="modal-share-comment<?=$value['id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title pull-left">分享评论</h5>
                            </div>
                            <div class="modal-body">
                                <?=Url::to(['article/detail','article_id'=>$article['id'],'#'=>'reply-content'.$value['id']],true)?>
                            </div>

                        </div>
                    </div>
                </div>

                <?php endforeach;?>
            </div>

            <div class="listview__item">
                <div class="form-group">
                    <input type="hidden" id="reply_input" name="reply_id" value="">
                    <div id="article-editormd">
                        <textarea name="markdown_content" style="display:none;"></textarea>
                    </div>
                </div>

                <button onclick="replyDo()" class="btn btn-primary">回复</button>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-3">
        <div class="card">
            <div class="card-body">
                <!--非大咖去掉badge-success-ext 这个样式-->
                <div class="user <?php if (CommunityUsers::TYPE_FROM_CODE==$article_user_info['level']):?> badge-success-ext<?php endif;?>">
                    <div class="user__info">

                        <img class="user__img <?=CommunityUsers::GENDER_STYLE[$article_user_info['gender']]?>" src="<?=$article_user_info['avatar']?>" alt="">
                        <div>
                            <div><?=$article_user_info['nickname']?>（<?=CommunityUsers::TYPE[$article_user_info['type']]?>）</div>
                            <div>等级:<code><?=$article_user_info['level']?></code></div>
                            <div><?=$article_user_info['email']?></div>
                        </div>
                    </div>

                </div>
                <p class="card-text"><?=$article_user_info['self_signature']?></p>

                <div class="tags flot-chart-legends" >
                    <?php foreach ($article_user_tag as $key=>$value):?>
                        <a href="#" data-toggle="tooltip" data-placement="top" data-original-title="级别:<?=CommunityUserTag::LEVEL[$value['level']]?>">
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
                        <a  target="_blank" href="<?=Url::to(['public/user-link-jump','id'=>$value['id']])?>" class="zmdi <?=$value['icon']?> <?=$value['color']?>"  data-toggle="tooltip" data-title="<?=$value['name']?>&nbsp;点击次数：<?=$value['click_number']?>" ></a>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>

</div>

</div>

<script src="/editor/editormd.js"></script>
<script type="text/javascript">

    var editor = editormd("article-editormd", {
        width  : "100%",
        height:240,
        autoFocus:false,
        //autoHeight:true,
        placeholder :"您想要知道点什么...",
        path   : "/editor/lib/",
        imageUpload : true,
        imageFormats : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
        imageUploadURL : "<?=Url::to(['/public/upload-img'])?>",
        onfullscreen         : function() {

            document.getElementsByClassName("col-lg-3 col-md-3")[0].style.display='none';
            document.getElementsByClassName("header")[0].style.display='none';
        },
        onfullscreenExit     : function() {
            document.getElementsByClassName("col-lg-3 col-md-3")[0].style.display='block';
            document.getElementsByClassName("header")[0].style.display='flex';
        },
    });
    function reply(id) {
        document.getElementById("article-editormd").scrollIntoView();

        document.getElementById('reply_input').value=id
        return false;

    }

    function heart(id) {
        subEle= document.getElementById('to_heart');
        subNumEle=document.getElementById('heart_number');
        subNum=parseInt(subNumEle.innerText);
        $.ajax({
            type: "POST",
            dataType: 'json',
            data:{"id":id},
            url:"<?=Url::to(['/article/heart'])?>",
            success: function (res) {
                if (res.code==100){
                    if(res.data.action=="cancel"){
                        subNumEle.innerText=subNum-1;
                        subEle.classList.replace("bg-green","bg-dark")
                        notify("","","","warning","","",res.msg);
                    }else {
                        subNumEle.innerText=subNum+1;
                        subEle.classList.replace("bg-dark","bg-green")
                        notify("","","","success","","",res.msg);
                    }

                }else {
                    notify("","","","danger","","",res.msg);
                }
            }

        });
        return  false;


    }

    function replyDo() {
        var  parent_id=document.getElementById('reply_input').value;
        var article_id="<?=$article['id']?>";
        var html_content= editor.getPreviewedHTML();
        var markdown_content=editor.getMarkdown();
        $.ajax({
            type: "POST",
            dataType: 'json',
            data:{"parent_id":parent_id,"article_id":article_id,"html_content":html_content,"markdown_content":markdown_content},
            url:"<?=Url::to(['/article/reply'])?>",
            success: function (res) {
                if (res.code==100){
                    notify("","","","success","","",res.msg);
                    window.location.reload();
                }else {
                    notify("","","","danger","","",res.msg);
                }
            }

        });
        return  false;

    }
    function replyPraise(article_reply_id) {
        var article_id="<?=$article['id']?>";
        $.ajax({
            type: "POST",
            dataType: 'json',
            data:{"article_id":article_id,'article_reply_id':article_reply_id},
            url:"<?=Url::to(['/article/reply-praise'])?>",
            success: function (res) {
                if (res.code==100){
                    notify("","","","success","","",res.msg);
                    window.location.reload();
                }else {
                    notify("","","","danger","","",res.msg);
                }
            }

        });
        return  false;

    }


</script>