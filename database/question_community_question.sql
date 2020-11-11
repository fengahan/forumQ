create table community_question
(
    id                  int(11) unsigned auto_increment
        primary key,
    title               varchar(255)                not null comment '标题',
    html_content        text                        not null comment 'html内容',
    markdown_content    text                        not null comment 'markdown内容',
    best_reply_id       int              default 0  not null comment '最佳答案ID',
    best_reply_at       int              default 0  not null comment '最佳答案采纳时间',
    is_public           tinyint unsigned default 10 not null comment '获得最佳答案时是否免费公开',
    tag_id              int(11) unsigned            not null comment 'tag',
    money               int(11) unsigned            not null comment '赏金',
    user_id             int                         not null comment '用户Id',
    user_identity       tinyint(3)       default 10 not null comment '10  普通 20 大咖',
    view_number         int(11) unsigned default 0  not null comment '查看次数',
    subscribe_number    int(11) unsigned default 0  not null comment '订阅人数',
    reply_number        int              default 0  not null comment '回复人数',
    last_reply_nickname varchar(255)     default '' not null,
    last_reply_at       int                         null,
    is_solve            tinyint(11)      default 20 not null comment '是否解决10 ok 20 not',
    status              tinyint unsigned default 20 not null comment '关闭 开启 删除',
    created_at          int                         not null,
    updated_at          int              default 0  not null comment '查看次数'
)
    charset = utf8mb4;

INSERT INTO question.community_question (id, title, html_content, markdown_content, best_reply_id, best_reply_at, is_public, tag_id, money, user_id, user_identity, view_number, subscribe_number, reply_number, last_reply_nickname, last_reply_at, is_solve, status, created_at, updated_at) VALUES (37, '如何接近Tcp 并发 数据流界限问题', '<p>求大神支招</p>
', '求大神支招', 0, 0, 10, 12, 1, 20, 10, 0, 0, 0, '', null, 20, 30, 1586178239, 1586180496);
INSERT INTO question.community_question (id, title, html_content, markdown_content, best_reply_id, best_reply_at, is_public, tag_id, money, user_id, user_identity, view_number, subscribe_number, reply_number, last_reply_nickname, last_reply_at, is_solve, status, created_at, updated_at) VALUES (38, '操作系统接收TCP连接的操作是阻塞的吗', '<p> 操作系统接收TCP连的操作是阻塞的吗</p>
', ' 操作系统接收TCP连的操作是阻塞的吗', 0, 0, 20, 11, 1, 20, 10, 0, 0, 0, '', null, 20, 30, 1588819442, 1588819926);
INSERT INTO question.community_question (id, title, html_content, markdown_content, best_reply_id, best_reply_at, is_public, tag_id, money, user_id, user_identity, view_number, subscribe_number, reply_number, last_reply_nickname, last_reply_at, is_solve, status, created_at, updated_at) VALUES (39, '分享一个redis 使用集合', '<p>wwwww</p>
', 'wwwww', 1, 1605074173, 10, 12, 1, 20, 10, 0, 1, 1, '陈皮', 1605073684, 10, 10, 1605073534, 1605074173);