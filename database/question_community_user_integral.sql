create table community_user_integral
(
    id               int(11) unsigned auto_increment
        primary key,
    payment_user_id  int(11) unsigned default 0 not null comment '付款用户id',
    receipt_user_id  int(11) unsigned default 0 not null comment '收款用户id',
    type             tinyint unsigned default 1 not null comment '1 评论回答被采纳 2 文章付费',
    origin_id        int(11) unsigned default 0 not null comment '采纳，付费等等 id',
    before_integral  int(11) unsigned default 0 not null comment '之前积分',
    current_integral int(11) unsigned default 0 not null comment '当前积分',
    integral         int              default 0 not null comment '积分数量 【有加减】',
    status           tinyint          default 1 not null comment '0 正常  1删除',
    created_time     int              default 0 not null comment '开始时间',
    updated_time     int              default 0 not null comment '更新时间'
)
    comment '用户收藏文章表' charset = utf8mb4;

