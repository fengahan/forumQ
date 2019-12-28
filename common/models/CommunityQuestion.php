<?php

namespace common\models;

use phpDocumentor\Reflection\Types\Self_;
use Yii;
use yii\base\Arrayable;
use yii\data\Pagination;

/**
 * This is the model class for table "{{%question}}".
 *
 * @property int $id
 * @property string last_reply_nickname
 * @property int last_reply_at
 * @property string $title 标题
 * @property string $html_content html内容
 * @property string $markdown_content markdown内容
 * @property int $best_reply_id 最佳评论Id
 * @property int $is_public 获得最佳答案时是否免费公开
 * @property int $tag_id tag
 * @property int $money 赏金
 * @property int $user_id 用户Id
 * @property int $user_identity 10  普通 20 大咖
 * @property int $view_number
 * @property int $subscribe_number 订阅人数
 * @property int $reply_number 回复人数
 * @property int $is_solve 是否解决10 ok 20 not
 * @property int $status 关闭 开启 删除
 * @property int $created_at
 * @property int $updated_at 查看次数
 * @property int $best_reply_at 最佳答案采纳时间
 */
class CommunityQuestion extends \yii\db\ActiveRecord
{
    const STATUS_NORMAL=10;
    const STATUS_CLOSE=20;
    const STATUS_DELETE=30;

    const SOLVE_YES=10;
    const SOLVE_NOT=20;

    const PUBLIC_YES=10;
    const PUBLIC_NOT=20;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%question}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'tag_id', 'money', 'user_id', 'view_number', 'created_at'], 'required'],
            [['html_content', 'markdown_content','last_reply_nickname'], 'string'],
            [['is_public','best_reply_id', 'tag_id', 'money', 'user_id', 'user_identity', 'view_number', 'subscribe_number', 'reply_number', 'is_solve', 'status', 'created_at', 'updated_at','last_reply_at'], 'integer'],
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
            'is_public' => '获得最佳答案时是否免费公开',
            'tag_id' => 'tag',
            'money' => '赏金',
            'user_id' => '用户Id',
            'best_reply_id'=>"最佳评论ID",
            'user_identity' => '10  普通 20 大咖',
            'view_number' => 'View Number',
            'subscribe_number' => '订阅人数',
            'reply_number' => '回复人数',
            'is_solve' => '是否解决10 ok 20 not',
            'status' => '关闭 开启 删除',
            'created_at' => 'Created At',
            'updated_at' => '查看次数',
        ];
    }

    /**
     * 获取最新解决的问题
     * @param $list_where
     * @param $sort
     * @param $pagination Pagination
     * @return array
     */
    public function getNewBest($list_where,$sort,$pagination)
    {

        $where['q.status']=self::STATUS_NORMAL;
        $where['q.is_solve']=$list_where['solve'];
        if (!empty($tag_id)){
            $where['q.tag_id']=$tag_id;
        }
        if (!empty($list_where['is_public'])){
            $where['q.is_public']=$list_where['is_public'];
        }
        $order_by='created_at desc';
        if ($sort!='created_at'){
            $order_by='last_reply_at desc';
        }
        $query=  self::find()->select("q.title,q.reply_number,q.view_number,q.money,q.created_at,q.last_reply_nickname,q.last_reply_at,
        u.avatar,u.nickname,u.email,u.type,u.self_signature")->from(CommunityQuestion::tableName(). "as q")
            ->leftJoin(CommunityUsers::tableName(). "as u",'u.id=q.user_id')
            ->leftJoin(CommunityTag::tableName() . "as t",'t.id=q.tag_id')
            ->where($where);
        if (!empty($list_where['search_word'])){
            $query->andFilterWhere(['like','q.title',$list_where['search_word']]);
        }
        return $query->offset($pagination->offset)
        ->limit($pagination->limit)->orderBy($order_by)->asArray()->all();
    }
    public function getNewBestCount($list_where)
    {
        $where['q.status']=self::STATUS_NORMAL;
        $where['q.is_solve']=$list_where['solve'];
        if (!empty($list_where['tag_id'])){
            $where['q.tag_id']=$list_where['tag_id'];
        }
        if (!empty($list_where['is_public'])){
            $where['q.is_public']=$list_where['is_public'];
        }

        $query= self::find()->select("q.title,q.reply_number,q.view_number,q.money,q.created_at,q.last_reply_nickname,q.last_reply_at,
        u.avatar,u.nickname,u.email,u.type,u.self_signature")->from(CommunityQuestion::tableName(). "as q")
            ->leftJoin(CommunityUsers::tableName(). "as u",'u.id=q.user_id')
            ->leftJoin(CommunityTag::tableName() . "as t",'t.id=q.tag_id')
            ->where($where);
        if (!empty($list_where['search_word'])){
            $query->andFilterWhere(['like','q.title',$list_where['search_word']]);
        }
        return $query->asArray()->count();

    }
    public function getCountByMap($list_where)
    {
        $where['status']=self::STATUS_NORMAL;
        $where['is_solve']=$list_where['solve'];
        if (!empty($list_where['tag_id'])){
            $where['tag_id']=$list_where['tag_id'];
        }
        if (!empty($list_where['is_public'])){
            $where['is_public']=$list_where['is_public'];
        }
        $query=self::find()->where($where);
        if (!empty($list_where['search_word'])){
            $query->andFilterWhere(['like','title',$list_where['search_word']]);
        }

        return $query->asArray()->count();
    }

}
