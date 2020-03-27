<?php
namespace frontend\controllers;

use common\models\ArticleReplyPraise;
use common\models\Articles;
use common\models\ArticlesPraise;
use common\models\ArticlesReply;
use common\models\BaseModel;
use common\models\CommunityGradeLog;
use common\models\CommunityQuestion;
use common\models\CommunityTag;
use common\models\CommunityTechnicalLog;
use common\models\CommunityUserLink;
use common\models\CommunityUsers;
use common\models\CommunityUserTag;
use common\models\UploadImgForm;
use common\models\UserMessage;
use Yii;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;


/**
 * Site controller
 */
class ArticleController extends BaseController
{




    public function actionIndex()
    {

        $req=Yii::$app->request->get();
        $req['tag_id']=isset($req['tag_id'])?(int)$req['tag_id']:0;
        $req['sort']=isset($req['sort'])?$req['sort']:"created_at";//'new_created'
        $req['search_word']=isset($req['search_word'])?$req['search_word']:"";
        $list_where['tag_id']=$req['tag_id'];
        $list_where['is_public']=$req['is_public'];
        $list_where["search_word"]=$req['search_word'];
        $sort=$req['sort'];
        $tagModel=new CommunityTag();
        $tagWhere=['status'=>CommunityTag::STATUS_NORMAL,'type'=>CommunityTag::TYPE_SKILLS];
        $tag_list=$tagModel->getList($tagWhere);
        $ArticleModel=new Articles();
        $article_list=[];
        $article_count=$ArticleModel->getIndexCount($list_where);
        $pagination = new Pagination(['totalCount' =>$article_count, 'pageSize' => BaseModel::PAGE_SIZE]);
        if ($article_count>0){
            $article_list=$ArticleModel->getIndexList($list_where,$pagination);
        }

        $hot_list=$ArticleModel->getHot();
        $main_count=[];
        return $this->render('index',[
            'article_list'=>$article_list,
            'tag_list'=>$tag_list,
            'pagination' => $pagination,
            'main_count'=>$main_count,
            'hot_list'=>$hot_list,
            'req'=>$req,
        ]);


    }


    public function actionCreate()
    {
        $req=Yii::$app->request->post();
        $model = new UploadImgForm();

        $Article=new Articles();
        $Article->user_id=Yii::$app->user->identity->getId();
        if ( $Article->load($req,"") && $Article->save()){
            ///user/center?tab=question
            return $this->redirect(Url::to(['/user/center','tab'=>'technology']));
        }else{

            $Tag=new CommunityTag();
            $tagWhere=['status'=>CommunityTag::STATUS_NORMAL,'type'=>CommunityTag::TYPE_SKILLS];
            $tag_list=$Tag->getList($tagWhere);
            return  $this->render('create_article',
                [
                    'model' => $model,
                    'article_model'=>$Article,
                    'tag_list'=>$tag_list,
                ]
            );
        }
    }


    /**
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate()
    {
        $req=Yii::$app->request->post();
        $article_id=(int) $req['id']??'0';
        if (empty($article_id)){
            $article_id=(int)Yii::$app->request->get("id");
        }


        $Article=Articles::findOne($article_id);
        if (empty($Article) || $Article->user_id!=Yii::$app->user->identity->getId() || $Article->status==Articles::STATUS_DELETE)
        {
            throw new NotFoundHttpException("文章不存在了");
        }
        if ( $Article->load($req,"") && $Article->save()){
            ///user/center?tab=question
            return $this->redirect(Url::to(['/user/center','tab'=>'technology']));
        }else{

            $Tag=new CommunityTag();
            $tagWhere=['status'=>CommunityTag::STATUS_NORMAL,'type'=>CommunityTag::TYPE_SKILLS];
            $tag_list=$Tag->getList($tagWhere);
            return  $this->render('update_article',
                [
                    'Article'=>$Article,
                    'tag_list'=>$tag_list,
                ]
            );
        }

    }

    public function actionDetail()
    {
        $req=Yii::$app->request->get();
        $article_id=(int)$req['article_id'];
        if (empty($article_id)){
            throw new NotFoundHttpException("未找到当前文章");
        }
        $ArtModel=new Articles();
        $article=$ArtModel->getArtContent($article_id);
        if (empty($article) || $article['status']!=Articles::STATUS_NORMAL){
            throw new NotFoundHttpException("未找到当前文章");
        }
        $is_heart=0;
        if (!Yii::$app->user->isGuest){
            $_heart= ArticlesPraise::findOne(['article_id'=>$article_id,'user_id'=>Yii::$app->user->identity->getId()]);
            if (!empty($_heart)){
                $is_heart=1;
            }
        }
        $ArtUpModel=Articles::findOne($article_id);
        $ArtUpModel->updateCounters(['view_number'=>1]);
        $ArtUpModel->save();

        $ArticleReply=new ArticlesReply();
        $reply_list=$ArticleReply->getReplyList($article_id);

        $userModel=new CommunityUsers();
        $article_user_info=$userModel->getUserInfo($article['user_id']);
        $userTag =new CommunityUserTag();
        $article_user_tag=$userTag->getUserTag($article['user_id']);
        $userLinkModel=new CommunityUserLink();
        $user_link=$userLinkModel->getUserLink(['user_id'=>$article['user_id'],"status"=>[CommunityUserLink::STATUS_NORMAL]]);
        return $this->render("detail",[
            'reply_list'=>$reply_list,
            'is_heart'=>$is_heart,
            'article'=>$article,
            'article_user_info'=>$article_user_info,
            'article_user_tag'=>$article_user_tag,
            'user_link'=>$user_link
        ]);



    }



    public function actionAction()
    {

        $req=Yii::$app->request->post();
        $id=$req['id']?(int)$req['id']:0;
        $status=$req['status']?(int)$req['status']:0;
        if (empty($id) || empty($status)){
            return $this->formatJson(200,"操作有误",[]);
        }

        $ArticleModel=Articles::findOne($id);

        if (  $ArticleModel->user_id!=Yii::$app->user->identity->getId() ||  $ArticleModel->status==Articles::STATUS_DELETE){
            return $this->formatJson(200,"操作有误",[]);
        }
        if ( $ArticleModel->status==$status){
            return $this->formatJson(200,"无法重复此操作",[]);
        }
        $ArticleModel->status=$status;
        if (! $ArticleModel->save()){
            return $this->formatJson(200, $ArticleModel->getErrorSummary(false)[0],[]);
        }else{
            return $this->formatJson(100,'更新成功',[]);
        }


    }

    /**
     *限制单个用户针对当前文章每日点击次数为6次
     */

    public function actionHeart()
    {
        $req=Yii::$app->request->post();
        $user_id=Yii::$app->user->identity->getId();
        $article_id=$req['id']??0;
        if (empty($article_id)){
            throw new BadRequestHttpException("文章不存在");
        }

        $artModel=Articles::findOne($article_id);

        if ( $artModel->user_id==Yii::$app->user->identity->getId() || $artModel->status!=Articles::STATUS_NORMAL){
            return $this->formatJson(200,"无法给自己点赞",[]);
        }



        $user=CommunityUsers::findOne($user_id);
        $artUser=CommunityUsers::findOne($artModel->user_id);
        $art_sub= ArticlesPraise::findOne(['article_id'=>$article_id,'user_id'=>$user_id]);
        if (!empty($art_sub)){
            $artModel->updateCounters(['get_heart'=>-1]);

            $del=$art_sub->delete();
            if ($del){
                $artModel->save();
                $user->updateCounters(['given_heart_count'=>-1]);
                $user->save();
                $artUser->updateCounters(['get_heart_count'=>-1]);
                $artUser->save();
                return  $this->formatJson(100,'取消点赞成功',['action'=>"cancel"]);
            }
            return  $this->formatJson(200,'取消点赞失败',[]);

        }else{
            $artSubModel=new ArticlesPraise();
            $artSubModel->user_id=$user_id;
            $artSubModel->created_at=time();
            $artSubModel->article_id=$article_id;
            $artSubModel->praise_user_id=$artModel->user_id;
            if ( $artSubModel->save()){
                $artModel->updateCounters(['get_heart'=>1]);
                $artModel->save();

                $user->updateCounters(['given_heart_count'=>1]);
                $user->save();
                $artUser->updateCounters(['get_heart_count'=>1]);
                $artUser->save();

                if (!Yii::$app->cache->get('check_heart_record'.$artModel->id.$user_id)){
                    $tag_integral_num=120;
                    $tag_integral=CommunityUserTag::findOne(['user_id'=>$artModel->user_id,'tag_id'=>$artModel->tag_id]);
                    if (!empty($tag_integral)){
                        $tag_integral->updateCounters(['integral'=>$tag_integral_num]);
                        $tag_integral->upTagLevel($tag_integral_num,$tag_integral['id']);
                        $tag_integral->save();
                    }
                    $technical=120;
                    $artUser->updateCounters(['integral'=>120,'technical'=>$technical]);
                    $artUser->save();
                    //技能点log

                    $user_tech_log=new CommunityTechnicalLog();
                    $user_tech_log->user_id=$artUser->id;
                    $user_tech_log->created_at=time();
                    $user_tech_log->from=CommunityTechnicalLog::FROM_TECH;
                    $user_tech_log->technical=$technical;
                    $user_tech_log->save();
                    //更改等级
                    $user_grade=new CommunityGradeLog();
                    $user_grade->UpUserGrade($technical+$artUser->technical,$user_id);
                    Yii::$app->cache->set('check_heart_record'.$artModel->id.$user_id,time());
                }

                return  $this->formatJson(100,'点赞成功',['action'=>"create"]);
            }
            return   $this->formatJson(200,'点赞失败',[]);
        }
    }


    public function actionReply()
    {
        $req=Yii::$app->request->post();
        $parent_id=$req['parent_id']??0;
        $html_content=$req['html_content']??'';
        $markdown_content=$req['markdown_content']??'';
        $user_id=Yii::$app->user->identity->getId();
        $article_id=$req['article_id']??0;
        if (empty( $article_id) || !($article=Articles::findOne($article_id))){
            return $this->formatJson(200,"问答不存在",'');
        }
        $artUser=CommunityUsers::findOne($article['user_id']);
        $article_user_id=$article['user_id'];
        if ($parent_id>0){
            $parent_reply=ArticlesReply::findOne($parent_id);
            if (empty($parent_reply)
                || $parent_reply['status']!=ArticlesReply::STATUS_NORMAL
                || $parent_reply['article_id']!=$article_id){
                return $this->formatJson(200,"无效回复",'');
            }
            if ($parent_reply['user_id']==$user_id){
                return $this->formatJson(200,"无法回复自己",'');
            }
        }
        $article->updateCounters(['reply_number'=>1]);
        $article->save();
        $replyModel=new ArticlesReply();
        $replyModel->user_id=$user_id;
        $replyModel->article_id=$article_id;
        $replyModel->parent_id=$parent_id;
        $replyModel->markdown_content=$markdown_content;
        $replyModel->html_content=$html_content;
        $replyModel->status=ArticlesReply::STATUS_NORMAL;
        $replyModel->article_user_id=$article_user_id;
        $replyModel->created_at=time();
        $replyModel->updated_at=time();
        if ($replyModel->save()){

            $messageModel=new UserMessage();
            $messageModel->user_id=$article->user_id;
            $messageModel->created_at=time();
            $messageModel->content=$artUser->nickname.'回复了您的文章['.$article->title.']';
            $messageModel->save();
            return $this->formatJson(100,"回复成功",'');
        }
        return $this->formatJson(200,"系统异常请稍后重试".$replyModel->getErrorSummary(false)[0],'');

    }


    public function actionReplyPraise()
    {

        $req=Yii::$app->request->post();
        $article_id=$req['article_id'];
        $article_reply_id=$req['article_reply_id'];
        $user_id=Yii::$app->user->identity->getId();

        if (empty($article_id) || !($article=Articles::findOne($article_id))){
            return $this->formatJson(200,"问答不存在",'');
        }
        if (empty($article_reply_id)
            || !($reply=ArticlesReply::findOne($article_reply_id))
            || $reply['article_id']!=$article_id
        ){
            return $this->formatJson(200,"无效回复",'');
        }
        $replyPraise=ArticleReplyPraise::getRow($reply['id'],$user_id);
        if (!empty($replyPraise)){
            $reply->updateCounters(['praise_nums'=>-1]);
            $reply->save();
            $replyPraise->delete();
            return $this->formatJson(100,"取消点赞成功",'');

        } else{

            $replyPraiseModel=new ArticleReplyPraise();
            $replyPraiseModel->user_id=$user_id;
            $replyPraiseModel->reply_id=$reply['id'];
            $replyPraiseModel->created_at=time();

            if( $replyPraiseModel->save()){
                $reply->updateCounters(['praise_nums'=>1]);
                $reply->save();
                return $this->formatJson(100,"点赞成功",'');
            }else{
                return $this->formatJson(200,"点赞失败",'');
            }
        }

    }


}
