<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%community_articles_pay}}".
 *
 * @property int $id
 * @property int $article_id 文章ID
 * @property int $payment_user_id 付款用户id
 * @property int $receipt_user_id 收款用户id
 * @property int $integral 积分
 * @property int $status 0 正常 1 删除
 * @property int $created_time 创建时间
 * @property int $updated_time 更新时间
 */
class CommunityArticlesPay extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%community_articles_pay}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article_id', 'payment_user_id', 'receipt_user_id', 'integral', 'status', 'created_time', 'updated_time'], 'integer'],
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
            'payment_user_id' => '付款用户id',
            'receipt_user_id' => '收款用户id',
            'integral' => '积分',
            'status' => '0 正常 1 删除',
            'created_time' => '创建时间',
            'updated_time' => '更新时间',
        ];
    }
}
