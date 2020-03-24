<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_link}}".
 *
 * @property int $id
 * @property string $name
 * @property string $icon
 * @property string $color
 * @property int $user_id
 * @property string $href
 * @property int $status 10 显示 20 隐藏 30 删除
 * @property int $click_number 点击次数
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 */
class CommunityUserLink extends \common\models\BaseModel
{
    const STATUS_NORMAL=10;
    const STATUS_DELETE=20;
    const STATUS_CLOSE=30;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_link}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'name', 'icon', 'color', 'href'], 'required'],
            ['icon', 'in', 'range' =>$this->parseIcon()],
            ['icon', 'filter', 'filter' => [$this, 'handlerIcon']],
            ['href', 'url', 'defaultScheme' => 'http'],
            [['id', 'user_id', 'status', 'click_number', 'created_at', 'updated_at'], 'integer'],
            [['name', 'icon', 'color', 'href'], 'string', 'max' => 255],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'icon' => 'Icon',
            'color' => 'Color',
            'user_id' => 'User ID',
            'href' => 'Href',
            'status' => '10 显示 20 隐藏 30 删除',
            'click_number' => '点击次数',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    public function handlerIcon($value)
    {

        return 'zmdi-'.trim($value);
    }
    public function getUserLink($where)
    {
        return self::find()->where(['user_id'=>$where['user_id']])
            ->where(['in','status',$where['status']])->all();


    }


    public function parseIcon(){
       $icon= Yii::$app->cache->get("icon_list");
       if (!empty($icon)){
           return $icon;
       }
        $file = fopen("icon_content", "r");
        $icon=array();
        $i=0;
        while(! feof($file))
        {
            $icon[$i]= trim(fgets($file));
            $i++;
        }
        fclose($file);
        $icon=array_filter($icon);
        Yii::$app->cache->set("icon_list",$icon);

        return $icon;
    }
}
