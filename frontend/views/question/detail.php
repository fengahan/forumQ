<?php
use common\models\CommunityUsers;
use common\models\CommunityQuestion;
use common\models\CommunityUserTag;
use yii\helpers\Url;
use common\models\CommunityQuesReply;
$this->title = $question['title'] .'-'.Yii::$app->name;
?>
<div class="content__inner">
        <div class="row">
            <div class="col-lg-9 col-md-9">
                <div class="q-a__question">
                    <?php if ($question['is_public']==CommunityQuestion::PUBLIC_YES && $question['is_solve']!=CommunityQuestion::SOLVE_YES ):?>
                    <div class="q-a__vote hidden-sm-down">
                        <div class="q-a__vote__votes">
                            <i id="subscribe_number"><?=$question['subscribe_number']?></i>
                        </div>
                        <div class="team__social text-center" style="margin-top: 0px">
                            <a id="subscribe" href="#" onclick="subscribe('<?=$question['id']?>')" class="zmdi zmdi-help <?php if ($is_subscribe==1):?>bg-green<?php else:?> bg-dark<?php endif;?>" data-toggle="tooltip" data-title="有答案通知我" data-original-title="" title=""></a>
                        </div>
                    </div>
                    <?php endif;?>

                    <h2><?=$question['title']?></h2>

                    <div class="markdown-body editormd-preview-container">
                        <p>
                            <?=$question['html_content']?>
                        </p>
                    </div>

                    <div class="q-a__info">
                        <div class="q-a__op">
                            <a href=""><img src="<?=$question['avatar']?>" alt=""></a>
                            <span><?=$question['nickname']?>发布于<?=Yii::$app->formatter->asRelativeTime($question['created_at'])?></span>
                        </div>
                    </div>
                </div>
                <div class="q-a__question">
                    <div class="card">
                        <div class="toolbar toolbar--inner">
                            <div class="toolbar__label">总计
                                <span class="issue-tracker__tag bg-green"><?=$question['reply_number']?></span>
                                条回复
                            </div>
                        </div>

                        <div class="listview listview--bordered listview--block">
                            <?php foreach ( $reply_list as $key=>$value):?>
                            <div id="collapseList<?=$value['id']?>" style="display:none; ">
                                <div class="team__social text-center mt-0 text-white">
                                    <a onclick="replyEmj(<?=$value['id']?>,'thumb-up')" class="zmdi zmdi-thumb-up zmdi-hc-fw bg-info wp-30 hp-30"></a>
                                    <a  onclick="replyEmj(<?=$value['id']?>,'mood')" class="zmdi zmdi-mood zmdi-hc-fw bg-green wp-30 hp-30"></a>
                                    <a onclick="replyEmj(<?=$value['id']?>,'mood-bad')" class="zmdi zmdi-mood-bad zmdi-hc-fw bg-blue wp-30 hp-30"></a>
                                    <a  onclick="replyEmj(<?=$value['id']?>,'favorite')" class="zmdi zmdi-favorite zmdi-hc-fw bg-red wp-30 hp-30"></a>
                                </div>
                            </div>
                            <div class="listview__item" id="<?='reply-content-'.$value['id']?>">

                                <div class="q-a__info">
                                    <div class="q-a__op">
                                        <a href="" data-toggle="tooltip" data-placement="top" data-original-title="<?=$value['nickname']?>"><img src="<?=$value['avatar']?>" alt=""></a>
                                        <span>发布于<?=Yii::$app->formatter->asRelativeTime($value['created_at'])?></span>
                                    </div>
                                    <!--em 评论start-->
                                    <div class="team__social text-center mt-0 ml-4 p-1" >
                                        <?php $emj=\common\models\QuesReplyEmoji::getEmj($value['id']);?>
                                        <?php foreach ($emj as $k=>$v):?>
                                                <a href="javascript:void(0);" class="<?=$v['emoji_key']?>"></a>
                                                <span><?=$v['count']?></span>
                                        <?php endforeach;?>
                                    </div>
                                    <!--em 评论end-->
                                    <div class="q-a__vote-answer hidden-sm-down">

                                        <div class="listview__attrs">

                                            <?php if ($value['user_id']==$value['ques_user_id']):?>
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

                                            <div class="icon-toggle">
                                                <i class="zmdi zmdi-mood zmdi-hc-fw collapseList" data-template="collapseList<?=$value['id']?>"></i>

                                            </div>


                                            <div class="dropdown actions__item">

                                                <i class="zmdi zmdi-more" data-toggle="dropdown" ></i>
                                                <div class="dropdown-menu dropdown-menu-right">

                                                   <?php if (Yii::$app->user->isGuest==false && $value['user_id']!=Yii::$app->user->identity->getId()):?>
                                                       <a href="javascript:void(0);" class="dropdown-item"  onclick="reply(<?=$value['id']?>,'<?=$value["nickname"]?>')">回复</a>
                                                    <?php endif;?>
                                                    <?php if (Yii::$app->user->isGuest==false
                                                        && $question['user_id']==Yii::$app->user->identity->getId()
                                                        && empty($question['best_reply_id'])):?>

                                                        <a class="dropdown-item"  onclick="reply_accept(<?=$value['id']?>)">采纳</a>
                                                    <?php endif;?>
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#modal-share-comment<?=$value['id']?>" >分享</a>

                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <?php if ($value['parent_id']>0):?>
                                <?php $parent_reply=CommunityQuesReply::getReplyInfo($value['parent_id'])?>
                                    <div class="reply_block" >
                                    <div class="q-a__op">
                                        对
                                        <a  data-toggle="collapse" href="#collapseReply<?=$value['id']?>" role="button" aria-expanded="false" aria-controls="collapseReply<?=$value['id']?>">
                                            <img src="<?=$parent_reply['avatar']?>" alt="">
                                            <?=$parent_reply['nickname']?>#
                                        </a>
                                        回复
                                    </div>
                                    <div class="mt-2 collapse markdown-body editormd-preview-container" id="collapseReply<?=$value['id']?>" onclick="scrollToRep(<?=$value['parent_id']?>)">
                                        <?=$parent_reply['reply_html_content']?>
                                    </div>
                                </div>
                                <?php endif;?>
                                <div class= <?php if ($value['is_best']==CommunityQuesReply::BEST_YES):?>
                                     "markdown-body editormd-preview-container good_comment"  title="" data-toggle="tooltip"
                                    data-placement="top" data-original-title="该评论被采纳为最佳答案"
                                <?php else:?>
                                    "markdown-body editormd-preview-container"
                                <?php endif;?>
                                >


                                    <?=$value['reply_html_content']?>
                                </div>
                            </div>
                        <div class="modal fade" id="modal-share-comment<?=$value['id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title pull-left">分享评论</h5>
                                    </div>
                                    <div class="modal-body">
                                        <?=Url::to(['question/detail','question_id'=>$question['id'],'#'=>'reply-content-'.$value['id']],true)?>
                                    </div>

                                </div>
                            </div>
                        </div>

                            <?php endforeach;?>
                        </div>
                        <div class="listview__item">
                            <div class="q-a__op">
                                对<a id="reply_to_name" href="#" style="color: #2196F3">#当前文章#</a>回复
                                <a id="resetRepBtn" style="display: none" onclick="resetReplyObj()" href="javascript:void(0);" class="text-red" >撤销</a>
                            </div>

                            <div class="form-group">
                                <input type="hidden" id="reply_input" name="reply_id" value="">
                                <div id="ques-editormd">
                                    <textarea name="markdown_content" style="display:none;"></textarea>
                                </div>
                            </div>
                            <button onclick="replyDo()" class="btn btn-primary" style="float: right">回复</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <!--非大咖去掉badge-success-ext 这个样式-->
                        <div class="user <?php if (CommunityUsers::TYPE_FROM_CODE==$question_user_info['level']):?> badge-success-ext<?php endif;?>">
                            <div class="user__info">

                                <img class="user__img <?=CommunityUsers::GENDER_STYLE[$question_user_info['gender']]?>" src="<?=$question_user_info['avatar']?>" alt="">
                                <div>
                                    <div><?=$question_user_info['nickname']?>（<?=CommunityUsers::TYPE[$question_user_info['type']]?>）</div>
                                    <div>等级:<code><?=$question_user_info['level']?></code></div>
                                    <div><?=$question_user_info['email']?></div>
                                </div>
                            </div>

                        </div>
                        <p class="card-text"><?=$question_user_info['self_signature']?></p>

                        <div class="tags flot-chart-legends" >
                            <?php foreach ($question_user_tag as $key=>$value):?>
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
        <button id="to-top" class="btn btn-danger btn--action zmdi zmdi-chevron-up zmdi-hc-fw" onclick="GoTop()"></button>
</div>

<script src="/editor/editormd.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>
<script type="text/javascript">
    window.onscroll = function(){
        var t = document.documentElement.scrollTop || document.body.scrollTop;
        var top_div = document.getElementById( "to-top" );
        if( t >= 800 ) {
            top_div.style.display = "inline";
        } else {
            top_div.style.display = "none";
        }
    }
    var currentPosition,timer;
    var speed=10;
    function GoTop(){
        timer=setInterval(function () {
            currentPosition=document.documentElement.scrollTop || document.body.scrollTop;
            currentPosition-=speed; //speed变量
            if(currentPosition>0)
            {
                window.scrollTo(0,currentPosition);
            }
            else
            {
                window.scrollTo(0,0);
                clearInterval(timer);
            }
        },1);
    }
    var editor = editormd("ques-editormd", {
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
    function reply(id,reply_to_name) {
        var url= document.getElementById("modal-share-comment"+id).getElementsByClassName("modal-body")[0].innerText
        document.getElementById('reply_to_name').setAttribute("href",url.replace(/^\s*|\s*$/g,""))
        document.getElementById("ques-editormd").scrollIntoView();
        document.getElementById('reply_to_name').innerText=reply_to_name
        document.getElementById('reply_input').value=id
        document.getElementById("resetRepBtn").style.display="inline-block"
        return false;

    }
    //手动重置回复对象，如先点击了对A的回复后面想改为对文章对回复
    function resetReplyObj() {
        document.getElementById('reply_to_name').innerText="#当前文章#"
        document.getElementById('reply_input').value=0
        document.getElementById("resetRepBtn").style.display="none"
        return false;

    }

    function scrollToRep(id){
        var ele="reply-content-"+id;
        jQuery("html, body").animate({
            scrollTop: jQuery("#"+ele).offset().top }, {duration: 500,easing: "swing"});
    }
    function subscribe(id) {
       subEle= document.getElementById('subscribe');
       subNumEle=document.getElementById('subscribe_number');
       subNum=parseInt(subNumEle.innerText);
        $.ajax({
            type: "POST",
            dataType: 'json',
            data:{"id":id},
            url:"<?=Url::to(['/question/subscribe'])?>",
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
      var ques_id="<?=$question['id']?>";
      var html_content= editor.getPreviewedHTML();
      var markdown_content=editor.getMarkdown();
        $.ajax({
            type: "POST",
            dataType: 'json',
            data:{"parent_id":parent_id,"ques_id":ques_id,"html_content":html_content,"markdown_content":markdown_content},
            url:"<?=Url::to(['/question/reply'])?>",
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
    function replyEmj(ques_reply_id,emj_key) {
        var ques_id="<?=$question['id']?>";
        $.ajax({
            type: "POST",
            dataType: 'json',
            data:{"ques_id":ques_id,'ques_reply_id':ques_reply_id,"emj_key":emj_key},
            url:"<?=Url::to(['/question/reply-emj'])?>",
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

    function reply_accept(reply_id) {
        var ques_id="<?=$question['id']?>";
        $.ajax({
            type: "POST",
            dataType: 'json',
            data:{"ques_id":ques_id,'ques_reply_id':reply_id},
            url:"<?=Url::to(['/question/reply-accept'])?>",
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

    const template = document.getElementById('collapseEmj');

    tippy('.collapseList', {
        content(reference) {
            const id = reference.getAttribute('data-template');
            const template = document.getElementById(id);
            return template.innerHTML;
        },
        allowHTML: true,
        theme: 'light-border',
        trigger:'click',
        placement:'bottom',
        interactive:true,

    });
    </script>