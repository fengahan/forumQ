<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%ques_subscribe}}".
 *
 * @property int $id
 * @property int $ques_id
 * @property int $user_id
 * @property int $create_at
 */
class QuesSubscribe extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ques_subscribe}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ques_id', 'user_id', 'create_at'], 'required'],
            [['ques_id', 'user_id', 'create_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ques_id' => '问题ID',
            'user_id' => '用户ID',
            'create_at' => '创建时间',
        ];
    }
}
