<?php
namespace frontend\controllers;

use common\models\CommunityUserLink;
use common\models\UploadImgForm;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\NotAcceptableHttpException;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class PublicController extends BaseController
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
                'backColor'=>0x000000,//背景颜色
                'maxLength' => 4, //最大显示个数
                'minLength' => 4,//最少显示个数
                'padding' => 5,//间距
                'height'=>45,//高度
                'width' => 75,  //宽度
                'foreColor'=>0xffffff,     //字体颜色
                'offset'=>4,
            ],
        ];
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $this->layout = 'layout';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post(),"") && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    /**
     * Signs user up.
     *
     * @return mixed
     * @throws NotAcceptableHttpException
     */
    public function actionSignup()
    {
        $this->layout = 'layout';
        if (!Yii::$app->request->isAjax){
            throw new NotAcceptableHttpException();
        }
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post(),'') && $model->signup()) {
            return $this->formatJson(100,"注册成功请登录",['url'=>Url::to("public/login")]);
        }else{
            $error=$model->getErrorSummary(false)[0]??"非法错误";
            return $this->formatJson(200,$error,['url'=>Url::to("public/login")]);
        }


    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {


        $send_count=Yii::$app->cache->get("send_reset_password_token_count".date("Ymd"));
        if ($send_count>3){
            return $this->formatJson(200,"今天无法再次使用找回密码功能,请明天再试",[]);
        }

        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post(),'') && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->cache->set("send_reset_password_token_count".date("Ymd"),$send_count+1);
                return $this->formatJson(100,"邮件发送成功",[]);
            } else {
                return $this->formatJson(200,"邮件发送失败",[]);
            }
        }

    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        $this->layout = 'layout';
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            if (Yii::$app->request->isAjax){
                throw new BadRequestHttpException($e->getMessage());
            }
            else{
                return $this->formatJson(200,"token已过期,请重新进行邮箱验证",[]);
            }
        }
        if (Yii::$app->request->isAjax){
            if ($model->load(Yii::$app->request->post(),'') && $model->validate() && $model->resetPassword()) {
                return $this->formatJson(100,"重置密码成功",['url'=>Url::to(['/public/login'])]);
            }else{
                return $this->formatJson(200,"重置密码失败",[]);
            }
        }
        return $this->render('resetPassword', [
            'model' => $model,
        ]);


    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }

    public function actionUploadImg()
    {

        $model = new UploadImgForm();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstanceByName('editormd-image-file');
            $file=$model->upload();
            if ($file) {
                $data=['success'=>1,'message'=>'上传成功','url'=>$file];
            }else{
                $data=['success'=>0,'message'=>'上传失败'.$model->getErrorSummary(false)[0]];
            }
            return $this->asJson($data);
        }


    }


    public function actionShowIcons()
    {
        $this->layout='main';
      return  $this->render('icons');
    }

    /**
     * @return \yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionUserLinkJump()
    {
        $link_id=(int)Yii::$app->request->get("id");
        if (!empty($link_id)){
            $link=CommunityUserLink::findOne($link_id);
            if (!empty($link)){
                $link->updateCounters(['click_number'=>1]);
                $link->save();
               return $this->redirect($link->href);
            }
        }
        throw new BadRequestHttpException("链接找不到了");

    }
}
