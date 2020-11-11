create table community_technical_log
(
    id         int(11) unsigned auto_increment
        primary key,
    user_id    int              not null,
    technical  int    default 0 not null comment '0其他1问答2分享3专题4项目',
    `from`     int(6) default 0 not null,
    created_at int              not null
)
    comment '技能点增加记录表' charset = latin1;

INSERT INTO question.community_technical_log (id, user_id, technical, `from`, created_at) VALUES (7, 22, 40, 1, 1605074174);
INSERT INTO question.community_technical_log (id, user_id, technical, `from`, created_at) VALUES (8, 20, 120, 2, 1605079926);