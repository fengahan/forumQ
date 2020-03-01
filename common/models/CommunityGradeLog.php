<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%grade_log}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $level
 * @property int $is_node
 * @property int $technical
 * @property int $created_at
 */
class CommunityGradeLog extends \common\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%grade_log}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'level', 'technical', 'created_at'], 'required'],
            [['user_id', 'is_node', 'technical', 'created_at'], 'integer'],
            [['level'], 'string', 'max' => 32],
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
            'level' => 'Level',
            'is_node' => 'Is Node',
            'technical' => 'Technical',
            'created_at' => 'Created At',
        ];
    }
}
