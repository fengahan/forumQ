create table community_grade_log
(
    id         int(11) unsigned auto_increment
        primary key,
    user_id    int                         not null,
    level      varchar(32) charset utf8mb4 not null,
    is_node    int default 0               not null,
    technical  int                         not null,
    created_at int                         not null
)
    charset = latin1;

