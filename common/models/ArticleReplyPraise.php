<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%article_reply_praise}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $reply_id
 * @property int $created_at
 */
class ArticleReplyPraise extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%article_reply_praise}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'reply_id', 'created_at'], 'required'],
            [['user_id', 'reply_id', 'created_at'], 'integer'],
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
            'reply_id' => 'Reply ID',
            'created_at' => 'Created At',
        ];
    }

    public static function getRow($reply_id,$user_id)
    {

        return self::findOne(['user_id'=>$user_id,'reply_id'=>$reply_id]);

    }
}
