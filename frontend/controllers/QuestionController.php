<?php


namespace frontend\controllers;
use common\models\CommunityQuestion;
use common\models\CommunityUsers;
use Yii;
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

        return $this->render("detail",[
            'question'=>$question,
            'question_user_info'=>$question_user_info,
        ]);

    }

}