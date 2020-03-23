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
             title="<?=$value['nickname']?> <?php if ($value['self_signature']):?><?=':'.$value['self_signature']?><?endif;?>"  data-toggle="tooltip" data-placement="top" >
        <div class="listview__content text-truncate">
            <a class="listview__heading" href="<?=Url::to(['question/detail','question_id'=>$value['id']])?>">
                <?=$value['title']?>
            </a>
            <?php if ($value['last_reply_nickname']):?>
             <p>#<?=$value['last_reply_nickname']?> 回复于<?=Yii::$app->formatter->asRelativeTime($value['last_reply_at']);?></p>
            <?endif;?>
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