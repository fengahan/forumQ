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
                        <a href="" data-toggle="tooltip" data-placement="top" data-original-title="发布提问<?=$question_count?>次" class="badge badge-secondary">问(100)</a>
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
                            <a href="" class="zmdi <?=$value['icon']?> <?=$value['color']?>"  data-toggle="tooltip" data-title="<?=$value['name']?>" ></a>
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
                                <a class="nav-link<?php if ($tab=='home'):?> show active<?php endif;?>" href="<?=Url::to(['/user/center','tab'=>'home'])?>" aria-selected="false">基本信息</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link<?php if ($tab=='question'):?> show active<?php endif;?>"   href="<?=Url::to(['/user/center','tab'=>'question'])?>" aria-selected="false">我的问答</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link<?php if ($tab=='technology'):?> show active<?php endif;?>"  aria-selected="false">技术分享</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link<?php if ($tab=='subject'):?> show active<?php endif;?>" aria-selected="true">专题分享</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link<?php if ($tab=='message'):?> show active<?php endif;?>" data-toggle="tab"role="tab" aria-selected="true">系统消息</a>
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
                                            <span class="issue-tracker__tag bg-warning">已关闭</span>
                                        <?php elseif ($value['status']==CommunityQuestion::STATUS_DELETE):?>
                                            <span class="issue-tracker__tag bg-red">已删除/span>

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
                                                    <a class="dropdown-item" href="<?=Url::to(['question/action'])?>"><i class="zmdi zmdi-eye-off zmdi-hc-fw"></i>隐藏</a>
                                                    <a class="dropdown-item" href="<?=Url::to(['question/action'])?>"><i class="zmdi zmdi-delete zmdi-hc-fw"></i>删除</a>
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
                                <div class="listview listview--bordered issue-tracker">

                                    <div class="listview__item">
                                        <img src="static/mutui/demo/img/contacts/2.jpg" class="listview__img" alt=""
                                             title="张式娜"  data-toggle="tooltip" data-placement="left" >

                                        <div class="listview__content text-truncate text-truncate">
                                            <a class="listview__heading" href="">
                                                如何激活永久windows10 和office办公软件
                                            </a>
                                            <p>#张三 最后评论于 4小时前</p>
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-time"></i>17/11/2017
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-comments"></i> 04
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-favorite"></i> 25
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-eye"></i>5
                                        </div>

                                        <div class="issue-tracker__item actions">
                                            <div class="dropdown actions__item">
                                                <i class="zmdi zmdi-more-vert" data-toggle="dropdown" aria-expanded="false"></i>

                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu--active dropdown-menu--icon" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(30px, 26px, 0px);">
                                                    <a href="" class="dropdown-item"><i class="zmdi zmdi-edit"></i>编辑</a>
                                                    <a href="" class="dropdown-item"><i class="zmdi zmdi-delete"></i>删除</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="listview__item">
                                        <img src="static/mutui/demo/img/contacts/3.jpg" class="listview__img" alt=""
                                             title="完美如初."  data-toggle="tooltip" data-placement="left" >

                                        <div class="listview__content text-truncate">
                                            <a class="listview__heading" href="">
                                                如何激活永久windows10 和office办公软件
                                            </a>
                                            <p>#李四 最后回复于 2小时前</p>
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down" >

                                            <i class="zmdi zmdi-time" ></i>19/11/2017
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-comments"></i> 23
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-favorite"></i> 17
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-eye"></i>5
                                        </div>
                                        <div class="issue-tracker__item actions">
                                            <div class="dropdown actions__item">
                                                <i class="zmdi zmdi-more-vert" data-toggle="dropdown" aria-expanded="false"></i>

                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu--active dropdown-menu--icon" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(30px, 26px, 0px);">
                                                    <a href="" class="dropdown-item"><i class="zmdi zmdi-edit"></i>编辑</a>
                                                    <a href="" class="dropdown-item"><i class="zmdi zmdi-delete"></i>删除</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="listview__item">
                                        <i class="avatar-char bg-amber">K</i>

                                        <div class="listview__content text-truncate">
                                            <a class="listview__heading" href="">
                                                如何激活永久windows10 和office办公
                                            </a>
                                            <p>#王五 最后回复于 1 小时前</p>
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-time"></i>10/11/2017
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-comments"></i> 01
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-favorite"></i> 14
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-eye"></i>5
                                        </div>

                                        <div class="issue-tracker__item actions">
                                            <div class="dropdown actions__item">
                                                <i class="zmdi zmdi-more-vert" data-toggle="dropdown" aria-expanded="false"></i>

                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu--active dropdown-menu--icon" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(30px, 26px, 0px);">
                                                    <a href="" class="dropdown-item"><i class="zmdi zmdi-edit"></i>编辑</a>
                                                    <a href="" class="dropdown-item"><i class="zmdi zmdi-delete"></i>删除</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="listview__item">
                                        <i class="avatar-char bg-light-blue">T</i>

                                        <div class="listview__content text-truncate">
                                            <a class="listview__heading" href="">
                                                如何激活永久windows10 和office办公
                                            </a>
                                            <p>#王五 最后回复于 1 小时前</p>
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-time"></i>05/11/2017
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-comments"></i> 04
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-favorite"></i> 16
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-eye"></i>28
                                        </div>


                                    </div>

                                    <div class="listview__item">
                                        <img src="static/mutui/demo/img/contacts/1.jpg" class="listview__img" alt="">

                                        <div class="listview__content text-truncate">
                                            <a class="listview__heading" href="">
                                                如何激活永久windows10 和office办公软件
                                            </a>
                                            <p>#张三 最后回复于 4小时前</p>
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-time"></i>22/10/2017
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-comments"></i> 00
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-favorite"></i> 14
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-eye"></i>13
                                        </div>

                                    </div>

                                    <div class="listview__item">
                                        <i class="avatar-char bg-light-green">J</i>

                                        <div class="listview__content text-truncate">
                                            <a class="listview__heading" href="">
                                                如何激活永久windows10 和office办公软件
                                            </a>
                                            <p>#张三 最后回复于 4小时前</p>
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-time"></i>12/09/2017
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-comments"></i> 18
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-favorite"></i> 16
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-eye"></i>22
                                        </div>

                                    </div>

                                    <div class="listview__item">
                                        <img src="static/mutui/demo/img/contacts/5.jpg" class="listview__img" alt="">

                                        <div class="listview__content text-truncate">
                                            <a class="listview__heading" href="">
                                                如何激活永久windows10 和office办公
                                            </a>
                                            <p>#张三 最后回复于 4小时前</p>
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-time"></i>12/09/2017
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-comments"></i> 02
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-favorite"></i> 23
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-eye"></i>19
                                        </div>

                                    </div>

                                    <div class="listview__item">
                                        <img src="static/mutui/demo/img/contacts/6.jpg" class="listview__img" alt="">

                                        <div class="listview__content text-truncate">
                                            <a class="listview__heading" href="">
                                                如何激活永久windows10 和office办公
                                            </a>
                                            <p>#张三 最后回复于 4小时前</p>
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-time"></i>30/08/2017
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-comments"></i> 10
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-favorite"></i> 26
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-eye"></i>15
                                        </div>

                                    </div>

                                    <div class="listview__item">
                                        <img src="static/mutui/demo/img/contacts/7.jpg" class="listview__img" alt="">

                                        <div class="listview__content text-truncate">
                                            <a class="listview__heading" href="">
                                                如何激活永久windows10 和office办公
                                            </a>
                                            <p>#张三 最后回复于 4小时前</p>
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-time"></i>10/07/2017
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-comments"></i> 14
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-favorite"></i> 49
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-eye"></i>51
                                        </div>

                                    </div>

                                    <div class="listview__item">
                                        <i class="avatar-char bg-pink">L</i>

                                        <div class="listview__content text-truncate">
                                            <a class="listview__heading" href="">
                                                如何激活永久windows10 和office办公
                                            </a>
                                            <p>#张三 最后回复于 4小时前</p>
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-time"></i>10/07/2017
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-comments"></i> 10
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-favorite"></i> 26
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-eye"></i>5
                                        </div>

                                    </div>

                                    <div class="clearfix m-4"></div>
                                </div>
                                <nav>
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item pagination-first"><a class="page-link" href="#"></a></li>
                                        <li class="page-item pagination-prev"><a class="page-link" href="#"></a></li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                                        <li class="page-item pagination-next"><a class="page-link" href="#"></a></li>
                                        <li class="page-item pagination-last"><a class="page-link" href="#"></a></li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="tab-pane fade<?php if ($tab=='subject'):?> show active<?php endif;?>" >

                            </div>
                            <div class="tab-pane fade<?php if ($tab=='message'):?> show active<?php endif;?>" >

                            </div>
                        </div>
                    </div>
                </div>
            </div

        </div>


    </div>

</div>



<?php if ($tab=='' || $tab=='home'):?>


    <?php AppAsset::addScript($this,'/mutui/vendors/flot/jquery.flot.js')?>
<?php AppAsset::addScript($this,'/mutui/vendors/flot/jquery.flot.pie.js')?>
<?php AppAsset::addScript($this,'/mutui/demo/js/flot-charts/chart-tooltips.js')?>
<?php AppAsset::addScript($this,'/mutui/demo/js/flot-charts/pie.js')?>

<?php endif;?>
