<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tag}}".
 *
 * @property int $id 标签表id
 * @property int $type 标签类型【1 技能类型标签，2 文章行业类型标签，3 文章属性类型标签】
 * @property int $creator 标签创建者【0 系统，】
 * @property string $title 标签名称
 * @property string $color 颜色
 * @property int $status 0正常 1删除 2未开放
 * @property int $updated_time 修改时间
 * @property int $created_time 创建时间
 */
class CommunityTag extends \yii\db\ActiveRecord
{
    const STATUS_NORMAL=10;
    const STATUS_DELETE=20;
    const STATUS_CLOSE=30;

    const TYPE_SKILLS=1;
    const TYPE_TRADE=2;
    const TYPE_ATTR=3;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tag}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'creator', 'status', 'updated_time', 'created_time'], 'integer'],
            [['title'], 'required'],
            [['title'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '标签表id',
            'type' => '标签类型【1 技能类型标签，2 文章行业类型标签，3 文章属性类型标签】',
            'creator' => '标签创建者【0 系统，】',
            'title' => '标签名称',
            'color' => '颜色',
            'status' => '0正常 1删除 2未开放',
            'updated_time' => '修改时间',
            'created_time' => '创建时间',
        ];
    }

    public function getList($where)
    {
        return self::find()->where($where)->asArray()->all();
    }
}
