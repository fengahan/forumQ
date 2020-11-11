create table community_ques_reply
(
    id                     int(11) unsigned auto_increment
        primary key,
    user_id                int                   not null comment ' ',
    ques_id                int                   not null comment ' ',
    ques_user_id           int                   not null,
    reply_html_content     text charset utf8mb4  not null,
    reply_markdown_content text charset utf8mb4  not null,
    is_best                tinyint(3) default 20 not null,
    parent_id              int        default 0  not null,
    status                 tinyint(3) default 10 not null,
    created_at             int                   null
)
    charset = latin1;

INSERT INTO question.community_ques_reply (id, user_id, ques_id, ques_user_id, reply_html_content, reply_markdown_content, is_best, parent_id, status, created_at) VALUES (1, 22, 39, 20, '<p>dddd</p>
', 'dddd', 10, 0, 10, 1605073684);