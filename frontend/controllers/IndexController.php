<?php
namespace frontend\controllers;

use common\models\BaseModel;
use common\models\CommunityQuestion;
use common\models\CommunityTag;
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
class IndexController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $req=Yii::$app->request->get();
        $req['tag_id']=$req['tag_id']??0;
        $req['solve']=$req['solve']??CommunityQuestion::SOLVE_NOT;
        $tagModel=new CommunityTag();
        $tagWhere=['status'=>CommunityTag::STATUS_NORMAL,'type'=>CommunityTag::TYPE_SKILLS];
        $tag_list=$tagModel->getList($tagWhere);
        $communityQuestionModel=(new CommunityQuestion());
        $question_list=[];
        $question_count=$communityQuestionModel->getNewBestCount($req['tag_id'],$req['solve']);
        $pagination = new Pagination(['totalCount' =>$question_count, 'pageSize' => BaseModel::PAGE_SIZE]);
        if ($question_count>0){
            $question_list=$communityQuestionModel->getNewBest($req['tag_id'],$req['solve'],$pagination);
        }
        $main_count=[];
        $main_count['solve_yes_count']=$communityQuestionModel->getCountByMap(['is_solve'=>CommunityQuestion::SOLVE_YES]);
        $main_count['solve_not_count']=$communityQuestionModel->getCountByMap(['is_solve'=>CommunityQuestion::SOLVE_NOT]);
        return $this->render('index',[
            'question_list'=>$question_list,
            'tag_list'=>$tag_list,
            'pagination' => $pagination,
            'main_count'=>$main_count,
            'req'=>$req,
        ]);
    }

}
