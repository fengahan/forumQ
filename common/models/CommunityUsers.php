<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%community_users}}".
 *
 * @property int $id 用户id
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
 * @property int $add_time 注册时间
 */
class CommunityUsers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%community_users}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['qq', 'birthday', 'gender', 'integral', 'type', 'origin', 'status', 'last_time', 'update_time', 'add_time'], 'integer'],
            [['balance'], 'number'],
            [['user_token'], 'string', 'max' => 120],
            [['email'], 'string', 'max' => 40],
            [['password'], 'string', 'max' => 65],
            [['phone', 'wechat'], 'string', 'max' => 20],
            [['nickname'], 'string', 'max' => 100],
            [['avatar', 'province', 'city', 'country', 'company', 'direction_tags'], 'string', 'max' => 255],
            [['user_token'], 'unique'],
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
            'update_time' => '修改时间',
            'add_time' => '注册时间',
        ];
    }
}
