create table community_user_link
(
    id           int(11) unsigned auto_increment
        primary key,
    name         varchar(255) charset utf8mb4 not null,
    icon         varchar(255) charset utf8mb4 not null,
    color        varchar(255) charset utf8mb4 not null,
    user_id      int     default 0            not null,
    href         varchar(255) charset utf8mb4 not null,
    status       tinyint default 10           not null comment '10 显示 20 隐藏 30 删除',
    click_number int     default 0            not null comment '点击次数',
    created_at   int     default 0            not null comment '创建时间',
    updated_at   int     default 0            not null comment '更新时间'
)
    charset = latin1;

INSERT INTO question.community_user_link (id, name, icon, color, user_id, href, status, click_number, created_at, updated_at) VALUES (1, 'Github', 'zmdi-wifi', 'bg-purple', 20, 'https://www.liaoxuefeng.com/', 10, 2, 0, 0);
INSERT INTO question.community_user_link (id, name, icon, color, user_id, href, status, click_number, created_at, updated_at) VALUES (2, 'demo', 'zmdi-wifi', 'bg-red', 20, 'https://www.liaoxuefeng.com/', 20, 0, 0, 0);