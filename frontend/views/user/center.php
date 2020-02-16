<?php
use common\models\CommunityUserTag;
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
        </div>

        <div class="col-lg-9 col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="tab-container">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link show active" data-toggle="tab" href="#home" role="tab" aria-selected="false">基本信息</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link show" data-toggle="tab" href="#answer" role="tab" aria-selected="false">我的问答</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link show" data-toggle="tab" href="#technology" role="tab" aria-selected="false">技术分享</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link show" data-toggle="tab" href="#subject" role="tab" aria-selected="true">专题分享</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link show" data-toggle="tab" href="#message" role="tab" aria-selected="true">系统消息</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="home" role="tabpanel">
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
                                                <strong class="text-blue">320</strong>
                                                <small>技能点</small>
                                            </span>

                                            <span class="hidden-md-down">
                                                <strong class="text-blue">0</strong>
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
                                        <h6 class="card-subtitle">张三<code><?=Yii::$app->formatter->asRelativeTime(Yii::$app->user->identity->created_at)?></code>成为本站会员</h6>
                                        <div class="progress">

                                            <div class="progress-bar"
                                                 role="progressbar" style="width: 15%"
                                                 aria-valuenow="15" aria-valuemin="0"
                                                 aria-valuemax="100" data-toggle="tooltip" data-placement="top"
                                                 data-original-title="2018-10技能点100(T0)">

                                            </div>

                                            <div class="progress-bar bg-success"
                                                 role="progressbar" style="width: 30%"
                                                 aria-valuenow="30" aria-valuemin="0"
                                                 aria-valuemax="100"
                                                 data-toggle="tooltip" data-placement="top"
                                                 data-original-title="2019-10技能点600(T1)">

                                            </div>

                                            <div class="progress-bar bg-warning"
                                                 role="progressbar" style="width: 20%"
                                                 aria-valuenow="20" aria-valuemin="0"
                                                 aria-valuemax="100"
                                                 data-toggle="tooltip" data-placement="top"
                                                 data-original-title="技能点3500(还差500升级为T3)">

                                            </div>
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
                            <div class="tab-pane fade" id="answer" role="tabpanel">

                                <div class="listview listview--bordered issue-tracker">

                                    <div class="listview__item">
                                        <img src="static/mutui/demo/img/contacts/2.jpg" class="listview__img" alt=""
                                             title="张式娜"  data-toggle="tooltip" data-placement="left" >

                                        <div class="listview__content text-truncate text-truncate">
                                            <a class="listview__heading" href="">
                                                如何激活永久windows10 和office办公软件
                                            </a>
                                            <p>#张三 最后回复于 4小时前</p>
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-time"></i>17/11/2017
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-comments"></i> 04
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-money-box"></i>5
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-help"></i>5
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-eye"></i>5
                                        </div>
                                        <div class="issue-tracker__item actions">
                                            <div class="dropdown actions__item">
                                                <i class="zmdi zmdi-more-vert" data-toggle="dropdown" aria-expanded="false"></i>

                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu--active dropdown-menu--icon" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(30px, 26px, 0px);">
                                                    <a href="" class="dropdown-item"><i class="zmdi zmdi-close"></i>关闭</a>
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
                                            <i class="zmdi zmdi-money-box"></i>5
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-help"></i>5
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-eye"></i>5
                                        </div>
                                        <div class="issue-tracker__item actions">
                                            <div class="dropdown actions__item">
                                                <i class="zmdi zmdi-more-vert" data-toggle="dropdown" aria-expanded="false"></i>

                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu--active dropdown-menu--icon" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(30px, 26px, 0px);">
                                                    <a href="" class="dropdown-item"><i class="zmdi zmdi-close"></i>关闭</a>
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
                                            <i class="zmdi zmdi-money-box"></i>5
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-help"></i>5
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-eye"></i>5
                                        </div>

                                        <div class="issue-tracker__item actions">
                                            <div class="dropdown actions__item">
                                                <i class="zmdi zmdi-more-vert" data-toggle="dropdown" aria-expanded="false"></i>

                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu--active dropdown-menu--icon" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(30px, 26px, 0px);">
                                                    <a href="" class="dropdown-item"><i class="zmdi zmdi-close"></i>关闭</a>
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
                                            <i class="zmdi zmdi-money-box"></i>5
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-help"></i>5
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-eye"></i>5
                                        </div>

                                        <div class="issue-tracker__item actions">
                                            <div class="dropdown actions__item">
                                                <i class="zmdi zmdi-more-vert" data-toggle="dropdown" aria-expanded="false"></i>

                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu--active dropdown-menu--icon" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(30px, 26px, 0px);">
                                                    <a href="" class="dropdown-item"><i class="zmdi zmdi-close"></i>关闭</a>
                                                    <a href="" class="dropdown-item"><i class="zmdi zmdi-edit"></i>编辑</a>
                                                    <a href="" class="dropdown-item"><i class="zmdi zmdi-delete"></i>删除</a>
                                                </div>
                                            </div>
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
                                            <i class="zmdi zmdi-money-box"></i>5
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-help"></i>5
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-eye"></i>5
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
                                            <i class="zmdi zmdi-money-box"></i>5
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-help"></i>5
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-eye"></i>5
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
                                            <i class="zmdi zmdi-money-box"></i>5
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-help"></i>5
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-eye"></i>5
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
                                            <i class="zmdi zmdi-money-box"></i>5
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-help"></i>5
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-eye"></i>5
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
                                            <i class="zmdi zmdi-comments"></i> 10
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-money-box"></i>5
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-help"></i>5
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-eye"></i>5
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
                                            <i class="zmdi zmdi-money-box"></i>5
                                        </div>

                                        <div class="issue-tracker__item hidden-md-down">
                                            <i class="zmdi zmdi-help"></i>5
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
                            <div class="tab-pane fade" id="technology" role="tabpanel">
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
                            <div class="tab-pane fade" id="subject" role="tabpanel">

                            </div>
                            <div class="tab-pane fade" id="message" role="tabpanel">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>

</div>
