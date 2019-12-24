<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%question}}".
 *
 * @property int $id
 * @property string $title 标题
 * @property string $html_content html内容
 * @property string $markdown_content markdown内容
 * @property int $is_public 获得最佳答案时是否免费公开
 * @property int $tag_id tag
 * @property int $money 赏金
 * @property int $user_id 用户Id
 * @property int $user_identity 10  普通 20 大咖
 * @property int $view_number
 * @property int $subscribe_numer 订阅人数
 * @property int $reply_number 回复人数
 * @property int $is_solve 是否解决10 ok 20 not
 * @property int $status 关闭 开启 删除
 * @property int $created_at
 * @property int $updated_at 查看次数
 */
class CommunityQuestion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%question}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'tag_id', 'money', 'user_id', 'view_number', 'created_at'], 'required'],
            [['html_content', 'markdown_content'], 'string'],
            [['is_public', 'tag_id', 'money', 'user_id', 'user_identity', 'view_number', 'subscribe_numer', 'reply_number', 'is_solve', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'html_content' => 'html内容',
            'markdown_content' => 'markdown内容',
            'is_public' => '获得最佳答案时是否免费公开',
            'tag_id' => 'tag',
            'money' => '赏金',
            'user_id' => '用户Id',
            'user_identity' => '10  普通 20 大咖',
            'view_number' => 'View Number',
            'subscribe_numer' => '订阅人数',
            'reply_number' => '回复人数',
            'is_solve' => '是否解决10 ok 20 not',
            'status' => '关闭 开启 删除',
            'created_at' => 'Created At',
            'updated_at' => '查看次数',
        ];
    }
}
