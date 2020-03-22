<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%ques_reply_emoji}}".
 *
 * @property int $id
 * @property int $ques_reply_id
 * @property string $emoji_key
 * @property int $count
 * @property int $user_id
 * @property int $create_at
 * @property string $key
 * @property int ques_id
 */
class QuesReplyEmoji extends \yii\db\ActiveRecord
{

    const EMOJI_GOOD_KEY ='zmdi zmdi-thumb-up zmdi-hc-fw bg-info wp-30 hp-30';
    const EMOJI_BAD_KEY  ='zmdi zmdi-thumb-down zmdi-hc-fw bg-yellow wp-30 hp-30';
    const EMOJI_HAPPY_KEY='zmdi zmdi-mood zmdi-hc-fw bg-green wp-30 hp-30';
    const EMOJI_NO_HAPPY_KEY='zmdi zmdi-mood-bad zmdi-hc-fw bg-blue wp-30 hp-30';
    const EMOJI_LOVE_KEY='zmdi zmdi-favorite zmdi-hc-fw bg-red wp-30 hp-30';

    const GOOD_KEY='thumb-up';
    const BAD_KEY='thumb-down';
    const HAPPY_KEY='mood';
    const NO_HAPPY_KEY='mood-bad';
    const LOVE_KEY='favorite';

    static public $kes=[
        self::GOOD_KEY=>self::EMOJI_GOOD_KEY,
        self::BAD_KEY=>self::EMOJI_BAD_KEY,
        self::HAPPY_KEY=>self::EMOJI_HAPPY_KEY,
        self::NO_HAPPY_KEY=>self::EMOJI_NO_HAPPY_KEY,
        self::LOVE_KEY=>self::EMOJI_LOVE_KEY,
    ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ques_reply_emoji}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ques_reply_id', 'emoji_key', 'user_id', 'create_at'], 'required'],
            [['id', 'ques_reply_id', 'count', 'user_id', 'create_at'], 'integer'],
            [['emoji_key'], 'string', 'max' => 255],
            [['key'], 'string', 'max' => 32],
            ['key','in','range'=>array_keys(self::$kes)],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ques_reply_id' => 'Ques Reply ID',
            'emoji_key' => 'Emoji Key',
            'count' => 'Count',
            'user_id' => 'User ID',
            'create_at' => 'Create At',
        ];
    }


    public static function getEmj($rep_id)
    {

        return self::find()->where(['ques_reply_id'=>$rep_id])->all();

    }
}
