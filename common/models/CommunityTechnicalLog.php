<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%technical_log}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $technical 0其他1问答2分享3专题4项目
 * @property int $from
 * @property int $created_at
 */
class CommunityTechnicalLog extends \common\models\BaseModel
{
    const FROM_OTH=0;
    const FROM_BEST_QES=1;
    const FROM_TECH=2;//分享
    const FROM_SUB=3;//专题
    const FROM_PROJECT=4;//项目

    public static $from_color=[self::FROM_OTH=>'#d066e2',
        self::FROM_BEST_QES=>"#ff6b68",
        self::FROM_TECH=>"#03A9F4",
        self::FROM_SUB=>"#f5c942",
        self::FROM_PROJECT=>"#32c787"
    ];
    public static $from_label=[self::FROM_OTH=>'其它',
        self::FROM_BEST_QES=>"最佳回答",
        self::FROM_TECH=>"技术分享",
        self::FROM_SUB=>"专题分享",
        self::FROM_PROJECT=>"项目Star"
    ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%technical_log}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'created_at'], 'required'],
            [['user_id', 'technical', 'from', 'created_at'], 'integer'],
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
            'technical' => '0其他1问答2分享3专题4项目',
            'from' => 'From',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @param $user_id
     * @return mixed
     */
    public function getUserTechGroupByForm($user_id)
    {
        $where['user_id']=$user_id;
        return self::find()->where($where)
            ->select('from,sum(technical) as total')
            ->asArray()
            ->groupBy("from")->all();
    }
}
