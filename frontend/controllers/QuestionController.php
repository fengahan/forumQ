<?php
namespace frontend\controllers;
use common\models\CommunityQuestion;
use common\models\CommunityTag;
use common\models\CommunityUserLink;
use common\models\CommunityUsers;
use common\models\CommunityUserTag;
use common\models\UploadImgForm;
use mysql_xdevapi\Warning;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\NotAcceptableHttpException;
use yii\web\NotFoundHttpException;

class QuestionController extends BaseController
{

    /**
     * @throws NotFoundHttpException
     */
    public function actionDetail()
    {
        $req=Yii::$app->request->get();
        $question_id=(int)$req['question_id'];
        if (empty($question_id)){
            throw new NotFoundHttpException("未找到当前答案");
        }
        $QuestionModel=new CommunityQuestion();
        $question=$QuestionModel->getQuestionContent($question_id);
        if (empty($question)){
            throw new NotFoundHttpException("未找到当前答案");
        }
        $userModel=new CommunityUsers();
        $question_user_info=$userModel->getUserInfo($question['user_id']);
        $userTag =new CommunityUserTag();
        $question_user_tag=$userTag->getUserTag($question['user_id']);
        $userLinkModel=new CommunityUserLink();
        $user_link=$userLinkModel->getUserLink(['user_id'=>$question['user_id'],"status"=>[CommunityUserLink::STATUS_NORMAL]]);
        return $this->render("detail",[
            'question'=>$question,
            'question_user_info'=>$question_user_info,
            'question_user_tag'=>$question_user_tag,
            'user_link'=>$user_link
        ]);

    }

    /**
     * @throws BadRequestHttpException
     */
    public function actionCreate()
    {
        $req=Yii::$app->request->post();
        $model = new UploadImgForm();



        $Question=new CommunityQuestion();
        $Question->scenario=CommunityQuestion::SCENARIO_USER_CREATE;
        $Question->user_id=Yii::$app->user->identity->getId();
        $Question->user_identity=Yii::$app->user->identity->type;
        if ($Question->load($req,"") && $Question->save()){
            ///user/center?tab=question
            return $this->redirect(Url::to(['/user/center','tab'=>'question']));
        }else{

          $Tag=new CommunityTag();
          $tagWhere=['status'=>CommunityTag::STATUS_NORMAL,'type'=>CommunityTag::TYPE_SKILLS];
          $tag_list=$Tag->getList($tagWhere);
          return  $this->render('create_ques',
              [
                 'model' => $model,
                  'ques_model'=>$Question,
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

        $ques_id=$req['id']??0;
        $Question=new CommunityQuestion();
        $user_id=Yii::$app->user->identity->getId();
        if (empty($ques_id)){
            $ques_id=Yii::$app->request->get("id");
        }
        $question=$Question->getQuestionContent($ques_id);
        if (empty($question) || $question['status']==CommunityQuestion::STATUS_DELETE || $question['user_id']!=$user_id){
            throw new NotFoundHttpException("问答不存在了");
        }

        $Question->id=$ques_id;
        $Question->isNewRecord=false;
        $Question->user_id=$user_id;
        $Question->user_identity=Yii::$app->user->identity->type;
        if ($Question->load($req,"") && $Question->save()){
            ///user/center?tab=question
            return $this->redirect(Url::to(['/user/center','tab'=>'question']));
        }else{

            $Tag=new CommunityTag();
            $tagWhere=['status'=>CommunityTag::STATUS_NORMAL,'type'=>CommunityTag::TYPE_SKILLS];
            $tag_list=$Tag->getList($tagWhere);
            return  $this->render('update_ques',
                [
                    'ques_model'=>$Question,
                    'ques_info'=>$question,
                    'tag_list'=>$tag_list,
                ]
            );
        }

    }

    public function actionAction()
    {
        $req=Yii::$app->request->post();
        $id=$req['id']?(int)$req['id']:0;
        $status=$req['status']?(int)$req['status']:0;
        if (empty($id) || empty($status)){
            return $this->formatJson(100,"操作有误",[]);
        }

        $QuestionModel=new CommunityQuestion();
        $question=$QuestionModel->getQuestionContent($id);
        if (empty($question) ||$question['user_id']!=Yii::$app->user->identity->getId() || $question['status']==CommunityQuestion::STATUS_DELETE){
            return $this->formatJson(100,"操作有误",[]);
        }
        if ($question['status']==$status){
            return $this->formatJson(100,"无法重复此操作",[]);
        }
        $QuestionModel->status=$status;
        if (!$QuestionModel->save()){
            return $this->formatJson(100,$QuestionModel->getErrorSummary(false)[0],[]);
        }else{
            return $this->formatJson(200,'更新成功',[]);
        }




    }

}