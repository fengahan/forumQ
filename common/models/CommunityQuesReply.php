<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "communtiy_ques_reply".
 *
 * @property int $id
 * @property int $user_id  
 * @property int $ques_id  
 * @property int $ques_user_id
 * @property string $reply_html_content
 * @property string $reply_markdown_content
 * @property int $is_best
 * @property int $parent_id
 * @property int $status
 * @property int $created_at
 */
class CommunityQuesReply extends \yii\db\ActiveRecord
{

    const STATUS_NORMAL=10;
    const STATUS_DELETE=20;

    const BEST_YES=10;
    const BEST_NO=20;


        /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'community_ques_reply';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'ques_id', 'ques_user_id', 'reply_html_content', 'reply_markdown_content'], 'required'],
            [['user_id', 'ques_id', 'ques_user_id', 'is_best', 'parent_id', 'status', 'created_at'], 'integer'],
            [['reply_html_content', 'reply_markdown_content'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'ques_id' => 'Ques ID',
            'ques_user_id' => 'Ques User ID',
            'reply_html_content' => 'Reply Html Content',
            'reply_markdown_content' => 'Reply Markdown Content',
            'is_best' => 'Is Best',
            'parent_id' => 'Parent ID',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    public function getReplyList($question_id)
    {

        return self::find()
            ->select("qp.*,u.nickname,u.avatar,u.id as u_id,u.type")
            ->from(self::tableName(). ' as qp')
            ->leftJoin(CommunityUsers::tableName(). " as u",'u.id=qp.user_id')
            ->where(['qp.ques_id'=>$question_id,'qp.status'=>self::STATUS_NORMAL])
            ->asArray()->all();
    }

    public static function getReplyInfo($id)
    {
        return self::find()
            ->select("qp.*,u.nickname,u.avatar,u.id as u_id,u.type")
            ->from(self::tableName(). ' as qp')
            ->leftJoin(CommunityUsers::tableName(). " as u",'u.id=qp.user_id')
            ->where(['qp.id'=>$id,'qp.status'=>self::STATUS_NORMAL])
            ->asArray()->one();


    }
}
