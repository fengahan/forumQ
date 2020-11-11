create table community_tag
(
    id           int(11) unsigned auto_increment comment '标签表id'
        primary key,
    type         tinyint(3)          default 0 not null comment '标签类型【1 技能类型标签，2 文章行业类型标签，3 文章属性类型标签】',
    color        varchar(255)                  not null,
    creator      int(11) unsigned    default 0 not null comment '标签创建者【0 系统，】',
    title        varchar(45)                   not null comment '标签名称',
    status       tinyint(4) unsigned default 0 not null comment '10正常 20删除30未开放',
    updated_time int(11) unsigned    default 0 not null comment '修改时间',
    created_time int(11) unsigned    default 0 not null comment '创建时间'
)
    comment '标签属性表' charset = utf8mb4;

INSERT INTO question.community_tag (id, type, color, creator, title, status, updated_time, created_time) VALUES (11, 1, '#FFCC22', 0, 'Linux', 10, 1577189766, 1577189766);
INSERT INTO question.community_tag (id, type, color, creator, title, status, updated_time, created_time) VALUES (12, 1, '#5555FF', 0, 'PHP', 10, 1577189766, 1577189766);
INSERT INTO question.community_tag (id, type, color, creator, title, status, updated_time, created_time) VALUES (13, 1, '#FFCC22', 0, 'Java', 10, 1577189766, 1577189766);
INSERT INTO question.community_tag (id, type, color, creator, title, status, updated_time, created_time) VALUES (14, 1, '#40E0D0', 0, 'GoLang', 10, 1577189766, 1577189766);
INSERT INTO question.community_tag (id, type, color, creator, title, status, updated_time, created_time) VALUES (15, 1, '#ADFF2F', 0, 'C/C++', 10, 1577189766, 1577189766);
INSERT INTO question.community_tag (id, type, color, creator, title, status, updated_time, created_time) VALUES (16, 1, '#FF69B4', 0, 'Mysql', 10, 1577189766, 1577189766);
INSERT INTO question.community_tag (id, type, color, creator, title, status, updated_time, created_time) VALUES (17, 1, '#8B008B', 0, 'Js', 10, 1577189766, 1577189766);
INSERT INTO question.community_tag (id, type, color, creator, title, status, updated_time, created_time) VALUES (18, 1, '#F08080', 0, 'Flutter', 10, 1577189766, 1577189766);
INSERT INTO question.community_tag (id, type, color, creator, title, status, updated_time, created_time) VALUES (19, 1, '#EEE8AA', 0, 'Rust', 10, 1577189766, 1577189766);
INSERT INTO question.community_tag (id, type, color, creator, title, status, updated_time, created_time) VALUES (20, 1, '#FF4500', 0, '其他', 10, 1577189766, 1577189766);