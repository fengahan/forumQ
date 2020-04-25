<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%user_invite_map}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $parent_id
 * @property int $parent_invite_code
 * @property int $created_at
 * @property int $updated_at
 */
class UserInviteMap extends BaseModel
{

    const BIND_GIVEN_MONEY=1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_invite_map}}';
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
            [['user_id', 'parent_id', 'parent_invite_code'], 'required'],
            [['user_id', 'parent_id', 'parent_invite_code', 'created_at', 'updated_at'], 'integer'],
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
            'parent_id' => 'Parent ID',
            'parent_invite_code' => 'Parent Invite Code',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
