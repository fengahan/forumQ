<?php
namespace frontend\controllers;

use common\models\Articles;
use common\models\BaseModel;
use common\models\CommunityGradeLog;
use common\models\CommunityQuesReply;
use common\models\CommunityQuestion;
use common\models\CommunityTag;
use common\models\CommunityTechnicalLog;
use common\models\CommunityUserLink;
use common\models\CommunityUsers;
use common\models\CommunityUserTag;
use common\models\UploadAvatarForm;
use common\models\User;
use common\models\UserInviteMap;
use common\models\UserMessage;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class UserController extends BaseController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only'=>['center','pie-data','profile','update-avatar','update-profile','user-tag','link-create','link-delete','link-update','invite_code'],
                'rules' => [

                    [
                        'actions' => ['center','pie-data','profile','update-avatar','update-profile','user-tag','link-create','link-delete','invite_code','link-update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                ],
                'denyCallback' => function ($rule, $action) {
                    if (Yii::$app->request->isAjax){
                        return $this->formatJson(200,"请先登陆",[]);
                    }
                }
            ],
        ];
    }
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

       $ArticleModel=new Articles();
       $article_count=$ArticleModel->getUserArtCount($user_id,['in',Articles::STATUS_NORMAL,Articles::STATUS_CLOSE]);
       $article_pagination= new Pagination(
           [
               'params'=>array_merge($req,['tab'=>'technology']),
               'totalCount' =>$article_count,
               'pageParam'=>'t_page',
               'pageSize' => BaseModel::PAGE_SIZE
           ]);
       $messageModel=new UserMessage();
       if ($tab=='message')
       {
           UserMessage::updateAll(['status' =>UserMessage::STATUS_READ],['status'=>UserMessage::STATUS_NORMAL]);
       }
       $message_count=UserMessage::find()->where(['in','status',[UserMessage::STATUS_NORMAL,UserMessage::STATUS_READ]])->count();
       $message_pagination= new Pagination(
           [
               'params'=>array_merge($req,['tab'=>'message']),
               'totalCount' =>$message_count,
               'pageParam'=>'m_page',
               'pageSize' => BaseModel::PAGE_SIZE
           ]);

       $message=$messageModel->getUserMessage($user_id,['in',UserMessage::STATUS_NORMAL,UserMessage::STATUS_READ],$message_pagination);


       $user_article=$ArticleModel->getUserArticle($user_id,['in',Articles::STATUS_NORMAL,Articles::STATUS_CLOSE], $article_pagination);

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

       $best_reply_count=CommunityQuesReply::find()->where('user_id='.$user_id)->andWhere('is_best='.CommunityQuesReply::BEST_YES)->count();
       return $this->render("center",
          [
              'tab'=>$tab,
              'user_article'=>$user_article,
              'article_count'=>$article_count,
              'article_pagination'=> $article_pagination,
              'message'=>$message,
              'message_pagination'=>$message_pagination,
              'grade_progress'=>$user_grade_progress,
              'user_question'=>$user_question,
              'question_pagination'=> $question_pagination,
              'question_count'=>$question_count,
              'best_reply_count'=>$best_reply_count,
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
       $best_reply_count=CommunityQuesReply::find()->where('user_id='.$user_id)->andWhere('is_best='.CommunityQuesReply::BEST_YES)->count();
       $ArticleModel=new Articles();
       $article_count=$ArticleModel->getUserArtCount($user_id,['in',Articles::STATUS_NORMAL,Articles::STATUS_CLOSE]);
       $invite_map=UserInviteMap::findOne(['user_id'=>$user_id]);
       $parent_user_info=[];
       if (!empty($invite_map)){
           $parent_user_info=User::find()->select('nickname,avatar,invite_code')->where(['id'=>$invite_map->parent_id])->asArray()->one();
       }

       return $this->render("profile",[
           'best_reply_count'=>$best_reply_count,
           'article_count'=>$article_count,
           'tab'=>$tab,
           'tag_list'=>$tag_list,
           'user_info'=>$user_info,
           'question_count'=>  $question_count,
           'question_user_tag'=>$question_user_tag,
           'user_link'=>$user_link,
           'parent_user_info'=>$parent_user_info,
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
            $userTag->deleteAll(['tag_id'=>$remove,'user_id'=>$user_id]);
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
           return $this->formatJson(200,"添加失败".$model->getErrorSummary(false)[0],[]);
       }

   }

    public function actionUserLinkUpdate()
    {
        $id=(int)Yii::$app->request->post('id');

        $model=CommunityUserLink::findOne($id);
        if (empty($model)){
            return $this->formatJson(200,"更新失败",[]);
        }
        $model->isNewRecord;
        if ($model->load(Yii::$app->request->post(),'') && $model->save()){
            return $this->formatJson(100,"更新成功",[]);
        }else{
            return $this->formatJson(200,"更新失败".$model->getErrorSummary(false)[0],[]);
        }

    }

    public function actionResetPassword()
    {
        $req=Yii::$app->request->post();
        $old_password=$req['old_password']??'';
        $new_password=$req['new_password']??'';
        if ($old_password == $new_password){
            return $this->formatJson(200,"原密码和新密码相同",[]);
        }
        if (empty(trim($old_password)) || empty(trim($new_password))){
            return $this->formatJson(200,"原密码或者新密码格式错误",[]);
        }
        if (mb_strlen($new_password)<6){
            return $this->formatJson(200,"新密码最少为6位字符",[]);
        }
        $user=User::findOne(Yii::$app->user->identity->getId());
        if (!$user->validatePassword($old_password)){
            return $this->formatJson(200,"原密码错误",[]);
        }else{
            if (! $user->resetPassword($new_password)){
                return $this->formatJson(200,"原密码错误",[]);
            }else{
                Yii::$app->user->logout();
                return $this->formatJson(100,"修改成功",['url'=>Yii::$app->getHomeUrl()]);
            }
        }


    }

    public function actionUserLinkDelete()
   {

       $id=(int)Yii::$app->request->post('id');
       $user_id=Yii::$app->user->identity->getId();
       if ($id){
          $link= CommunityUserLink::findOne(['id'=>$id,'user_id'=>$user_id]);
          if (!empty($link)){
              $link->status=CommunityUserLink::STATUS_DELETE;
              $link->icon=ltrim($link->icon,'zmdi-');
              $link->save();
              return $this->formatJson(100,"删除成功",[]);
          }
       }
       return $this->formatJson(200,"删除失败",[]);

   }

   public function actionInviteCode()
   {
       $invite_code=Yii::$app->request->post('invite_code');
       $user_id=Yii::$app->user->identity->getId();
       if (empty($invite_code) || strlen($invite_code)!=8 ){
           return $this->formatJson(200,"填写邀请码失败",[]);
       }
       $parent_user=User::find()->where(['invite_code'=>(int)$invite_code])->one();
       if (empty($parent_user) || $parent_user['status']!=User::STATUS_ACTIVE){
           return $this->formatJson(200,"该邀请码不存在或者邀请着账户未经过邮箱验证",[]);
       }

       $invite_map=UserInviteMap::findOne(['parent_invite_code'=>$invite_code]);
       if (!empty($invite_map)){
           return $this->formatJson(200,"填写邀请码失败",[]);
       }
       $trans=Yii::$app->db->beginTransaction();
       try{
           $inviteModel=new UserInviteMap();
           $inviteModel->user_id=$user_id;
           $inviteModel->parent_id=$parent_user->id;
           $inviteModel->parent_invite_code=(int)$invite_code;
           $check_pr= $parent_user->updateCounters(['integral'=>UserInviteMap::BIND_GIVEN_MONEY]);
           $check_u= Yii::$app->user->identity->updateCounters(['integral'=>UserInviteMap::BIND_GIVEN_MONEY]);
           if ($inviteModel->save()==true && $check_pr && $check_u){
               $trans->commit();
               return $this->formatJson(100,"邀请码填写成功",['url'=>Url::to(['/user/invite-code','tab'=>'invite_code'])]);
           }else{
               $trans->rollBack();
               return $this->formatJson(200,"邀请码失败",[]);
           }


       }catch (\Exception $e){
           $trans->rollBack();
           return $this->formatJson(200,"邀请码失败".$e->getMessage(),[]);
       }

   }
}
