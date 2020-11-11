create table community_user_collection
(
    id                 int(11) unsigned auto_increment
        primary key,
    user_id            int(11) unsigned default 0 not null comment '用户ID',
    type               tinyint unsigned default 1 not null comment '1 文章 2 评论',
    collection_user_id int(11) unsigned default 0 not null comment '被收藏用户ID',
    article_id         int(11) unsigned           not null comment '文章ID',
    status             tinyint          default 1 not null comment '0 正常  1删除',
    created_time       int              default 0 not null comment '收藏开始时间',
    updated_time       int              default 0 not null comment '收藏更新时间'
)
    comment '用户收藏文章表' charset = utf8mb4;

