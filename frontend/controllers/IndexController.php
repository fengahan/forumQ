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
        $req['tag_id']=isset($req['tag_id'])?(int)$req['tag_id']:0;
        $req['solve']=isset($req['solve'])?(int)$req['solve']:CommunityQuestion::SOLVE_NOT;
        $req['is_public']=isset($req['is_public'])?(int)$req['is_public']:0;
        $req['sort']=isset($req['sort'])?$req['sort']:"created_at";//'new_created'
        $req['search_word']=isset($req['search_word'])?$req['search_word']:"";
        $list_where['tag_id']=$req['tag_id'];
        $list_where['solve']=$req['solve'];
        $list_where['is_public']=$req['is_public'];
        $list_where["search_word"]=$req['search_word'];
        $sort=$req['sort'];
        $tagModel=new CommunityTag();
        $tagWhere=['status'=>CommunityTag::STATUS_NORMAL,'type'=>CommunityTag::TYPE_SKILLS];
        $tag_list=$tagModel->getList($tagWhere);
        $communityQuestionModel=(new CommunityQuestion());
        $question_list=[];
        $question_count=$communityQuestionModel->getNewBestCount($list_where);
        $pagination = new Pagination(['totalCount' =>$question_count, 'pageSize' => BaseModel::PAGE_SIZE]);
        if ($question_count>0){
            $question_list=$communityQuestionModel->getNewBest($list_where,$sort,$pagination);
        }
        $new_solve_list=$communityQuestionModel->getNewSolve();

        $main_count=[];
        $where_solve_yes_count=array_merge($list_where,['solve'=>CommunityQuestion::SOLVE_YES]);
        $where_solve_not_count=array_merge($list_where,['solve'=>CommunityQuestion::SOLVE_NOT]);
        $main_count['solve_yes_count']=$communityQuestionModel->getCountByMap($where_solve_yes_count);
        $main_count['solve_not_count']=$communityQuestionModel->getCountByMap($where_solve_not_count);
        return $this->render('index',[
            'question_list'=>$question_list,
            'tag_list'=>$tag_list,
            'pagination' => $pagination,
            'main_count'=>$main_count,
            'new_solve_list'=>$new_solve_list,
            'req'=>$req,
        ]);
    }

}
