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

    /**
     * @param int $user_id
     * @return array
     */
    public function getUserProgress($user_id)
    {
        $where['user_id']=$user_id;
        return self::find()->where($where)
            ->orderBy('technical asc')
            ->asArray()
            ->all();
    }

    /**
     *
     * @param $incr 此次加的点数
     * @param $user_technical
     */
    public function UpUserGrade($user_technical,$user_id)
    {

        //最大等级
        $max_grade=self::find()->where(['user_id'=>$user_id])->orderBy('technical desc')->asArray()->one();
        $grade=CommunityUsers::LEVEL_MECHANISM;
        $n="";
        foreach ($grade as $key=>$value){
            if ($user_technical<$value){
                return $n;
            }
        }
        if (empty($n)){
            Yii::error("严重错误".json_encode(func_get_args()));
        }
        $this->user_id=$user_id;
        $this->created_at=time();
        if (empty($max_grade)){
            $this->technical=0;
            $this->level=CommunityUsers::LEVEL_COLL[0];
            $this->save();
        }else if (!empty($max_grade) && $n!=$grade['level']){
            $this->technical=$user_technical;
            $this->level=$n;
            $this->save();
        }
    }
}
