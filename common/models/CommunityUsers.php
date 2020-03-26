<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%users}}".
 *
 * @property int $id 用户id
 * @property string $self_signature 个性签名
 * @property string $user_token 用户token
 * @property string $email email地址
 * @property string $password 用户密码
 * @property string $phone 联系电话
 * @property string $wechat 微信号
 * @property string $qq qq
 * @property string $nickname 昵称
 * @property int $birthday 生日
 * @property string $avatar 头像图
 * @property int $gender 性别【0 未知 1 男 2 女】
 * @property string $province 省份
 * @property string $city 城市
 * @property string $country 县区
 * @property string $company 公司
 * @property string $direction_tags json用户技能类型标签
 * @property int $integral 积分
 * @property string $balance 余额
 * @property int $type 用户类型【0 普通用户 1 邀请码用户】
 * @property int $origin 用户来源【0 官网注册 1 GitHub 授权】
 * @property int $status 状态【0：正常用户，1 黑名单，2 用户被删除】
 * @property int $last_time 最后登陆时间
 * @property int $update_time 修改时间
 * @property int $technical 技能点
 * @property int $add_time 注册时间
 */
class CommunityUsers extends \yii\db\ActiveRecord
{
    const TYPE_NORMAL=10;
    const TYPE_FROM_CODE=20;
    const TYPE=[self::TYPE_NORMAL=>"普通用户",self::TYPE_FROM_CODE=>"大咖"];
    const LEVEL_MECHANISM=['T1'=>0,"T2"=>3000,"T3"=>6000,"T4"=>12000,"T5"=>24000,"T6"=>48000];
    const LEVEL_COLL=["T1","T2","T3","T4","T5","T6"];

    const GENDER_PRIVATE=0;
    const GENDER_MAN=1;
    const GENDER_WOMAN=2;
    const GENDER_STYLE=[self::GENDER_PRIVATE=>"",self::GENDER_MAN=>"sex_img_man",self::GENDER_WOMAN=>"sex_img_woman"];

    const SCENARIO_UPDATE_PROFILE= 'update_profile';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['qq', 'birthday', 'gender', 'integral', 'type', 'origin', 'status', 'last_time', 'updated_at', 'created_at'], 'integer'],
            [['balance'], 'number'],
            [['email'], 'string', 'max' => 40],
            [['password'], 'string', 'max' => 65],
            [['phone', 'wechat'], 'string', 'max' => 20],
            [['nickname'], 'string', 'max' => 100],
            [['avatar', 'province', 'city','self_signature', 'country', 'company', 'direction_tags'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '用户id',
            'user_token' => '用户token',
            'email' => 'email地址',
            'password' => '用户密码',
            'phone' => '联系电话',
            'wechat' => '微信号',
            'qq' => 'qq',
            'nickname' => '昵称',
            'birthday' => '生日',
            'avatar' => '头像图',
            'gender' => '性别【0 未知 1 男 2 女】',
            'province' => '省份',
            'city' => '城市',
            'country' => '县区',
            'company' => '公司',
            'direction_tags' => 'json用户技能类型标签',
            'integral' => '积分',
            'balance' => '余额',
            'type' => '用户类型【0 普通用户 1 邀请码用户】',
            'origin' => '用户来源【0 官网注册 1 GitHub 授权】',
            'status' => '状态【0：正常用户，1 黑名单，2 用户被删除】',
            'last_time' => '最后登陆时间',
            'updated_at' => '修改时间',
            'created_at' => '注册时间',
        ];
    }
    public function scenarios()
    {
        $scenarios=parent::scenarios();
        $scenarios[self::SCENARIO_UPDATE_PROFILE]=['gender', 'self_signature'];
        return $scenarios;
    }
    /***
     * @param int $user_id
     * @return array
     */
    public function getUserInfo($user_id)
    {
        return self::find()->where(['id'=>$user_id])->asArray()->one();
    }
}
