<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%community_article_praise}}".
 *
 * @property int $id 被点赞表id
 * @property int $type 1 文章 2 评论 3 用户点赞用户
 * @property int $user_id 点赞用户ID
 * @property int $praise_user_id 被点赞用户ID
 * @property int $article_id 被点赞ID
 * @property int $status 0 删除点赞 1 取消点赞 2 点赞未读 3 点赞已读
 * @property int $created_time 点赞时间
 * @property int $updated_time 更新时间
 */
class CommunityArticlePraise extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%community_article_praise}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'user_id', 'praise_user_id', 'article_id', 'status', 'created_time', 'updated_time'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '被点赞表id',
            'type' => '1 文章 2 评论 3 用户点赞用户',
            'user_id' => '点赞用户ID',
            'praise_user_id' => '被点赞用户ID',
            'article_id' => '被点赞ID',
            'status' => '0 删除点赞 1 取消点赞 2 点赞未读 3 点赞已读',
            'created_time' => '点赞时间',
            'updated_time' => '更新时间',
        ];
    }
}
