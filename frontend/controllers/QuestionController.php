<?php
namespace frontend\controllers;
use common\models\CommunityQuestion;
use common\models\CommunityTag;
use common\models\CommunityUserLink;
use common\models\CommunityUsers;
use common\models\CommunityUserTag;
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

        $Question=new CommunityQuestion();
        $Question->scenario=CommunityQuestion::SCENARIO_USER_CREATE;
        if ($Question->load($req) && $Question->save()){
            ///user/center?tab=question
            return $this->redirect(Url::to(['/user/center','tab'=>'question']));
        }else{
          return  $this->render('create_ques',['ques_model'=>$Question]);
        }



    }

}