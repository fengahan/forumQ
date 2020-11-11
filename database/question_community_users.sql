create table community_users
(
    id                   int(13) unsigned auto_increment comment '用户id'
        primary key,
    self_signature       varchar(255)            default ''                                   not null comment '签名',
    email                varchar(40)             default ''                                   not null comment 'email地址',
    verification_token   varchar(64)             default ''                                   not null,
    auth_key             varchar(64)             default ''                                   not null,
    password             varchar(64)             default ''                                   not null comment '用户密码',
    password_hash        varchar(64)             default ''                                   not null,
    phone                varchar(20)             default ''                                   not null comment '联系电话',
    wechat               varchar(20)             default ''                                   not null comment '微信号',
    qq                   bigint(15) unsigned     default 0                                    not null comment 'qq',
    nickname             varchar(100)            default ''                                   not null comment '昵称',
    birthday             int                     default 0                                    not null comment '生日',
    avatar               varchar(255)            default '/mutui/demo/img/profile-pics/4.jpg' not null comment '头像图',
    gender               tinyint unsigned        default 0                                    null comment '性别【0 未知 1 男 2 女】',
    province             varchar(255)            default ''                                   not null comment '省份',
    city                 varchar(255)            default ''                                   not null comment '城市',
    country              varchar(255)            default ''                                   not null comment '县区',
    company              varchar(255)            default ''                                   not null comment '公司',
    direction_tags       varchar(255)            default ''                                   not null comment 'json用户技能类型标签',
    integral             int(13)                 default 0                                    not null comment '积分',
    balance              decimal(10, 2) unsigned default 0.00                                 not null comment '余额',
    type                 tinyint unsigned        default 10                                   not null comment '用户类型【10 普通用户 20 邀请码用户】',
    center_view_count    int(11) unsigned        default 0                                    not null comment '主頁面訪問次數',
    given_heart_count    int                     default 0                                    not null comment '送出的爱心总数',
    level                char(12)                default 'T1'                                 not null comment '用户等级',
    get_heart_count      int                     default 0                                    not null comment '获得的爱心',
    sign_count           int(11) unsigned        default 0                                    not null comment '签到次数',
    technical            int(11) unsigned        default 0                                    not null comment '技能点',
    origin               tinyint unsigned        default 0                                    not null comment '用户来源【0 官网注册 1 GitHub 授权】',
    status               tinyint unsigned        default 1                                    not null comment '状态【0：正常用户，1 黑名单，2 用户被删除】',
    last_time            int(11) unsigned        default 0                                    not null comment '最后登陆时间',
    updated_at           int(13) unsigned        default 0                                    not null comment '修改时间',
    created_at           int(13) unsigned        default 0                                    not null comment '注册时间',
    password_reset_token varchar(64)             default ''                                   null,
    invite_code          int(11) unsigned                                                     not null comment '邀请码',
    constraint email
        unique (email)
)
    comment '用户表' charset = utf8mb4;

create index add_time
    on community_users (created_at);

create index last_time
    on community_users (last_time);

create index nickname
    on community_users (nickname);

create index update_time
    on community_users (updated_at);

INSERT INTO question.community_users (id, self_signature, email, verification_token, auth_key, password, password_hash, phone, wechat, qq, nickname, birthday, avatar, gender, province, city, country, company, direction_tags, integral, balance, type, center_view_count, given_heart_count, level, get_heart_count, sign_count, technical, origin, status, last_time, updated_at, created_at, password_reset_token, invite_code) VALUES (20, '', '544976880@qq.com', 'q_TRK6ESJknn3KhrNBpvVx5dxtPFtn5w_1585577647', 'ymC588qS4dZx6eJbfBMR6qI1pB141uNv', '', '$2y$13$PNHDwU.Qb8Gk6k0ojgb0u.pQ92gdvXOtA7wpRDjdL//AbVxAS22bu', '', '', 0, '赵朝阳', 0, '/static/upload/avatar/WxapARtfftpK260ca9.png', 0, '', '', '', '', '', 125, 0.00, 10, 0, 0, 'T1', 1, 0, 120, 0, 10, 0, 1585577692, 1585577649, '', 21315638);
INSERT INTO question.community_users (id, self_signature, email, verification_token, auth_key, password, password_hash, phone, wechat, qq, nickname, birthday, avatar, gender, province, city, country, company, direction_tags, integral, balance, type, center_view_count, given_heart_count, level, get_heart_count, sign_count, technical, origin, status, last_time, updated_at, created_at, password_reset_token, invite_code) VALUES (22, '', '644976880@qq.com', 'q_TRK6ESJknn3KhrNBpvVx5dxtPFtn5w_1585577647', 'ymC588qS4dZx6eJbfBMR6qI1pB141uNv', '', '$2y$13$PNHDwU.Qb8Gk6k0ojgb0u.pQ92gdvXOtA7wpRDjdL//AbVxAS22bu', '', '', 0, '陈皮', 0, '/static/upload/avatar/oCrLl0o_m9sqc81e72.jpg', 0, '', '', '', '', '', 14, 0.00, 10, 0, 1, 'T1', 0, 0, 40, 0, 10, 0, 1585577692, 1585577649, '', 26915647);
INSERT INTO question.community_users (id, self_signature, email, verification_token, auth_key, password, password_hash, phone, wechat, qq, nickname, birthday, avatar, gender, province, city, country, company, direction_tags, integral, balance, type, center_view_count, given_heart_count, level, get_heart_count, sign_count, technical, origin, status, last_time, updated_at, created_at, password_reset_token, invite_code) VALUES (23, '', '347978219@qq.com', '3FwOAu5vzu3wrX8qfmtX-nUF0LIujIwo_1588849689', '3OdljpyB9JDmXUjLC2Mf2gAhzwPtI7hI', '', '$2y$13$kLxNF4lstla7VsKvRVJbGOK950RJkfskP/JLBTHrHUMCHwLfZumvm', '', '', 0, '孙爸爸', 0, '/mutui/demo/img/profile-pics/4.jpg', 0, '', '', '', '', '', 0, 0.00, 10, 0, 0, 'T1', 0, 0, 0, 0, 10, 0, 1588849696, 1588849690, '', 82704658);