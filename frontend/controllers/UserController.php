<?php
namespace frontend\controllers;

use common\models\BaseModel;
use common\models\CommunityGradeLog;
use common\models\CommunityQuestion;
use common\models\CommunityTechnicalLog;
use common\models\CommunityUserLink;
use common\models\CommunityUserTag;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

/**
 * Site controller
 */
class UserController extends BaseController
{

   public function actionCenter()
   {
       $req=Yii::$app->request->get();
       $tab=$req['tab']??'home';

       $user_id=Yii::$app->user->identity->getId();
       $QuestionModel=new CommunityQuestion();
       $question_count=$QuestionModel->getUserQuesCount($user_id,['in',CommunityQuestion::STATUS_NORMAL,CommunityQuestion::STATUS_CLOSE]);
       $userTag =new CommunityUserTag();
       $question_user_tag=$userTag->getUserTag($user_id);
       $userLinkModel=new CommunityUserLink();
       $user_link=$userLinkModel->getUserLink(['user_id'=>$user_id,"status"=>[CommunityUserLink::STATUS_NORMAL]]);

       $userGradeLog=new CommunityGradeLog();
       $user_grade_progress=$userGradeLog->getUserProgress($user_id);
       $question_pagination= new Pagination(
           [
               'params'=>array_merge($req,['tab'=>'question']),
               'totalCount' =>$question_count,
               'pageParam'=>'q_page',
               'pageSize' => BaseModel::PAGE_SIZE
           ]);
       $user_question=$QuestionModel->getUserQues($user_id,['in',CommunityQuestion::STATUS_NORMAL,CommunityQuestion::STATUS_CLOSE], $question_pagination);




       return $this->render("center",
          [
              'tab'=>$tab,
              'grade_progress'=>$user_grade_progress,
              'user_question'=>$user_question,
              'question_pagination'=> $question_pagination,
              'question_count'=>$question_count,
              'question_user_tag'=>$question_user_tag,
              'user_link'=>$user_link
          ]
      );



   }


    /**
     * 技能点分布
     * 环形图数据
     */
   public function actionPieData()
   {
       $user_id=Yii::$app->user->identity->getId();
       $TechLog=new CommunityTechnicalLog();
       $tech_data=$TechLog->getUserTechGroupByForm($user_id);
       $tech_count=array_sum(array_column($tech_data,'total'));
       $tech_row=$tech_res=[];

       foreach ($tech_data as $key=>$val){
           $tech_row['data']=round($val['total']/$tech_count*10,2);
           $tech_row['label']=CommunityTechnicalLog::$from_label[$val['from']];
           $tech_row['color']=CommunityTechnicalLog::$from_color[$val['from']];
           $tech_res[]=$tech_row;
       }

       return $this->formatJson('200','获取成功',$tech_res);


   }
}
