<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
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


    const SCENARIO_QUES_CREATE = 'user_create_ques';
    public static function tableName()
    {
        return '{{%question}}';
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
            [['title', 'tag_id', 'money', 'user_id','html_content', 'markdown_content'], 'required'],
            ['status','in','range'=>[self::STATUS_DELETE,self::STATUS_CLOSE,self::STATUS_NORMAL]],
            ['is_public','in','range'=>[self::PUBLIC_NOT,self::PUBLIC_YES]],
            ['is_public', 'default', 'value' => self::PUBLIC_YES],
            ['status','default','value'=>self::STATUS_CLOSE],
            ['money', 'integer', 'integerOnly' => true, 'min' => 1,'max' => 20],
            [['html_content', 'markdown_content','last_reply_nickname'], 'string'],
            [['id','is_public','best_reply_id', 'tag_id', 'money', 'user_id', 'user_identity', 'view_number', 'subscribe_number', 'reply_number', 'is_solve', 'status', 'created_at', 'updated_at','last_reply_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    public function scenarios()
    {

        $scenarios= parent::scenarios();
        $scenarios[self::SCENARIO_QUES_CREATE]=['title', 'tag_id', 'money', 'user_id','html_content', 'markdown_content','status','is_public'];
        return $scenarios;
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
            'is_public' => '公开策略',
            'tag_id' => '标签',
            'money' => '赏金',
            'user_id' => '用户',
            'best_reply_id'=>"最佳评论",
            'user_identity' => '身份',
            'view_number' => '查看人数',
            'subscribe_number' => '订阅人数',
            'reply_number' => '回复人数',
            'is_solve' => '解决状态',
            'status' => '状态',
            'created_at' => '创建时间',
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
        $query=  self::find()->select("q.id,q.title,q.reply_number,q.view_number,q.money,q.created_at,q.last_reply_nickname,q.last_reply_at,
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

    public function getNewSolve()
    {
        $where['q.is_solve']=self::SOLVE_YES;
        $where['q.status']=self::STATUS_NORMAL;
        return self::find()->alias("q")->select(" q.id,q.title,q.created_at,u.nickname,u.avatar")
            ->leftJoin(CommunityUsers::tableName() ."as u","q.user_id=u.id")
            ->where($where)->orderBy("best_reply_at desc")
            ->limit(5)
            ->asArray()
            ->all();
    }

    public function getQuestionContent($id)
    {
        return self::find()->alias("q")
            ->select("q.*,u.avatar,u.nickname")
            ->leftJoin(CommunityUsers::tableName()." as u","u.id=q.user_id")
            ->where(['q.id'=>$id])->asArray()->one();

    }

    public function getUserQuesCount($user_id,$status)
    {
        $where['status']=$status;
        return self::find()
            ->where(['user_id'=>$user_id])
            ->andWhere($where)
            ->count();

    }

    public function getUserQues($user_id,$status,$pagination)
    {
        $where['q.status']=$status;
        $where['q.user_id']=$user_id;
        $query=  self::find()->select("q.id,q.title,q.reply_number,q.view_number,q.subscribe_number,q.money,q.created_at,q.last_reply_nickname,
        q.last_reply_at,q.status,q.is_solve,
        u.avatar,u.nickname,u.email,u.type,u.self_signature")->from(CommunityQuestion::tableName(). "as q")
            ->leftJoin(CommunityUsers::tableName(). "as u",'u.id=q.user_id')
            ->leftJoin(CommunityTag::tableName() . "as t",'t.id=q.tag_id')
            ->where($where);
        return $query->offset($pagination->offset)
            ->limit($pagination->limit)->orderBy('q.id desc')->asArray()->all();

    }

}
