<?php
namespace frontend\controllers;

use common\models\Articles;
use common\models\CommunityQuestion;
use common\models\CommunityTag;
use common\models\UploadImgForm;
use Yii;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;


/**
 * Site controller
 */
class ArticleController extends BaseController
{



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


    public function actionHeart()
    {

    }


    public function actionReply()
    {

    }




}
