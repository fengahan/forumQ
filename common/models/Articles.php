<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property int $id
 * @property string $title 标题
 * @property string $html_content html内容
 * @property string $markdown_content markdown内容
 * @property int $tag_id tag
 * @property int $user_id 用户Id
 * @property int $view_number 查看次数
 * @property int $reply_number 回复人数
 * @property int $status 关闭 开启 删除
 * @property int $created_at
 * @property int $updated_at 查看次数
 */
class Articles extends \yii\db\ActiveRecord
{
    const STATUS_NORMAL=10;
    const STATUS_CLOSE=20;
    const STATUS_DELETE=30;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%articles}}';
    }

    public function behaviors()
    {
        parent::behaviors();
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'html_content', 'markdown_content', 'tag_id', 'user_id'], 'required'],
            [['html_content', 'markdown_content'], 'string'],
            [['tag_id', 'user_id', 'view_number', 'reply_number', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'html_content' => 'html内容',
            'markdown_content' => 'markdown内容',
            'tag_id' => 'tag',
            'user_id' => '用户Id',
            'view_number' => '查看次数',
            'reply_number' => '回复人数',
            'status' => '关闭 开启 删除',
            'created_at' => 'Created At',
            'updated_at' => '查看次数',
        ];
    }
}
