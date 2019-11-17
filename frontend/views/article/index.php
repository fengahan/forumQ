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
        <div class="col-lg-9 col-md-9">
            <!-- 被评论内容 -->
            <div class="q-a__question">
                <div class="q-a__vote hidden-sm-down">
                    <div class="q-a__vote__votes">
                        <i>356</i>
                    </div>
                    <div class="icon-toggle">
                        <i class="zmdi zmdi-help"  data-toggle="tooltip" data-title="有答案通知我" ></i>
                    </div>
                </div>
                <h2> windows10 如何关闭自动更新和自带带杀毒软件</h2>
                <p>Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Maecenas sed diam eget risus varius blandit sit amet non magna. Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida at eget metus. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Donec id elit non mi porta gravida at eget metus.</p>
<!--                <div class="q-a__info">-->
<!--                    <div class="q-a__op">-->
<!--                        <a href=""><img src="mutui/demo/img/contacts/1.jpg" alt=""></a>-->
<!--                        <span>张三提问于6小时以前</span>-->
<!--                    </div>-->
<!--                </div>-->
            </div>
            <!-- 用户评论统计与区分 -->
            <div class="card">
                <div class="toolbar toolbar--inner">
                    <div class="toolbar__label">总计
                        <span class="issue-tracker__tag bg-green">10</span>
                        条回复
                    </div>
                    <nav class="toolbar__nav ml-auto hidden-sm-down">
                        <a href="" class="active">新发布</a>
                        <a href="">新活跃</a>
                        <a href="">之前的</a>
                    </nav>
                </div>
                <!-- 用户评论 -->
                <?php echo $this->render('@app/views/common/comment.php');?>
            </div>
        </div>
        <div class="col-lg-3 col-md-3">
            <!-- 用户基本信息挂件 -->
            <?php echo $this->render('@app/views/common/user.php');?>
        </div>
    </div>
</div>
