<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property int $id
 * @property string $title 标题
 * @property string $html_content html内容
 * @property string $markdown_content markdown内容
 * @property int $tag_id tag
 * @property int $user_id 用户Id
 * @property int $view_number 查看次数
 * @property int $reply_number 回复人数
 * @property int $status 关闭 开启 删除
 * @property int $created_at
 * @property int $updated_at 查看次数
 */
class Articles extends \yii\db\ActiveRecord
{
    const STATUS_NORMAL=10;
    const STATUS_CLOSE=20;
    const STATUS_DELETE=30;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%articles}}';
    }

    public function behaviors()
    {
        parent::behaviors();
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'html_content', 'markdown_content', 'tag_id', 'user_id'], 'required'],
            [['html_content', 'markdown_content'], 'string'],
            [['tag_id', 'user_id', 'view_number', 'reply_number', 'status','get_heart', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'html_content' => 'html内容',
            'markdown_content' => 'markdown内容',
            'tag_id' => 'tag',
            'user_id' => '用户Id',
            'view_number' => '查看次数',
            'reply_number' => '回复人数',
            'status' => '关闭 开启 删除',
            'created_at' => 'Created At',
            'updated_at' => '查看次数',
        ];
    }


    public function getUserArticle($user_id,$status,$pagination)
    {
        $where['a.status']=$status;
        $where['a.user_id']=$user_id;
        $query=  self::find()->select("a.id,a.title,a.reply_number,a.view_number,a.get_heart,a.created_at,a.status,
        u.avatar,u.nickname,u.email,u.type,u.self_signature")->from(self::tableName(). "as a")
            ->leftJoin(CommunityUsers::tableName(). "as u",'u.id=a.user_id')
            ->leftJoin(CommunityTag::tableName() . "as t",'t.id=a.tag_id')
            ->where($where);
        return $query->offset($pagination->offset)
            ->limit($pagination->limit)->orderBy('a.id desc')->asArray()->all();

    }

    public function getUserArtCount($user_id,$status)
    {
        $where['status']=$status;
        return self::find()
            ->where(['user_id'=>$user_id])
            ->andWhere($where)
            ->count();

    }


    public function getArtContent($id)
    {
        return self::find()->alias("a")
            ->select("a.*,u.avatar,u.nickname")
            ->leftJoin(CommunityUsers::tableName()." as u","u.id=a.user_id")
            ->where(['a.id'=>$id])->asArray()->one();

    }


    public function getIndexList($list_where,$pagination)
    {
        $where['a.status']=self::STATUS_NORMAL;
        if (!empty($tag_id)){
            $where['a.tag_id']=$tag_id;
        }
        $order_by='created_at desc';

        $query= self::find()->select("a.id,a.title,a.reply_number,a.view_number,a.created_at,a.get_heart,a.tag_id,
        u.avatar,u.nickname,u.email,u.type,u.self_signature")->from(self::tableName(). "as a")
            ->leftJoin(CommunityUsers::tableName(). "as u",'u.id=a.user_id')
            ->leftJoin(CommunityTag::tableName() . "as t",'t.id=a.tag_id')
            ->where($where);
        if (!empty($list_where['search_word'])){
            $query->andFilterWhere(['like','a.title',$list_where['search_word']]);
        }
        return $query->offset($pagination->offset)
            ->limit($pagination->limit)->orderBy($order_by)->asArray()->all();
    }

    public function getIndexCount($list_where)
    {
        $where['a.status']=self::STATUS_NORMAL;
        if (!empty($list_where['tag_id'])){
            $where['a.tag_id']=$list_where['tag_id'];
        }
        $query= self::find()->select("a.id,a.title,a.reply_number,a.view_number,a.created_at,a.get_heart,a.tag_id,
        u.avatar,u.nickname,u.email,u.type,u.self_signature")->from(self::tableName(). "as a")
            ->leftJoin(CommunityUsers::tableName(). "as u",'u.id=a.user_id')
            ->leftJoin(CommunityTag::tableName() . "as t",'t.id=a.tag_id')
            ->where($where);
        if (!empty($list_where['search_word'])){
            $query->andFilterWhere(['like','a.title',$list_where['search_word']]);
        }
        return $query->asArray()->count();

    }


    public function getHot()
    {
        $where['a.status']=self::STATUS_NORMAL;
        $query= self::find()->select("a.id,a.title,a.reply_number,a.view_number,a.created_at,a.get_heart,a.tag_id,
        u.avatar,u.nickname,u.email,u.type,u.self_signature")->from(self::tableName(). "as a")
            ->leftJoin(CommunityUsers::tableName(). "as u",'u.id=a.user_id')
            ->leftJoin(CommunityTag::tableName() . "as t",'t.id=a.tag_id')
            ->where($where)->andWhere(['>','a.created_at',strtotime(date('Y-m-01', strtotime(date("Y-m-d"))))]);
        if (!empty($list_where['search_word'])){
            $query->andFilterWhere(['like','a.title',$list_where['search_word']]);
        }
        return $query->orderBy('get_heart desc,created_at desc')->asArray()->all();
    }

}
