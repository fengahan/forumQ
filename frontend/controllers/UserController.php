<?php
namespace frontend\controllers;

use common\models\CommunityQuestion;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\data\Pagination;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class UserController extends Controller
{

   public function actionCenter()
   {
       $user_id=Yii::$app->user->identity->getId();
       $QuestionModel=new CommunityQuestion();
       $question_count=$QuestionModel->getUserQuesCount($user_id);



      return $this->render("center",[]);



   }

}
