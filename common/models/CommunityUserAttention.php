<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%community_user_attention}}".
 *
 * @property int $id
 * @property int $user_id 用户ID
 * @property int $attention_user_id 被关注用户ID
 * @property int $status 0 删除关注 1 取消关注 2 关注未读 3 关注已读
 * @property int $created_time 关注开始时间
 * @property int $updated_time 关注更新时间
 */
class CommunityUserAttention extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%community_user_attention}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'attention_user_id', 'status', 'created_time', 'updated_time'], 'integer'],
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
            'attention_user_id' => '被关注用户ID',
            'status' => '0 删除关注 1 取消关注 2 关注未读 3 关注已读',
            'created_time' => '关注开始时间',
            'updated_time' => '关注更新时间',
        ];
    }
}
