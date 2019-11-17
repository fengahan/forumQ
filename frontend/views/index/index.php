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
                <!-- 文章列表-->
                <?php echo $this->render('@app/views/common/article.php');?>
            </div>
        </div>
        <!--  推荐最新解决问答-->
        <div class="col-lg-4 col-md-5 hidden-md-down">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">最新解决问答</h4>
                </div>
                <?php echo $this->render('@app/views/common/recommend.php');?>
            </div>
        </div>
    </div>
    <!-- 页码-->
    <?php echo $this->render('@app/views/common/paginator.php',['pagination'=>$pagination]);?>
</div>
