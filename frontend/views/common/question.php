<!-- 文章列表-->
<?php
use yii\helpers\Url;
/**
 * @var $question_list array
 */
?>
<div class="listview listview--bordered
<?php
if (isset($listClass)){
    echo $listClass;
} ?>">
    <?php foreach ($question_list as $key=>$value):?>
    <div class="listview__item">
        <img src="<?=$value['avatar']?>" class="listview__img" alt=""
             title="<?=$value['self_signature']?>"  data-toggle="tooltip" data-placement="left" >
        <div class="listview__content text-truncate">
            <a class="listview__heading" href="<?=Url::to(['question/detail','question_id'=>$value['id']])?>">
                <?=$value['title']?>
            </a>
            <p>#<?=$value['last_reply_nickname']?> 回复于<?=Yii::$app->formatter->asRelativeTime($value['last_reply_at']);?></p>
        </div>
        <div class="issue-tracker__item hidden-md-down" >
            <i class="zmdi zmdi-time" ></i>
            <?=Yii::$app->formatter->asRelativeTime($value['created_at']);?>
        </div>
        <div class="issue-tracker__item hidden-md-down">
            <i class="zmdi zmdi-comments"></i>
            <?=$value['reply_number']?>
        </div>
        <div class="issue-tracker__item hidden-md-down">
            <i class="zmdi zmdi-money-box"></i>
            <?=$value['money']?>
        </div>
        <div class="issue-tracker__item hidden-md-down">
            <i class="zmdi zmdi-eye"></i>
            <?=$value['view_number']?>
        </div>
    </div>
    <?php endforeach;?>
    <div class="clearfix m-4"></div>
</div>