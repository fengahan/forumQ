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
 * @property string url
 */
class UserMessage extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    const STATUS_NORMAL=10;
    const STATUS_READ=20;
    const STATUS_DELETE=30;

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
            [['content','url'], 'string', 'max' => 255],
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

    public function getUserMessage($user_id,$status,$pagination)
    {
        $where['status']=$status;
        return self::find()
            ->where('user_id='.$user_id)
            ->andWhere($where)
           ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy('id desc')
            ->asArray()
            ->all();

    }


    public static function getUnRead($user_id)
    {
        $where['status']=self::STATUS_NORMAL;
        return self::find()
            ->where('user_id='.$user_id)
            ->andWhere($where)
            ->limit("5")
            ->orderBy('id desc')
            ->asArray()
            ->all();
    }
}
