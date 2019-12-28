<?php
use common\models\CommunityQuestion;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $tag_list array*/
/* @var $main_count array*/
/* @var $question_list array */
/* @var $pagination */
$this->title = 'My Yii Application';
?>
<div class="content__inner">
    <div class="row">
        <div class="col-lg-8 col-md-7">
            <div class="card issue-tracker">
                <div class="toolbar toolbar--inner">
                    <div class="toolbar__nav">
                        <a  href="<?=Url::to(['/index/index','solve'=>CommunityQuestion::SOLVE_NOT])?>" class="<?php if ($req['solve']==CommunityQuestion::SOLVE_NOT):?>active<?php endif;?>">未解决 <?=$main_count['solve_not_count'];?></a>

                        <a href="<?=Url::to(['/index/index','solve'=>CommunityQuestion::SOLVE_YES])?>" class="<?php if ($req['solve']==CommunityQuestion::SOLVE_YES):?>active<?php endif;?>">已解决 <?=$main_count['solve_yes_count'];?></a>
                    </div>
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
                        <div class="dropdown actions__item hidden-sm-down" data-toggle="tooltip" data-title="筛选" data-original-title="" title="">
                            <i class="zmdi zmdi-book" data-toggle="dropdown"></i>
                            <div  id="check_public" class="dropdown-menu dropdown-menu-right dropdown-menu--active dropdown-menu--sort">
                                <a href="#" onclick="public_click_func(0)"  class="dropdown-item <?php if ($req['is_public']==0):?>bg-green text-white<?php endif;?>">全部</a>
                                <a href="#" onclick="public_click_func(<?=CommunityQuestion::PUBLIC_YES?>)"  class="dropdown-item <?php if ($req['is_public']==CommunityQuestion::PUBLIC_YES):?>bg-green text-white<?php endif;?>">公开答案</a>
                                <!--选择样式 bg-green text-white!-->
                                <a href="#" onclick="public_click_func(<?=CommunityQuestion::PUBLIC_NOT?>)"  class="dropdown-item <?php if ($req['is_public']==CommunityQuestion::PUBLIC_NOT):?>bg-green text-white<?php endif;?>">不公开答案</a>
                            </div>
                        </div>
                        <div class="dropdown actions__item hidden-sm-down" data-toggle="tooltip" data-title="排序" data-original-title="" title="">
                            <i class="zmdi zmdi-sort" data-toggle="dropdown"></i>
                            <div id="check_sort" class="dropdown-menu dropdown-menu-right dropdown-menu--active dropdown-menu--sort">
                                <a href="#" onclick="sort_click_func(0)" class="dropdown-item <?php if ($req['sort']=="created_at"):?>bg-green text-white<?php endif;?>">最新发布</a>
                                <!--选择样式 bg-green text-white!-->
                                <a href="#" onclick="sort_click_func(1)" class="dropdown-item <?php if ($req['sort']!="created_at"):?>bg-green text-white<?php endif;?>">最新回复</a>
                            </div>
                        </div>
                    </div>
                    <div class="toolbar__search"  onkeydown="onkey()">
                            <input type="text" id="search_word" placeholder="看!这里有你想要的...">
                        <i class="toolbar__search__close zmdi zmdi-long-arrow-left" data-ma-action="toolbar-search-close"></i>
                    </div>
                </div>
                <!-- 文章列表-->
                <?=$this->render('@app/views/common/question.php',['question_list'=>$question_list]);?>
            </div>
        </div>
        <!--  推荐最新解决问答-->
        <div class="col-lg-4 col-md-5 hidden-md-down">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">最新解决问答</h4>
                </div>
                <?=$this->render('@app/views/common/recommend.php');?>
            </div>
        </div>
    </div>
    <!-- 页码-->
    <?php echo $this->render('@app/views/common/paginator.php',['pagination'=>$pagination]);?>
</div>

<script type="text/javascript">
    /**when click sort element
     */
    var search = window.location.search;
    var SearchParam=getSearchParams(search)
    var sortEle = document.getElementById("check_sort").getElementsByTagName("a");
    var sort_click_func=function (i) {
        if (i===0){
            sort_filed="created_at"
        }else {
            sort_filed="last_reply_at"
        }
        SearchParam['sort']=sort_filed
         window.location.href=createURL(SearchParam)
    }
    var publicEle = document.getElementById("check_public").getElementsByTagName("a");
    var public_click_func=function (i) {
        SearchParam['is_public']=i
        window.location.href=createURL(SearchParam)
    }
    var tagEle = document.getElementById("check_tag").getElementsByTagName("a");
    var tag_click_func=function (i) {
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
    function notify(from, align, icon, type, animIn, animOut){
        $.notify({
            icon: icon,
            title: '错误提示',
            message: '请输入您想找的文章',
            url: ''
        },{
            element: 'body',
            type: type,
            allow_dismiss: true,
            offset: {
                x: 15, // Keep this as default
                y: 15  // Unless there'll be alignment issues as this value is targeted in CSS
            },
            spacing: 10,
            z_index: 1031,
            delay: 2500,
            timer: 1000,
            url_target: '_blank',
            mouse_over: false,
            animate: {
                enter: animIn,
                exit: animOut
            },
            template:   '<div data-notify="container" class="alert alert-dismissible alert-{0} alert--notify" role="alert">' +
                '<span data-notify="icon"></span> ' +
                '<span data-notify="title">{1}</span> ' +
                '<span data-notify="message">{2}</span>' +
                '<div class="progress" data-notify="progressbar">' +
                '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                '</div>' +
                '<a href="{3}" target="{4}" data-notify="url"></a>' +
                '<button type="button" aria-hidden="true" data-notify="dismiss" class="alert--notify__close">关闭</button>' +
                '</div>'
        });
    }

    //回车监听
    function onkey()
    {
        var search_word;
        if (window.event.keyCode === 13) {
            search_word= document.getElementById("search_word").value;
            if (search_word===""){
                notify("","","","warning","", "");
                return false
            }
            window.location.href = "<?=Url::to(['index/index'])?>"+"?search_word="+search_word
            return false;
        }
    }

</script>
