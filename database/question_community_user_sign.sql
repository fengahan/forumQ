create table community_user_sign
(
    id           int(11) unsigned auto_increment
        primary key,
    user_id      int(11) unsigned default 0  not null,
    created_time varchar(11) charset utf8mb4 not null comment '签到时间 如20201122',
    created_at   int(11) unsigned            not null
)
    charset = latin1;

