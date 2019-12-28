<div class="content__inner">
        <div class="row">
            <div class="col-lg-9 col-md-9">
                <div class="q-a__question">
                    <div class="q-a__vote hidden-sm-down">
                        <div class="q-a__vote__votes">
                            <i><?=$question['subscribe_number']?></i>
                        </div>
                        <div class="icon-toggle">
                            <i class="zmdi zmdi-help"  data-toggle="tooltip" data-title="有答案通知我" ></i>
                        </div>
                    </div>

                    <h2><?=$question['title']?></h2>
                    <p>
                        <?=$question['html_content']?>
                    </p>

                    <div class="q-a__info">
                        <div class="q-a__op">
                            <a href=""><img src="static/mutui/demo/img/contacts/1.jpg" alt=""></a>
                            <span><?=$question['nickname']?>发布于<?=Yii::$app->formatter->asRelativeTime($question['created_at'])?></span>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="toolbar toolbar--inner">
                        <div class="toolbar__label">总计
                            <span class="issue-tracker__tag bg-green"><?=$question['reply_number']?></span>
                            条回复
                        </div>
                        <nav class="toolbar__nav ml-auto hidden-sm-down">
                            <a href="" class="active">新发布</a>
                            <a href="">新活跃</a>
                            <a href="">之前的</a>
                        </nav>
                    </div>

                    <div class="listview listview--bordered listview--block">
                        <div class="listview__item">
                            <p>Aenean eu leo quam.
                                Pellentesque ornare sem lacinia quam venenatis vestibulum.
                                Maecenas sed diam eget risus varius blandit sit amet non magna.
                                Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida at eget metus.
                                Cras justo odio, dapibus ac facilisis in, egestas eget quam.
                                Vestibulum id ligula porta felis euismod semper. Cras justo odio, dapibus ac facilisis in,
                                egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh,
                                ut fermentum massa justo sit amet risus. Donec id elit non mi porta gravida at eget metus.
                            </p>

                            <div class="q-a__info">
                                <div class="q-a__op">
                                    <a href="" data-toggle="tooltip" data-placement="top" data-original-title="李四"><img src="static/mutui/demo/img/contacts/2.jpg" alt=""></a>
                                    <span>发布于26小时前</span>
                                </div>
                                <!--em 评论start-->
                                <div class="team__social text-center mt-0 ml-4 p-1" >
                                    <a href="" class="zmdi zmdi-face zmdi-hc-fw bg-green wp-30 hp-30"></a>+4

                                    <a href="" class="zmdi zmdi-favorite zmdi-hc-fw bg-red wp-30 hp-30"></a> +6

                                </div>
                                <!--em 评论end-->
                                <div class="q-a__vote-answer hidden-sm-down">

                                    <div class="listview__attrs">

                                                <span title="" data-toggle="tooltip"
                                                      data-placement="top" data-original-title="该用户是本文章的作者">
                                                   作者
                                                </span>

                                        <span title="" data-toggle="tooltip"
                                              data-placement="top" data-original-title="该用户是平台邀请来的大咖.">
                                                   专家
                                                </span>

                                        <div class="icon-toggle">
                                            <i class="zmdi zmdi-mood zmdi-hc-fw"></i>

                                        </div>

                                        <div class="dropdown actions__item">
                                            <i class="zmdi zmdi-more" data-toggle="dropdown"></i>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="">回复</a>
                                                <a class="dropdown-item" href="">分享</a>
                                                <a class="dropdown-item" href="">删除</a>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="listview__item">
                            <!--被采纳答案 -->
                            <p class="good_comment" title="" data-toggle="tooltip"
                               data-placement="top" data-original-title="该评论被采纳为最佳答案">

                                Cras mattis consectetur purus sit amet fermentum. Nullam id dolor id nibh ultricies vehicula ut id elit.
                                Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ullamcorper nulla non metus auctor fringilla.
                                Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Donec sed odio dui.
                            </p>

                            <div class="q-a__info">
                                <div class="q-a__op">
                                    <a href=""><img src="static/mutui/demo/img/contacts/5.jpg" alt=""></a>
                                    <span>Replied by Xena Williams 6 days ago</span>
                                </div>

                                <div class="q-a__vote-answer hidden-sm-down">

                                    <div class="listview__attrs">

                                                <span title="" data-toggle="tooltip"
                                                      data-placement="top" data-original-title="该用户是本文章的作者">
                                                   作者
                                                </span>

                                        <span title="" data-toggle="tooltip"
                                              data-placement="top" data-original-title="该用户是平台邀请来的大咖.">
                                                   专家
                                                </span>

                                        <div class="icon-toggle">
                                            <i class="zmdi zmdi-mood zmdi-hc-fw"></i>
                                        </div>

                                        <div class="dropdown actions__item">
                                            <i class="zmdi zmdi-more" data-toggle="dropdown"></i>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="">回复</a>
                                                <a class="dropdown-item" href="">分享</a>
                                                <a class="dropdown-item" href="">删除</a>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <!--非大咖去掉badge-success-ext 这个样式-->
                        <div class="user badge-success-ext">
                            <div class="user__info">
                                <img class="user__img" src="static/mutui/demo/img/profile-pics/8.jpg" alt="">
                                <div>
                                    <div>赵桥棉（大咖）</div>
                                    <div>等级:<code>T1</code></div>
                                    <div>544976880@qq.com</div>
                                </div>
                            </div>

                        </div>
                        <p class="card-text">目前就职于facebook 负责facebook 主要业务</p>

                        <div class="tags flot-chart-legends" >
                            <a href="" data-toggle="tooltip" data-placement="top" data-original-title="级别:小白">
                                <div class="legendColorBox" style="display: inline-block">
                                    <div style="border:1px solid #fff;padding:1px">
                                        <div style="width:4px;height:0;border:5px solid #f5c942;overflow:hidden">

                                        </div>
                                    </div>
                                </div>
                                Java
                            </a>
                            <a href="" data-toggle="tooltip" data-placement="top" data-original-title="级别:中级">
                                <div class="legendColorBox" style="display: inline-block">
                                    <div style="border:1px solid #fff;padding:1px">
                                        <div style="width:4px;height:0;border:5px solid #3af51b;overflow:hidden">

                                        </div>
                                    </div>
                                </div>
                                Mysql
                            </a>
                            <a href="" data-toggle="tooltip" data-placement="top" data-original-title="级别:高级">
                                <div class="legendColorBox" style="display: inline-block">
                                    <div style="border:1px solid #fff;padding:1px">
                                        <div style="width:4px;height:0;border:5px solid #f51914;overflow:hidden">

                                        </div>
                                    </div>
                                </div>
                                Redis
                            </a>
                            <a href="" data-toggle="tooltip" data-placement="top" data-original-title="级别:小白">
                                <div class="legendColorBox" style="display: inline-block">
                                    <div style="border:1px solid #fff;padding:1px">
                                        <div style="width:4px;height:0;border:5px solid #f5c942;overflow:hidden">

                                        </div>
                                    </div>
                                </div>
                                RabbitMq
                            </a>
                            <a href="" data-toggle="tooltip" data-placement="top" data-original-title="级别:小白">
                                <div class="legendColorBox" style="display: inline-block">
                                    <div style="border:1px solid #fff;padding:1px">
                                        <div style="width:4px;height:0;border:5px solid #f5c942;overflow:hidden">

                                        </div>
                                    </div>
                                </div>
                                Oracle
                            </a>
                            <a href="" data-toggle="tooltip" data-placement="top" data-original-title="级别:高级">
                                <div class="legendColorBox" style="display: inline-block">
                                    <div style="border:1px solid #fff;padding:1px">
                                        <div style="width:4px;height:0;border:5px solid #f51914;overflow:hidden">

                                        </div>
                                    </div>
                                </div>
                                Docker
                            </a>

                        </div>

                        <div class="team__social text-center">
                            <a href="" class="zmdi zmdi-github bg-indigo"></a>
                            <a href="" class="zmdi zmdi-stackoverflow bg-cyan"></a>
                            <a href="" class="zmdi zmdi-home bg-red"></a>
                            <a href="" class="zmdi zmdi-github bg-indigo"></a>
                            <a href="" class="zmdi zmdi-stackoverflow bg-cyan"></a>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
