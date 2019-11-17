<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="content__inner">
    <div class="row">
        <div class="col-lg-8 col-md-7">
            <div class="card issue-tracker">
                <div class="toolbar toolbar--inner">
                    <div class="toolbar__nav">
                        <a class="active" href="">未解决 20</a>
                        <a href="" class="hidden-sm-down">已解决 30</a>
                        <a href="">无人问津 40</a>
                    </div>
                    <div class="actions">
                        <i class="actions__item zmdi zmdi-search" data-ma-action="toolbar-search-open" data-toggle="tooltip" data-title="内容搜索" data-original-title="" title=""></i>
                        <div class="dropdown actions__item hidden-sm-down" data-toggle="tooltip" data-title="标签" data-original-title="" title="">
                            <i class="zmdi zmdi-label-alt-outline" data-toggle="dropdown"></i>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu--active dropdown-menu--sort">
                                <a href="" class="dropdown-item">全部</a>
                                <!--选择样式 bg-green text-white!-->
                                <a href="" class="dropdown-item bg-green text-white">Linux</a>
                                <a href="" class="dropdown-item">PHP</a>
                                <a href="" class="dropdown-item">Java</a>
                                <a href="" class="dropdown-item">MySql</a>
                                <a href="" class="dropdown-item">其他</a>
                            </div>
                        </div>
                        <div class="dropdown actions__item hidden-sm-down" data-toggle="tooltip" data-title="筛选" data-original-title="" title="">
                            <i class="zmdi zmdi-book" data-toggle="dropdown"></i>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu--active dropdown-menu--sort">
                                <a href="" class="dropdown-item">付费</a>
                                <!--选择样式 bg-green text-white!-->
                                <a href="" class="dropdown-item bg-green text-white">非付费</a>
                            </div>
                        </div>
                        <div class="dropdown actions__item hidden-sm-down" data-toggle="tooltip" data-title="Sort by" data-original-title="" title="">
                            <i class="zmdi zmdi-sort" data-toggle="dropdown"></i>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu--active dropdown-menu--sort">
                                <a href="" class="dropdown-item">最新发布</a>
                                <!--选择样式 bg-green text-white!-->
                                <a href="" class="dropdown-item bg-green text-white">最新回复</a>
                            </div>
                        </div>
                    </div>
                    <div class="toolbar__search">
                        <input type="text" placeholder="看!这里有你想要的...">
                        <i class="toolbar__search__close zmdi zmdi-long-arrow-left" data-ma-action="toolbar-search-close"></i>
                    </div>
                </div>
                <div class="listview listview--bordered">
                    <div class="listview__item">
                        <img src="static/mutui/demo/img/contacts/2.jpg" class="listview__img" alt=""
                             title="Vivamus sagittis lacus vel augue laoreet rutrum faucibus."  data-toggle="tooltip" data-placement="left" >

                        <div class="listview__content text-truncate text-truncate">
                            <a class="listview__heading" href="">
                                如何激活永久windows10 和office办公软件
                            </a>
                            <p>#张三 回复于 4小时前</p>
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
                            <i class="zmdi zmdi-eye"></i>5
                        </div>
                    </div>
                    <div class="listview__item">
                        <img src="static/mutui/demo/img/contacts/3.jpg" class="listview__img" alt=""
                             title="Vivamus sagittis lacus vel augue laoreet rutrum faucibus."  data-toggle="tooltip" data-placement="left" >
                        <div class="listview__content text-truncate">
                            <a class="listview__heading" href="">
                                如何激活永久windows10 和office办公软件
                            </a>
                            <p>#李四 回复于 2小时前</p>
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
                            <i class="zmdi zmdi-eye"></i>5
                        </div>
                    </div>
                    <div class="listview__item">
                        <i class="avatar-char bg-amber">K</i>
                        <div class="listview__content text-truncate">
                            <a class="listview__heading" href="">
                                如何激活永久windows10 和office办公
                            </a>
                            <p>#王五 回复于 1 小时前</p>
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
                            <i class="zmdi zmdi-eye"></i>5
                        </div>
                    </div>

                    <div class="listview__item">
                        <i class="avatar-char bg-light-blue">T</i>

                        <div class="listview__content text-truncate">
                            <a class="listview__heading" href="">
                                如何激活永久windows10 和office办公
                            </a>
                            <p>#王五 回复于 1 小时前</p>
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
                            <i class="zmdi zmdi-eye"></i>5
                        </div>


                    </div>

                    <div class="listview__item">
                        <img src="static/mutui/demo/img/contacts/1.jpg" class="listview__img" alt="">

                        <div class="listview__content text-truncate">
                            <a class="listview__heading" href="">
                                如何激活永久windows10 和office办公软件
                            </a>
                            <p>#张三 回复于 4小时前</p>
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
                            <i class="zmdi zmdi-eye"></i>5
                        </div>

                    </div>

                    <div class="listview__item">
                        <i class="avatar-char bg-light-green">J</i>

                        <div class="listview__content text-truncate">
                            <a class="listview__heading" href="">
                                如何激活永久windows10 和office办公软件
                            </a>
                            <p>#张三 回复于 4小时前</p>
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
                            <i class="zmdi zmdi-eye"></i>5
                        </div>

                    </div>

                    <div class="listview__item">
                        <img src="static/mutui/demo/img/contacts/5.jpg" class="listview__img" alt="">

                        <div class="listview__content text-truncate">
                            <a class="listview__heading" href="">
                                如何激活永久windows10 和office办公
                            </a>
                            <p>#张三 回复于 4小时前</p>
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
                            <i class="zmdi zmdi-eye"></i>5
                        </div>

                    </div>

                    <div class="listview__item">
                        <img src="static/mutui/demo/img/contacts/6.jpg" class="listview__img" alt="">

                        <div class="listview__content text-truncate">
                            <a class="listview__heading" href="">
                                如何激活永久windows10 和office办公
                            </a>
                            <p>#张三 回复于 4小时前</p>
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
                            <i class="zmdi zmdi-eye"></i>5
                        </div>

                    </div>

                    <div class="listview__item">
                        <img src="static/mutui/demo/img/contacts/7.jpg" class="listview__img" alt="">

                        <div class="listview__content text-truncate">
                            <a class="listview__heading" href="">
                                如何激活永久windows10 和office办公
                            </a>
                            <p>#张三 回复于 4小时前</p>
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
                            <i class="zmdi zmdi-eye"></i>5
                        </div>

                    </div>

                    <div class="listview__item">
                        <i class="avatar-char bg-pink">L</i>

                        <div class="listview__content text-truncate">
                            <a class="listview__heading" href="">
                                如何激活永久windows10 和office办公
                            </a>
                            <p>#张三 回复于 4小时前</p>
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
                            <i class="zmdi zmdi-eye"></i>5
                        </div>

                    </div>

                    <div class="clearfix m-4"></div>
                </div>
            </div>
        </div>
<!--        最新解决问答-->
        <div class="col-lg-4 col-md-5 hidden-md-down">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">最新解决问答</h4>
                </div>

                <div class="listview listview--hover">
                    <a class="listview__item">

                        <img src="static/mutui/demo/img/profile-pics/1.jpg" class="listview__img" title="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." data-toggle="tooltip" data-placement="left" alt="">

                        <div class="listview__content">
                            <div class="listview__heading text-truncate">Lorem ipsum dolor sit amet, consectetur adipiscing</div>
                            <p>by Jane Neimor on 1st July 2017</p>
                        </div>
                    </a>

                    <a class="listview__item">
                        <img src="static/mutui/demo/img/profile-pics/2.jpg" class="listview__img" alt="">

                        <div class="listview__content">
                            <div class="listview__heading text-truncate">Nam quis dolor dapibus, viverra leo eu, egestas nisi</div>
                            <p>by Nate Davis on 5th July 2017</p>
                        </div>
                    </a>

                    <a class="listview__item">
                        <img src="static/mutui/demo/img/profile-pics/3.jpg" class="listview__img" alt="">

                        <div class="listview__content">
                            <div class="listview__heading text-truncate">Fusce ullamcorper urna et sodales imperdiet</div>
                            <p>by Malinda Hollaway on 10th July 2017</p>
                        </div>
                    </a>

                    <a class="listview__item">
                        <img src="static/mutui/demo/img/profile-pics/4.jpg" class="listview__img" alt="">

                        <div class="listview__content">
                            <div class="listview__heading text-truncate">Cras pellentesque orci in libero scelerisque commodo</div>
                            <p>by Dave Rubin on 15th July 2017</p>
                        </div>
                    </a>
                    <a class="listview__item">
                        <img src="static/mutui/demo/img/profile-pics/5.jpg" class="listview__img" alt="">
                        <div class="listview__content">
                            <div class="listview__heading text-truncate">Sed suscipit sem non lectus imperdiet ornare</div>
                            <p>by Sam Andersion on 17th July 2017
                            </p>
                        </div>
                    </a>
                    <div class="m-4"></div>
                </div>
            </div>
        </div>
    </div>
    <!--    页码-->
    <?php echo $this->render('@app/views/common/paginator.php',['pagination'=>$pagination]);?>
</div>
