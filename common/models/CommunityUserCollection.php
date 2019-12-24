<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_collection}}".
 *
 * @property int $id
 * @property int $user_id 用户ID
 * @property int $type 1 文章 2 评论
 * @property int $collection_user_id 被收藏用户ID
 * @property int $article_id 文章ID
 * @property int $status 0 正常  1删除
 * @property int $created_time 收藏开始时间
 * @property int $updated_time 收藏更新时间
 */
class CommunityUserCollection extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_collection}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'type', 'collection_user_id', 'article_id', 'status', 'created_time', 'updated_time'], 'integer'],
            [['article_id'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户ID',
            'type' => '1 文章 2 评论',
            'collection_user_id' => '被收藏用户ID',
            'article_id' => '文章ID',
            'status' => '0 正常  1删除',
            'created_time' => '收藏开始时间',
            'updated_time' => '收藏更新时间',
        ];
    }
}
