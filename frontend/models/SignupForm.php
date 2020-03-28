<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $nickname;
    public $confirm_password;
    public $rememberMe = false;
    public $verify_code;
    private $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => '邮箱已经注册过会员,无法重复使用.'],
            ['confirm_password','required'],
            ['nickname', 'trim'],
            ['nickname', 'required'],
            ['nickname', 'string', 'max' => 6],
            ['nickname', 'unique', 'targetClass' => '\common\models\User', 'message' => '昵称已经被占用'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['verify_code','required'],
            ['verify_code','captcha','captchaAction'=>'public/captcha'],
        ];
    }



    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->email = $this->email;
        $user->nickname=$this->nickname;
        $user->setPassword($this->password);
        $user->status=User::STATUS_ACTIVE;
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        return $user->save() ;
        //&& $this->sendEmail($user);

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();

    }
}
