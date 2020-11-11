create table community_articles_praise
(
    id             int(11) unsigned auto_increment comment '被点赞表id'
        primary key,
    user_id        int(11) unsigned default 0 not null comment '点赞用户ID',
    praise_user_id int(11) unsigned default 0 not null comment '被点赞用户ID',
    article_id     int(11) unsigned default 0 not null comment '被点赞ID',
    status         tinyint unsigned default 1 not null comment '1正常2无效',
    created_at     int              default 0 not null comment '点赞时间',
    updated_at     int              default 0 not null comment '更新时间'
)
    comment '文章被点赞表' charset = utf8mb4;

create index user_id
    on community_articles_praise (user_id)
    comment '点赞用户id';

INSERT INTO question.community_articles_praise (id, user_id, praise_user_id, article_id, status, created_at, updated_at) VALUES (1, 22, 20, 1, 1, 1605079925, 0);