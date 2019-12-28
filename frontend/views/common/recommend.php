<!--  推荐最新解决问答-->
<div class="listview listview--hover">
    <?php foreach ($new_solve_list as $key=>$value):?>
    <a class="listview__item">
        <img src="<?=$value['avatar']?>" class="listview__img" alt="">
        <div class="listview__content">
            <div class="listview__heading text-truncate"><?=$value['title']?></div>
            <p><?=$value['nickname']?> 发布于<?=Yii::$app->formatter->asRelativeTime($value['created_at'])?>
            </p>
        </div>
    </a>
    <?php endforeach;?>
    <div class="m-4"></div>
</div>