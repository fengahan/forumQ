<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%community_articles_reply}}".
 *
 * @property int $id
 * @property int $article_id 文章ID
 * @property int $parent_id 上一个评论Id为0回复文章
 * @property int $user_id 用户id
 * @property string $content 回复内容
 * @property int $praise_nums 点赞数量
 * @property int $is_adoption 是否采纳 1 采纳 可以采纳多个当要付多份金额
 * @property int $status 0 正常 1 删除 2 付费问答只有付费者和回答者可见
 * @property int $created_time 创建时间
 * @property int $updated_time 更新时间
 */
class CommunityArticlesReply extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%community_articles_reply}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article_id', 'parent_id', 'user_id', 'praise_nums', 'is_adoption', 'status', 'created_time', 'updated_time'], 'integer'],
            [['content'], 'required'],
            [['content'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_id' => '文章ID',
            'parent_id' => '上一个评论Id为0回复文章',
            'user_id' => '用户id',
            'content' => '回复内容',
            'praise_nums' => '点赞数量',
            'is_adoption' => '是否采纳 1 采纳 可以采纳多个当要付多份金额',
            'status' => '0 正常 1 删除 2 付费问答只有付费者和回答者可见',
            'created_time' => '创建时间',
            'updated_time' => '更新时间',
        ];
    }
}
