<?php
namespace frontend\controllers;

use common\models\BaseModel;
use common\models\CommunityGradeLog;
use common\models\CommunityQuestion;
use common\models\CommunityTag;
use common\models\CommunityTechnicalLog;
use common\models\CommunityUserLink;
use common\models\CommunityUsers;
use common\models\CommunityUserTag;
use common\models\UploadAvatarForm;
use common\models\UploadImgForm;
use Yii;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\UploadedFile;

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


   public function actionProfile()
   {

       $req=Yii::$app->request->get();
       $tab=$req['tab']??'profile';
       $user_id=Yii::$app->user->identity->getId();
       $user_info=CommunityUsers::findOne($user_id);
       $QuestionModel=new CommunityQuestion();
       $question_count=$QuestionModel->getUserQuesCount($user_id,['in',CommunityQuestion::STATUS_NORMAL,CommunityQuestion::STATUS_CLOSE]);
       $userTag =new CommunityUserTag();
       $question_user_tag=$userTag->getUserTag($user_id);
       $userLinkModel=new CommunityUserLink();
       $user_link=$userLinkModel->getUserLink(['user_id'=>$user_id,"status"=>[CommunityUserLink::STATUS_NORMAL]]);

       $tagModel=new CommunityTag();
       $tagWhere=['status'=>CommunityTag::STATUS_NORMAL,'type'=>CommunityTag::TYPE_SKILLS];
       $tag_list=$tagModel->getList($tagWhere);

       return $this->render("profile",[
           'tab'=>$tab,
           'tag_list'=>$tag_list,
           'user_info'=>$user_info,
           'question_count'=>  $question_count,
           'question_user_tag'=>$question_user_tag,
           'user_link'=>$user_link,
       ]);

   }

   public function actionUpdateProfile()
   {
       $user=CommunityUsers::findOne(Yii::$app->user->getId());
       $user->setScenario(CommunityUsers::SCENARIO_UPDATE_PROFILE);
       if ($user->load(Yii::$app->request->post(),'') && $user->save()){
           Yii::$app->session->setFlash("update_status","100");
       }else{

           Yii::$app->session->setFlash("update_status","200");
           Yii::$app->session->setFlash("update_error_message",$user->getErrorSummary(false)[0]);
       }
       return $this->redirect(Url::to(['user/profile']));


   }


    public function actionUpdateUserTag()
    {
        $req=Yii::$app->request->post();

        $user_id=Yii::$app->user->identity->getId();
        $tags=$req['tag_vals']??[];

        $userTag =new CommunityUserTag();
        $user_tag=$userTag->getUserTag($user_id);
        $user_tag_id=array_column($user_tag,'tag_id');

        $remove=array_diff($user_tag_id,$tags);//需要移除标签
        $add=array_diff($tags,$user_tag_id);//新增的标签
        if (!empty($remove)){
            $userTag->deleteAll(['tag_id'=>$remove]);
        }
        $record=[];
        foreach ($add as $key=>$value){
            $record[] =[
                'tag_id'=>$value,
                'user_id'=>$user_id,
                'level'=>CommunityUserTag::DEFAULT_LEVEL,
                'status'=>CommunityUserTag::STATUS_NORMAL,
                'created_time'=>time(),
                'updated_time'=>time(),
            ];
        }
        if (count($record)>0){
            Yii::$app->db->createCommand()
                ->batchInsert(CommunityUserTag::tableName(),array_keys($record[0]),$record)
                ->execute();

        }
        return $this->formatJson('100','更新成功','');



    }
   public function actionUpdateAvatar()
   {
       $model = new UploadAvatarForm();

       if (Yii::$app->request->isPost) {
           $model->imageFile = UploadedFile::getInstanceByName('file');
           $file=$model->upload();
           if ($file) {
               $data=['success'=>1,'message'=>'上传成功','url'=>$file];
           }else{
               $data=['success'=>0,'message'=>'上传失败'.$model->getErrorSummary(false)[0]];
           }
           $user=CommunityUsers::findOne(Yii::$app->user->identity->getId());
           $user->avatar=$file;
           $user->save();
           return $this->asJson($data);
       }
   }

   public function actionUserLinkCreate()
   {
       $model=new  CommunityUserLink();
       $model->user_id=Yii::$app->user->identity->getId();
       if ($model->load(Yii::$app->request->post(),'') && $model->save()){
           return $this->formatJson(100,"添加成功",[]);
       }else{
           Yii::error($model->parseIcon());
           return $this->formatJson(200,"添加失败".$model->getErrorSummary(false)[0],[]);
       }

   }
}
