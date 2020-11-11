create table community_ques_reply_emoji
(
    id            int(11) unsigned auto_increment
        primary key,
    ques_reply_id int                         not null,
    emoji_key     varchar(255) charset latin1 not null,
    count         int default 0               not null,
    user_id       int                         not null,
    create_at     int                         not null,
    ques_id       int                         not null,
    `key`         varchar(32)                 not null
)
    charset = utf8mb4;

INSERT INTO question.community_ques_reply_emoji (id, ques_reply_id, emoji_key, count, user_id, create_at, ques_id, `key`) VALUES (1, 1, 'zmdi zmdi-thumb-up zmdi-hc-fw bg-info wp-30 hp-30', 1, 20, 1605073777, 39, 'thumb-up');
INSERT INTO question.community_ques_reply_emoji (id, ques_reply_id, emoji_key, count, user_id, create_at, ques_id, `key`) VALUES (2, 1, 'zmdi zmdi-mood zmdi-hc-fw bg-green wp-30 hp-30', 1, 20, 1605081190, 39, 'mood');