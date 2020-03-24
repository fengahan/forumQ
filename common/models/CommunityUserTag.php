<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_tag}}".
 *
 * @property int $id id
 * @property int $user_id 用户id
 * @property int $integral
 * @property int $tag_id 标签id
 * @property int $status 10正常 20删除 30未开放
 * @property int $updated_time 修改时间
 * @property int $created_time 创建时间
 */
class CommunityUserTag extends \common\models\BaseModel
{
    const STATUS_NORMAL=10;
    const STATUS_DELETE=20;
    const STATUS_CLOSE=30;

    const DEFAULT_LEVEL=10;
    const LEVEL=[10=>"小白",20=>"初级",30=>"中级",40=>"高级"];
    const LEVEL_ING=[10=>0,20=>400,30=>8000,40=>24000];
    const LEVEL_STYLE_COLOR=[10=>'#747a80',20=>'#f5c942',30=>'#3af51b',40=>'#f51914'];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_tag}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'integral', 'tag_id', 'status', 'updated_time', 'created_time'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'user_id' => '用户id',
            'integral' => 'Integral',
            'tag_id' => '标签id',
            'status' => '10正常 20删除 30未开放',
            'updated_time' => '修改时间',
            'created_time' => '创建时间',
        ];
    }
    public function getUserTag($user_id)
    {
        return self::find()->alias("ut")
            ->select('ut.*,t.title')
            ->leftJoin(CommunityTag::tableName()."as t",'t.id=ut.tag_id')
            ->where(['ut.status'=>self::STATUS_NORMAL,'ut.user_id'=>$user_id])
            ->asArray()->all();

    }
}
