<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%articles_praise}}".
 *
 * @property int $id 被点赞表id
 * @property int $user_id 点赞用户ID
 * @property int $praise_user_id 被点赞用户ID
 * @property int $article_id 被点赞ID
 * @property int $status 1正常2无效
 * @property int $created_at 点赞时间
 * @property int $updated_at 更新时间
 */
class ArticlesPraise extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%articles_praise}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'praise_user_id','article_id', 'status', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '被点赞表id',
            'user_id' => '点赞用户ID',
            'praise_user_id' => '被点赞用户ID',
            'article_id' => '被点赞ID',
            'status' => '1正常2无效',
            'created_at' => '点赞时间',
            'updated_at' => '更新时间',
        ];
    }
}
