<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_integral}}".
 *
 * @property int $id
 * @property int $payment_user_id 付款用户id
 * @property int $receipt_user_id 收款用户id
 * @property int $type 1 评论回答被采纳 2 文章付费
 * @property int $origin_id 采纳，付费等等 id
 * @property int $before_integral 之前积分
 * @property int $current_integral 当前积分
 * @property int $integral 积分数量 【有加减】
 * @property int $status 0 正常  1删除
 * @property int $created_time 开始时间
 * @property int $updated_time 更新时间
 */
class CommunityUserIntegral extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_integral}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['payment_user_id', 'receipt_user_id', 'type', 'origin_id', 'before_integral', 'current_integral', 'integral', 'status', 'created_time', 'updated_time'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payment_user_id' => '付款用户id',
            'receipt_user_id' => '收款用户id',
            'type' => '1 评论回答被采纳 2 文章付费',
            'origin_id' => '采纳，付费等等 id',
            'before_integral' => '之前积分',
            'current_integral' => '当前积分',
            'integral' => '积分数量 【有加减】',
            'status' => '0 正常  1删除',
            'created_time' => '开始时间',
            'updated_time' => '更新时间',
        ];
    }
}
