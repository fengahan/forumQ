<?php
use common\models\CommunityUserTag;
use frontend\assets\AppAsset;
use yii\helpers\Url;
use common\models\CommunityQuestion;
?>
<div class="content__inner">
    <div class="row">
        <div class="col-lg-3 col-md-3">
            <div class="card">
                <div class="card-body">
                    <!--非大咖去掉badge-success-ext 这个样式-->
                    <div class="user badge-success-ext">
                        <div class="user__info">
                            <img class="user__img" src="<?=Yii::$app->user->identity->avatar?>" alt="">
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
                                <a class="nav-link<?php if ($tab=='home'):?> show active<?php endif;?>" href="<?=Url::to(['/user/center','tab'=>'home'])?>" aria-selected="false">基本信息</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link<?php if ($tab=='question'):?> show active<?php endif;?>"   href="<?=Url::to(['/user/center','tab'=>'question'])?>" aria-selected="false">我的问答</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link<?php if ($tab=='technology'):?> show active<?php endif;?>" href="<?=Url::to(['/user/center','tab'=>'technology'])?>" aria-selected="false">技术分享</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link<?php if ($tab=='message'):?> show active<?php endif;?>" href="<?=Url::to(['/user/center','tab'=>'message'])?>" role="tab" aria-selected="true">系统消息</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade<?php if ($tab=='home'):?> show active<?php endif;?>" >
                                <div class="card">

                                    <div class="card-body">
                                        <h4 class="card-title">个人信息</h4>
                                        <h6 class="card-subtitle">这是您一路来留下的脚印.</h6>

                                        <div class="q-a__stat">
                                              <span>
                                                <strong class="text-red"><?=Yii::$app->user->identity->integral?></strong>
                                                <small>当前积分</small>
                                              </span>

                                            <span>
                                                <strong class="text-blue"><?=Yii::$app->user->identity->technical?></strong>
                                                <small>技能点</small>
                                            </span>

                                            <span class="hidden-md-down">
                                                <strong class="text-blue"><?=Yii::$app->user->identity->sign_count?></strong>
                                                <small>签到次数</small>
                                            </span>

                                            <span class="hidden-md-down">
                                                <strong class="text-blue"><?=Yii::$app->user->identity->center_view_count?></strong>
                                                <small>主页访问量</small>
                                            </span>

                                            <span class="hidden-md-down">
                                                <strong class="text-blue"><?=Yii::$app->user->identity->get_heart_count?> </strong>
                                                <small>收到<i class="zmdi zmdi-favorite"></i></small>
                                            </span>

                                            <span class="hidden-md-down">
                                                <strong class="text-blue"><?=Yii::$app->user->identity->given_heart_count?></strong>
                                                 <small>送出<i class="zmdi zmdi-favorite"></i> </small>
                                             </span>
                                        </div>

                                    </div>

                                </div>

                                <!--成长历史录-->
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">成长历史录</h4>
                                        <h6 class="card-subtitle"><code><?=Yii::$app->formatter->asRelativeTime(Yii::$app->user->identity->created_at)?></code>成为本站会员</h6>
                                        <div class="progress">
                                            <?php $color_style=['bg-light-blue','bg-green','bg-amber','bg-orange','bg-red','bg-purple']?>
                                            <?php foreach ($grade_progress as $key=>$val):?>
                                                <?php if ((count($grade_progress)<5 && $key!=count($grade_progress)-1) || count($grade_progress)>5) :?>
                                                    <?php $tip=Yii::$app->formatter->asDate($val['created_at']).'技能点'.$val['technical'].'('.$val['level'].')'?>
                                                <?php else:?>

                                                    <?php $blanc=48000-$val['technical']?>
                                                    <?php $tip=Yii::$app->formatter->asDate($val['created_at']).'技能点'.$val['technical'].'('.$val['level'].')'.'还差'. $blanc.'升级'?>
                                                <?php endif;?>

                                                <div class="progress-bar <?=$color_style[$key]?>"
                                                 role="progressbar" style="width:<?=($key+1)*5?>%"
                                                 aria-valuenow="<?=$val['technical']?>" aria-valuemin="0"
                                                 aria-valuemax="48000" data-toggle="tooltip" data-placement="top"
                                                 data-original-title="<?=$tip?>">

                                            </div>
                                            <?php endforeach;?>
                                        </div   >

                                    </div>
                                </div>
                                <!--成长分析录-->
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">成长分析录</h4>
                                        <h6 class="card-subtitle">会员技能点来源分布.</h6>
                                        <div class="flot-chart-250 flot-pie" style="padding: 0px; position: relative;">

                                        </div>
                                        <div class="flot-chart-legends flot-chart-legend--pie">

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade<?php if ($tab=='question'):?> show active<?php endif;?>" >

                                <div class="listview listview--bordered issue-tracker">

                                    <?php foreach ($user_question as $key=>$value):?>
                                    <div class="listview__item">
                                        <div class="listview__content text-truncate">
                                            <a class="listview__heading" href="<?=Url::to(['question/detail','question_id'=>$value['id']])?>" title="<?=$value['title']?>">
                                             <?=\yii\helpers\StringHelper::truncate($value['title'],32)?>
                                            </a>
                                            <?php if ($value['last_reply_nickname']!=''):?>
                                                <p>#<?=$value['last_reply_nickname']?> 回复于<?=Yii::$app->formatter->asRelativeTime($value['last_reply_at']);?></p>
                                            <?php endif;?>

                                        </div>

                                        <?php if ($value['is_solve']==CommunityQuestion::SOLVE_YES):?>
                                            <span class="issue-tracker__tag bg-success">已解决</span>
                                        <?php elseif ($value['is_solve']==CommunityQuestion::SOLVE_NOT):?>
                                        <span class="issue-tracker__tag bg-cyan">未解决</span>

                                        <?php endif;?>

                                        <?php if ($value['status']==CommunityQuestion::STATUS_CLOSE):?>
                                            <span class="issue-tracker__tag bg-warning">已隐藏</span>
                                        <?php elseif ($value['status']==CommunityQuestion::STATUS_DELETE):?>
                                            <span class="issue-tracker__tag bg-red">已删除</span>

                                        <?php endif;?>

                                        <div class="issue-tracker__item ">
                                            <i class="zmdi zmdi-time"></i>
                                            <?=Yii::$app->formatter->asRelativeTime($value['created_at']);?>
                                        </div>

                                        <div class="issue-tracker__item">
                                            <i class="zmdi zmdi-comments"></i>
                                            <?=$value['reply_number']?>
                                        </div>

                                        <div class="issue-tracker__item">
                                            <i class="zmdi zmdi-money-box"></i>
                                            <?=$value['money']?>
                                        </div>

                                        <div class="issue-tracker__item ">
                                            <i class="zmdi zmdi-help"></i>
                                            <?=$value['subscribe_number']?>
                                        </div>

                                        <div class="issue-tracker__item">
                                            <i class="zmdi zmdi-eye"></i>
                                            <?=$value['view_number']?>
                                        </div>

                                        <div class="issue-tracker__item">
                                            <div class="dropdown actions__item">
                                                <i class="zmdi zmdi-more-vert" data-toggle="dropdown"></i>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="<?=Url::to(['question/update','id'=>$value['id']])?>"><i class="zmdi zmdi-edit zmdi-hc-fw"></i>编辑</a>
                                                    <a class="dropdown-item"  onclick="ques_action(<?=$value['id']?>,<?=CommunityQuestion::STATUS_CLOSE?>)"><i class="zmdi zmdi-eye-off zmdi-hc-fw"></i>隐藏</a>
                                                    <a class="dropdown-item"  onclick="ques_action(<?=$value['id']?>,<?=CommunityQuestion::STATUS_DELETE?>)"><i class="zmdi zmdi-delete zmdi-hc-fw"></i>删除</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <?php endforeach;?>
                                    <div class="clearfix m-4"></div>
                                </div>
                                 <?= $this->render('@app/views/common/paginator.php',['pagination'=>$question_pagination]);?>
                            </div>
                            <div class="tab-pane fade<?php if ($tab=='technology'):?> show active<?php endif;?>" >
                                <?php foreach ($user_article as $key=>$value):?>


                                <div class="listview listview--bordered issue-tracker">

                                    <div class="listview__item">
                                        <div class="listview__content text-truncate text-truncate">
                                            <a class="listview__heading" href="<?=Url::to(['article/detail','article_id'=>$value['id']])?>">
                                                <?=\yii\helpers\StringHelper::truncate($value['title'],32)?>
                                            </a>
                                        </div>

                                        <?php if ($value['status']==\common\models\Articles::STATUS_CLOSE):?>
                                            <span class="issue-tracker__tag bg-warning">已关闭</span>
                                        <?php endif;?>
                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-time"></i>
                                            <?=Yii::$app->formatter->asRelativeTime($value['created_at']);?>
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-comments"></i>
                                            <?=$value['reply_number']?>
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-favorite"></i>
                                            <?=$value['get_heart']?>
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-eye"></i>
                                            <?=$value['view_number']?>
                                        </div>

                                        <div class="issue-tracker__item">
                                            <div class="dropdown actions__item">
                                                <i class="zmdi zmdi-more-vert" data-toggle="dropdown"></i>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="<?=Url::to(['article/update','id'=>$value['id']])?>"><i class="zmdi zmdi-edit zmdi-hc-fw"></i>编辑</a>
                                                    <a class="dropdown-item"  onclick="article_action(<?=$value['id']?>,<?=CommunityQuestion::STATUS_CLOSE?>)"><i class="zmdi zmdi-eye-off zmdi-hc-fw"></i>隐藏</a>
                                                    <a class="dropdown-item"  onclick="article_action(<?=$value['id']?>,<?=CommunityQuestion::STATUS_DELETE?>)"><i class="zmdi zmdi-delete zmdi-hc-fw"></i>删除</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="clearfix m-4"></div>
                                </div>
                                <?php endforeach;?>
                                <div class="clearfix m-4"></div>
                                <?= $this->render('@app/views/common/paginator.php',['pagination'=>$article_pagination]);?>
                            </div>
                            <div class="tab-pane fade<?php if ($tab=='message'):?> show active<?php endif;?>" >
                                <div class="listview listview--bordered issue-tracker">
                                <?php foreach ($message as $key=>$value):?>
                                    <div class="modal fade" id="modal-centered<?=$value['id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title pull-left">消息内容</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <?=$value['content']?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link" data-dismiss="modal">关闭</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="listview__item">
                                        <div class="listview__content text-truncate text-truncate">
                                            <a class="listview__heading" data-toggle="modal" data-target="#modal-centered<?=$value['id']?>">
                                                <?=\yii\helpers\StringHelper::truncate($value['content'],32)?>
                                            </a>
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-time"></i>
                                            <?=Yii::$app->formatter->asRelativeTime($value['created_at']);?>
                                        </div>

                                    </div>
                                    <?php endforeach;?>
                                    <div class="clearfix m-4"></div>
                                    <?= $this->render('@app/views/common/paginator.php',['pagination'=>$message_pagination]);?>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div

        </div>


    </div>

</div>

<script type="text/javascript">
    function ques_action(id,status) {
        $.ajax({
            type: "POST",
            dataType: 'json',
            data:{"id":id,"status":status},
            url:"<?=Url::to(['/question/action'])?>",
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
    function article_action(id,status) {
        $.ajax({
            type: "POST",
            dataType: 'json',
            data:{"id":id,"status":status},
            url:"<?=Url::to(['/article/action'])?>",
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

<?php if ($tab=='' || $tab=='home'):?>


    <?php AppAsset::addScript($this,'/mutui/vendors/flot/jquery.flot.js')?>
<?php AppAsset::addScript($this,'/mutui/vendors/flot/jquery.flot.pie.js')?>
<?php AppAsset::addScript($this,'/mutui/demo/js/flot-charts/chart-tooltips.js')?>
<?php AppAsset::addScript($this,'/mutui/demo/js/flot-charts/pie.js')?>

<?php endif;?>
