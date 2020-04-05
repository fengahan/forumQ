<?php
use common\models\CommunityQuestion;
use yii\helpers\Url;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $tag_list array*/
/* @var $main_count array*/
/* @var $question_list array */
/* @var $pagination */
$this->title = '技术分享首页'.'-'.Yii::$app->name;
?>
<div class="content__inner">
    <div class="row">
        <div class="col-lg-8 col-md-7">
            <div class="card issue-tracker">
                <div class="toolbar toolbar--inner">
                    <div class="actions">
                        <i class="actions__item zmdi zmdi-search" data-ma-action="toolbar-search-open" data-toggle="tooltip" data-title="内容搜索" data-original-title="" title=""></i>
                        <div class="dropdown actions__item hidden-sm-down" data-toggle="tooltip" data-title="标签" data-original-title="" title="">
                            <i class="zmdi zmdi-label-alt-outline" data-toggle="dropdown"></i>
                            <div  id="check_tag" class="dropdown-menu dropdown-menu-right dropdown-menu--active dropdown-menu--sort">
                                <a href="#" onclick="tag_click_func(0)"  class="dropdown-item <?php if ($req['tag_id']==0):?>bg-green text-white<?php endif;?>>">全部</a>
                                <!--选择样式 bg-green text-white!-->
                                <?php foreach ($tag_list as $key=>$val):?>
                                    <a href="#" onclick="tag_click_func(<?=$val['id']?>)" class="dropdown-item <?php if ($req['tag_id']==$val['id']):?>bg-green text-white<?php endif;?>"><?=$val['title']?></a>
                                <?php endforeach;?>
                            </div>
                        </div>

                    </div>
                    <div class="toolbar__search"  onkeydown="onkey()">
                        <input type="text" id="search_word" placeholder="看!这里有你想要的...">
                        <i class="toolbar__search__close zmdi zmdi-long-arrow-left" data-ma-action="toolbar-search-close"></i>
                    </div>
                </div>
                <!-- 文章列表-->

                <div class="listview listview--bordered
            <?php
                if (isset($listClass)){
                    echo $listClass;
                } ?>">
                    <?php foreach ($article_list as $key=>$value):?>
                        <div class="listview__item">
                            <img src="<?=$value['avatar']?>" class="listview__img" alt=""
                                 title="<?=$value['nickname']?> <?php if ($value['self_signature']):?><?=':'.$value['self_signature']?><?endif;?>"  data-toggle="tooltip" data-placement="top" >
                            <div class="listview__content text-truncate">
                                <a class="listview__heading" href="<?=Url::to(['article/detail','article_id'=>$value['id']])?>">
                                    <?=$value['title']?>
                                </a>
                            </div>
                            <div class="issue-tracker__item hidden-md-down" >
                                <i class="zmdi zmdi-time" ></i>
                                <?=Yii::$app->formatter->asRelativeTime($value['created_at']);?>
                            </div>
                            <div class="issue-tracker__item hidden-md-down">
                                <i class="zmdi zmdi-favorite"></i>
                                <?=$value['get_heart']?>
                            </div>

                            <div class="issue-tracker__item hidden-md-down">
                                <i class="zmdi zmdi-eye"></i>
                                <?=$value['view_number']?>
                            </div>
                        </div>
                    <?php endforeach;?>
                    <div class="clearfix m-4"></div>
                </div>
            </div>
        </div>
        <!--  推荐最新解决问答-->
        <div class="col-lg-4 col-md-5 hidden-md-down">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">最热门分享</h4>
                </div>

                <!--  推荐最新解决问答-->
                <div class="listview listview--hover">
                    <?php foreach ($hot_list as $key=> $value):?>
                        <a class="listview__item" href="<?=Url::to(['article/detail','article_id'=>$value['id']])?>">
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

            </div>
        </div>
    </div>
    <!-- 页码-->
    <?=$this->render('@app/views/common/paginator.php',['pagination'=>$pagination]);?>
</div>

<script type="text/javascript">
    /**when click sort element
     */
    var search = window.location.search;
    var SearchParam=getSearchParams(search)


    var tagEle = document.getElementById("check_tag").getElementsByTagName("a");
    function tag_click_func(i) {
        SearchParam['tag_id']=i
        window.location.href=createURL(SearchParam)
    }

    function createURL(param) {
        let Url;
        let queryStr = '';
        for (let key in param) {
            let link = '&' + key + "=" + param[key];
            queryStr += link;
        }
        Url = window.location.protocol+"//"+window.location.host +window.location.pathname+ "?" + queryStr.substr(1);
        return Url;
    }

    function getSearchParams(Url) {
        var str = Url;
        var obj = {};
        str = str.substring(1, str.length);
        var arr = str.split("&");
        // 将每一个数组元素以=分隔并赋给obj对象
        for (var i = 0; i < arr.length; i++) {

            var tmp_arr = arr[i].split("=");
            if (tmp_arr[0]!==""){
                obj[decodeURIComponent(tmp_arr[0])] = decodeURIComponent(tmp_arr[1]);
            }
        }
        return obj;
    }

    //回车监听
    function onkey()
    {
        var search_word;
        if (window.event.keyCode === 13) {
            search_word= document.getElementById("search_word").value;
            if (search_word===""){
                notify("","","","danger","", "","请输入您想要搜索的相关内容");
                return false
            }
            window.location.href = "<?=Url::to(['article/index'])?>"+"?search_word="+search_word
            return false;
        }
    }

</script>
