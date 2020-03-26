<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_message}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $content
 * @property int $status 10未读20已读30已删除
 * @property int $created_at
 * @property int $read_time
 */
class UserMessage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_message}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'status', 'created_at', 'read_time'], 'integer'],
            [['content'], 'string', 'max' => 255],
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
            'content' => 'Content',
            'status' => '10未读20已读30已删除',
            'created_at' => 'Created At',
            'read_time' => 'Read Time',
        ];
    }
}
