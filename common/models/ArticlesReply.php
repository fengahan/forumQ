<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%articles_reply}}".
 *
 * @property int $id
 * @property int $article_id 文章ID
 * @property int $parent_id 上一个评论Id为0回复文章
 * @property int $user_id 用户id
 * @property string $html_content 回复内容
 * @property int $praise_nums 点赞数量
 * @property int $status 0 正常 1 删除 
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 * @property string $markdown_content
 * @property int $article_user_id
 */
class ArticlesReply extends \yii\db\ActiveRecord
{

    const STATUS_NORMAL=10;
    const STATUS_DELETE=20;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%articles_reply}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article_id', 'user_id','article_user_id', 'status', 'created_at', 'updated_at'], 'required'],
            ['parent_id','default','value'=>0],
            [['article_id', 'parent_id', 'user_id', 'praise_nums','article_user_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['html_content', 'markdown_content'], 'required'],
            [['html_content', 'markdown_content'], 'string'],
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
            'html_content' => '回复内容',
            'praise_nums' => '点赞数量',
            'status' => '0 正常 1 删除 ',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'markdown_content' => 'Markdown Content',
        ];
    }
    public function getReplyList($article_id)
    {

        return self::find()
            ->select("ap.*,u.nickname,u.avatar,u.id as u_id,u.type")
            ->from(self::tableName(). ' as ap')
            ->leftJoin(CommunityUsers::tableName(). " as u",'u.id=ap.user_id')
            ->where(['ap.article_id'=>$article_id,'ap.status'=>self::STATUS_NORMAL])
            ->orderBy('id desc')
            ->asArray()->all();
    }

    public static function getReplyInfo($id)
    {
        return self::find()
            ->select("ap.*,u.nickname,u.avatar,u.id as u_id,u.type")
            ->from(self::tableName(). ' as ap')
            ->leftJoin(CommunityUsers::tableName(). " as u",'u.id=ap.user_id')
            ->where(['ap.id'=>$id,'ap.status'=>self::STATUS_NORMAL])
            ->asArray()->one();


    }
}
