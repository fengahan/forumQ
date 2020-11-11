create table community_user_attention
(
    id                int(11) unsigned auto_increment
        primary key,
    user_id           int(11) unsigned default 0 not null comment '用户ID',
    attention_user_id int(11) unsigned default 0 not null comment '被关注用户ID',
    status            tinyint          default 1 not null comment '0 删除关注 1 取消关注 2 关注未读 3 关注已读',
    created_time      int              default 0 not null comment '关注开始时间',
    updated_time      int              default 0 not null comment '关注更新时间'
)
    comment '用户关注用户表' charset = utf8mb4;

