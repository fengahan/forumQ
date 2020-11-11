create table community_user_tag
(
    id           int(11) unsigned auto_increment comment 'id'
        primary key,
    level        tinyint             default 10 not null comment '10 初级20中级30 高级',
    user_id      int(11) unsigned    default 0  not null comment '用户id',
    integral     int                 default 0  not null,
    tag_id       int(11) unsigned    default 0  not null comment '标签id',
    status       tinyint(4) unsigned default 0  not null comment '10正常 20删除 30未开放',
    updated_time int(11) unsigned    default 0  not null comment '修改时间',
    created_time int(11) unsigned    default 0  not null comment '创建时间'
)
    comment '标签属性表' charset = utf8mb4;

INSERT INTO question.community_user_tag (id, level, user_id, integral, tag_id, status, updated_time, created_time) VALUES (25, 10, 20, 120, 11, 10, 1586943623, 1586943623);
INSERT INTO question.community_user_tag (id, level, user_id, integral, tag_id, status, updated_time, created_time) VALUES (26, 10, 20, 0, 14, 10, 1586943623, 1586943623);
INSERT INTO question.community_user_tag (id, level, user_id, integral, tag_id, status, updated_time, created_time) VALUES (27, 10, 20, 0, 16, 10, 1586943623, 1586943623);