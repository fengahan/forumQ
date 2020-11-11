create table community_articles_pay
(
    id              int(11) unsigned auto_increment
        primary key,
    article_id      int(11) unsigned default 0 not null comment '文章ID',
    payment_user_id int(11) unsigned default 0 not null comment '付款用户id',
    receipt_user_id int(11) unsigned default 0 not null comment '收款用户id',
    integral        int(11) unsigned default 0 not null comment '积分',
    status          tinyint          default 0 not null comment '0 正常 1 删除',
    created_time    int              default 0 not null comment '创建时间',
    updated_time    int              default 0 not null comment '更新时间'
)
    comment '文章回复表' charset = utf8mb4;

create index article_id
    on community_articles_pay (article_id);

