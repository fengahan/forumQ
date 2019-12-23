<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%community_tag_map}}".
 *
 * @property int $id id
 * @property int $type 标签类型【1 技能类型标签，2 文章行业类型标签，3 文章属性类型标签】
 * @property int $user_id 用户id
 * @property int $tag_id 标签id
 * @property int $status 0正常 1删除 2未开放
 * @property int $updated_time 修改时间
 * @property int $created_time 创建时间
 */
class CommunityTagMap extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%community_tag_map}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'user_id', 'tag_id', 'status', 'updated_time', 'created_time'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'type' => '标签类型【1 技能类型标签，2 文章行业类型标签，3 文章属性类型标签】',
            'user_id' => '用户id',
            'tag_id' => '标签id',
            'status' => '0正常 1删除 2未开放',
            'updated_time' => '修改时间',
            'created_time' => '创建时间',
        ];
    }
}
