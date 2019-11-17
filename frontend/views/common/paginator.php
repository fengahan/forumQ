<?php use yii\widgets\LinkPager;?>
<div class="row">
    <div class="col-lg-8 col-md-7">
        <nav>
            <?php
            echo LinkPager::widget([
                'pagination' => $pagination,
                'prevPageLabel' => '上一页',
                'nextPageLabel' => '下一页',
                'firstPageLabel' => '首页',
                'lastPageLabel' => '尾页',
                'maxButtonCount' => 5,
                'options' => [
                    'class' => 'pagination justify-content-center'
                ],
                'prevPageCssClass' => 'page-item pagination-prev',
                'pageCssClass' => "page-item",
                'nextPageCssClass' => 'page-item pagination-next',
                'firstPageCssClass' => 'page-item pagination-first',
                'lastPageCssClass' => 'page-item pagination-last',
                'linkOptions' => [
                    'class' => 'page-link'
                ],
                'disabledListItemSubTagOptions' => [
                    'tag' => 'a',
                    'class' => 'page-link'
                ],
            ])?>
        </nav>

    </div>
</div>
<!--分页-->
<!--<div class="row">-->
<!--    <div class="col-lg-8 col-md-7">-->
<!--        <nav>-->
<!--            <ul class="pagination justify-content-center">-->
<!--                <li class="page-item pagination-first"><a class="page-link" href="#"></a></li>-->
<!--                <li class="page-item pagination-prev"><a class="page-link" href="#"></a></li>-->
<!--                <li class="page-item active"><a class="page-link" href="#">1</a></li>-->
<!--                <li class="page-item"><a class="page-link" href="#">2</a></li>-->
<!--                <li class="page-item"><a class="page-link" href="#">3</a></li>-->
<!--                <li class="page-item"><a class="page-link" href="#">4</a></li>-->
<!--                <li class="page-item"><a class="page-link" href="#">5</a></li>-->
<!--                <li class="page-item"><a class="page-link" href="#">6</a></li>-->
<!--                <li class="page-item pagination-next"><a class="page-link" href="#"></a></li>-->
<!--                <li class="page-item pagination-last"><a class="page-link" href="#"></a></li>-->
<!--            </ul>-->
<!--        </nav>-->
<!--    </div>-->
<!--</div>-->