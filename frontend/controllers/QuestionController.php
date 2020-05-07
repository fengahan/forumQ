<?php
namespace frontend\controllers;
use common\models\CommunityGradeLog;
use common\models\CommunityQuesReply;
use common\models\CommunityQuestion;
use common\models\CommunityTag;
use common\models\CommunityTechnicalLog;
use common\models\CommunityUserLink;
use common\models\CommunityUsers;
use common\models\CommunityUserTag;
use common\models\QuesReplyEmoji;
use common\models\QuesSubscribe;
use common\models\UploadImgForm;
use common\models\User;
use common\models\UserMessage;
use mysql_xdevapi\Warning;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\UnauthorizedHttpException;

class QuestionController extends BaseController
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only'=>['action','create','reply','reply-accept','reply-emj','update','subscribe'],
                'rules' => [

                    [
                        'actions' =>['action','create','reply','reply-accept','reply-emj','update','subscribe'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                ],
                'denyCallback' => function ($rule, $action) {
                    if (Yii::$app->request->isAjax){
                        return $this->formatJson(200,"请先登陆",[]);
                    }else{
                        throw new UnauthorizedHttpException("请先登录");
                    }
                }
            ],
        ];
    }

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
        $is_subscribe=0;
        if (!Yii::$app->user->isGuest){
            $ques_sub= QuesSubscribe::findOne(['ques_id'=>$question_id,'user_id'=>Yii::$app->user->identity->getId()]);
            if (!empty($ques_sub)){
                $is_subscribe=1;
            }
        }
        $QuestionReply=new CommunityQuesReply();
        $reply_list=$QuestionReply->getReplyList($question_id);

        $userModel=new CommunityUsers();
        $question_user_info=$userModel->getUserInfo($question['user_id']);
        $userTag =new CommunityUserTag();
        $question_user_tag=$userTag->getUserTag($question['user_id']);
        $userLinkModel=new CommunityUserLink();
        $user_link=$userLinkModel->getUserLink(['user_id'=>$question['user_id'],"status"=>[CommunityUserLink::STATUS_NORMAL]]);
        return $this->render("detail",[
            'reply_list'=>$reply_list,
            'is_subscribe'=>$is_subscribe,
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
        $Question->scenario=CommunityQuestion::SCENARIO_QUES_CREATE;
        $Question->user_id=Yii::$app->user->identity->getId();
        $Question->user_identity=Yii::$app->user->identity->type;
        $user=User::findOne(Yii::$app->user->identity->getId());
        if (Yii::$app->request->isPost) {
            $req['money']=$req['integral']
            if ((int)$req['integral'] > $user->integral) {
                $Question->addError("money", '您的赏金不足');
            } else if ($Question->load($req, "") && $Question->save()) {
                ///user/center?tab=question
                $user->updateCounters(['integral'=>(0-(int)$req['integral'])]);
                return $this->redirect(Url::to(['/user/center', 'tab' => 'question']));
            }
        }

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
         $user=User::findOne(Yii::$app->user->identity->getId());
         $sub_money=(int)$req['integral']-$question['money'];

        if (Yii::$app->request->isPost  ) {
            if ($sub_money>$user->integral){
                $Question->addError("integral",'您的赏金不足');
            }
            else if ($Question->load($req,"") && $Question->save()){
                ///user/center?tab=question
                 $user->updateCounters(['integral'=> $sub_money]);
                return $this->redirect(Url::to(['/user/center','tab'=>'question']));
            }
        }
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

    public function actionAction()
    {
        $req=Yii::$app->request->post();
        $id=$req['id']?(int)$req['id']:0;
        $status=$req['status']?(int)$req['status']:0;
        if (empty($id) || empty($status)){
            return $this->formatJson(200,"操作有误",[]);
        }

        $QuestionModel=CommunityQuestion::findOne($id);

        if ( $QuestionModel->user_id!=Yii::$app->user->identity->getId() || $QuestionModel->status==CommunityQuestion::STATUS_DELETE){
            return $this->formatJson(200,"操作有误",[]);
        }
        if ($QuestionModel->status==$status){
            return $this->formatJson(200,"无法重复此操作",[]);
        }
        $QuestionModel->status=$status;
        if (!$QuestionModel->save()){
            return $this->formatJson(200,$QuestionModel->getErrorSummary(false)[0],[]);
        }else{
            return $this->formatJson(100,'更新成功',[]);
        }



    }

    /**
     * @return \yii\web\Response
     * @throws BadRequestHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionSubscribe()
    {

        $req=Yii::$app->request->post();
        $user_id=Yii::$app->user->identity->getId();
        $ques_id=$req['id']??0;
        if (empty($ques_id)){
            throw new BadRequestHttpException("问答不存在");
        }

        $QuestionModel=CommunityQuestion::findOne($ques_id);
        if ($QuestionModel->is_solve==CommunityQuestion::SOLVE_YES){
            return $this->formatJson(200,"无法订阅该问答",[]);
        }
        if ($QuestionModel->is_public==CommunityQuestion::PUBLIC_NOT){
            return $this->formatJson(200,"无法订阅该问答",[]);
        }
        if ( $QuestionModel->user_id==Yii::$app->user->identity->getId() || $QuestionModel->status!=CommunityQuestion::STATUS_NORMAL){
            return $this->formatJson(200,"无法订阅自己的问答",[]);
        }
        $ques_sub= QuesSubscribe::findOne(['ques_id'=>$ques_id,'user_id'=>$user_id]);
        if (!empty($ques_sub)){
            $QuestionModel->updateCounters(['subscribe_number'=>-1]);

            $del=$ques_sub->delete();
            if ($del){
                $QuestionModel->save();
              return  $this->formatJson(100,'取消订阅成功',['action'=>"cancel"]);
            }
          return  $this->formatJson(200,'取消订阅失败',[]);

        }else{
            $quesSubModel=new QuesSubscribe();
            $quesSubModel->user_id=$user_id;
            $quesSubModel->create_at=time();
            $quesSubModel->ques_id=$ques_id;
            if ($quesSubModel->save()){
                $QuestionModel->updateCounters(['subscribe_number'=>1]);
                $QuestionModel->save();
              return  $this->formatJson(100,'订阅成功',['action'=>"create"]);
            }
            return   $this->formatJson(200,'订阅失败',[]);
        }


    }


    public function actionReply()
    {
        $req=Yii::$app->request->post();
        $parent_id=$req['parent_id']??0;
        $html_content=$req['html_content']??'';
        $markdown_content=$req['markdown_content']??'';
        $user_id=Yii::$app->user->identity->getId();
        $ques_id=$req['ques_id']??0;
        if (empty($ques_id) || !($ques=CommunityQuestion::findOne($ques_id))){
            return $this->formatJson(200,"问答不存在",'');
        }
        $ques_user_id=$ques['user_id'];
        $quesUser=User::findOne($ques_user_id);

        if ($parent_id>0){
            $parent_reply=CommunityQuesReply::findOne($parent_id);
            if (empty($parent_reply)
                || $parent_reply['status']!=CommunityQuesReply::STATUS_NORMAL
                || $parent_reply['ques_id']!=$ques_id){
                return $this->formatJson(200,"无效回复",'');
            }
            if ($parent_reply['user_id']==$user_id){
                return $this->formatJson(200,"无法回复自己",'');
            }
        }
        $ques->updateCounters(['reply_number'=>1]);
        $ques->last_reply_nickname=Yii::$app->user->identity->nickname;
        $ques->last_reply_at=time();
        $ques->save();
        $replyModel=new CommunityQuesReply();
        $replyModel->user_id=$user_id;
        $replyModel->ques_id=$ques_id;
        $replyModel->parent_id=$parent_id;
        $replyModel->reply_markdown_content=$markdown_content;
        $replyModel->reply_html_content=$html_content;
        $replyModel->status=CommunityQuesReply::STATUS_NORMAL;
        $replyModel->ques_user_id=$ques_user_id;
        $replyModel->created_at=time();
        if ($replyModel->save()){
            $messageModel=new UserMessage();
            $messageModel->user_id=$ques_user_id;
            $messageModel->created_at=time();
            $messageModel->content=$quesUser->nickname.'回复了您的问答['.$ques->title.']';
            $messageModel->save();
            return $this->formatJson(100,"回复成功",'');
        }
        return $this->formatJson(200,"系统异常请稍后重试".$replyModel->getErrorSummary(false)[0],'');

    }

    public function actionReplyEmj()
    {

        $req=Yii::$app->request->post();
        $ques_id=$req['ques_id'];
        $ques_reply_id=$req['ques_reply_id'];
        $user_id=Yii::$app->user->identity->getId();
        $emj_key=$req['emj_key']??'';
        if (empty($ques_id) || !($question=CommunityQuestion::findOne($ques_id))){
            return $this->formatJson(200,"问答不存在",'');
        }
        if (empty($ques_reply_id)
            || !($reply=CommunityQuesReply::findOne($ques_reply_id))
            || $reply['ques_id']!=$ques_id
        ){
            return $this->formatJson(200,"无效回复",'');
        }
        $emjReply=QuesReplyEmoji::findOne(['ques_reply_id'=>$ques_reply_id,'key'=>$emj_key]);
        if ($emjReply['user_id']==$user_id){
            $emjReply->updateCounters(['count'=>-1]);
            $emjReply->save();
            if ($emjReply->count==0){
                $emjReply->delete();
            }
            return $this->formatJson(100,"回复成功",'');
        }

        if ($emjReply){
            $emjReply->updateCounters(['count'=>1]);
            $emjReply->save();
            return $this->formatJson(100,"回复成功",'');
        }else{
            $emjReplyNew=new QuesReplyEmoji();
            $emjReplyNew->user_id=$user_id;
            $emjReplyNew->count=1;
            $emjReplyNew->ques_id=$ques_id;
            $emjReplyNew->ques_reply_id=$ques_reply_id;
            $emjReplyNew->emoji_key=QuesReplyEmoji::$kes[$emj_key];
            $emjReplyNew->key=$emj_key;
            $emjReplyNew->create_at=time();
            if( $emjReplyNew->save()){
                return $this->formatJson(100,"回复成功",'');
            }else{
                return $this->formatJson(200,"回复失败",'');
            }
        }


    }

    /**
     * @return \yii\web\Response
     * @throws \Throwable
     */
    public function actionReplyAccept()
    {

        $req=Yii::$app->request->post();
        $ques_id=$req['ques_id'];
        $ques_reply_id=$req['ques_reply_id'];
        $user_id=Yii::$app->user->identity->getId();
        if (empty($ques_id) || !($question=CommunityQuestion::findOne(['id'=>$ques_id,'user_id'=>$user_id]))){
            return $this->formatJson(200,"问答不存在",'');
        }
        if (empty($ques_reply_id)
            || !($reply=CommunityQuesReply::findOne($ques_reply_id))
            || $reply['ques_id']!=$ques_id || $question['best_reply_id']>0
        ){
            return $this->formatJson(200,"无效操作",'');
        }
        $question_user=CommunityUsers::findOne($question->user_id);
        $transaction =Yii::$app->db->beginTransaction();
        $success=false;
        try {

            $question->is_solve=CommunityQuestion::SOLVE_YES;
            $question->best_reply_id=$ques_reply_id;
            $question->best_reply_at=time();
            $q_bool=$question->save();
            $reply->is_best=CommunityQuesReply::BEST_YES;
            $r_bool=$reply->save();

            if ($question['user_id']!=$reply['user_id']){
                $tag_integral_num=$question['money']*8;
                $tag_integral=CommunityUserTag::findOne(['user_id'=>$reply['user_id'],'tag_id'=>$question['tag_id']]);
                if (!empty($tag_integral)){
                    $tag_integral->updateCounters(['integral'=>$tag_integral_num]);
                    $tag_integral->upTagLevel($tag_integral_num,$tag_integral['id']);
                    $tag_integral->save();
                }
                $technical=$question['money']*40;
               $reply_user= CommunityUsers::findOne($reply['user_id']);
               if ($question['money']>0){
                   $reply_user->updateCounters(['integral'=>$question['money'],'technical'=>$technical]);
                   $reply_user->save();
               }
               //技能点log

               $user_tech_log=new CommunityTechnicalLog();
               $user_tech_log->user_id=$reply_user['id'];
               $user_tech_log->created_at=time();
               $user_tech_log->from=CommunityTechnicalLog::FROM_BEST_QES;
               $user_tech_log->technical=$technical;
               $user_tech_log->save();
                //更改等级
               $user_grade=new CommunityGradeLog();
               $user_grade->UpUserGrade($technical+$reply_user['technical'],$user_id);

                $messageModel=new UserMessage();
                $messageModel->user_id=$reply['user_id'];
                $messageModel->created_at=time();
                $messageModel->content= $question_user->nickname."在问答 [".$question->title."]中采取了您的回复";
                $messageModel->save();

                if ($question->is_public==CommunityQuestion::PUBLIC_YES){
                    $subUsers=QuesSubscribe::find()->select('user_id')->where(['ques_id'=>$question->id])->all();
                    $msg_data=[];
                    foreach ($subUsers as $key=>$val){
                        $msg_data[]= [
                            'user_id'=>$val,
                            'content'=>"您订阅的问答".'['.$question->title.']'."有了最佳回复",
                            'created_at'=>time(),
                        ];
                    }
                    if (count($msg_data)>0){
                        Yii::$app->db->createCommand()
                            ->batchInsert(UserMessage::tableName(),array_keys($msg_data[0]),$msg_data)
                            ->execute();
                    }

                }

            }
            if (!$q_bool || !$r_bool ){
                $transaction->rollBack();
            }else{
                $success=true;
                $transaction->commit();
            }
        } catch(\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch(\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }

        if ($success){
            return $this->formatJson(100,"采纳成功",'');
        }
        return $this->formatJson(200,"操作失败",'');

    }



}