<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_sign}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $created_time 签到时间 如20201122
 * @property int $created_at
 */
class CommunityUserSign extends \common\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_sign}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'created_at'], 'integer'],
            [['created_time', 'created_at'], 'required'],
            [['created_time'], 'string', 'max' => 11],
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
            'created_time' => '签到时间 如20201122',
            'created_at' => 'Created At',
        ];
    }
}
