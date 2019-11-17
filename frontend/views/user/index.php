<?php
/**
 * User: ZRothschild
 * Data: 2019/11/17
 * Time: 15:53
 */
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="content__inner">
    <div class="row">
        <div class="col-lg-3 col-md-3">
            <!-- 用户基本信息挂件 -->
            <?php echo $this->render('@app/views/common/user.php');?>
        </div>
        <div class="col-lg-9 col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="tab-container">
                        <!-- table 切换-->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link show active" data-toggle="tab" href="#home" role="tab" aria-selected="false">基本信息</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link show" data-toggle="tab" href="#answer" role="tab" aria-selected="false">最佳回答</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link show" data-toggle="tab" href="#technology" role="tab" aria-selected="false">技术分享</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link show" data-toggle="tab" href="#subject" role="tab" aria-selected="true">专题分享</a>
                            </li>
                        </ul>
                        <!-- 与table切换对应关系-->
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="home" role="tabpanel">
                                <!--成长历史录-->
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">成长历史录</h4>
                                        <h6 class="card-subtitle">张三成为本站会员已过去258天.</h6>
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
                                        </div>

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
                                <!-- 回答问题文章-->
                                <?php echo $this->render('@app/views/common/article.php',['listClass'=> 'issue-tracker']);?>
                                <!-- 回答问题分页-->
                                <?php echo $this->render('@app/views/common/paginator.php',['pagination'=>$pagination]);?>
                            </div>
                            <div class="tab-pane fade" id="technology" role="tabpanel">
                                <!-- 技术分享文章-->
                                <?php echo $this->render('@app/views/common/article.php',['listClass'=> 'issue-tracker']);?>
                                <!-- 技术分享分页-->
                                <?php echo $this->render('@app/views/common/paginator.php',['pagination'=>$pagination]);?>
                            </div>
                            <div class="tab-pane fade" id="subject" role="tabpanel"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
