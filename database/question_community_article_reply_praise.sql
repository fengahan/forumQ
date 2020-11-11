create table community_article_reply_praise
(
    id         int auto_increment
        primary key,
    user_id    int not null,
    reply_id   int not null,
    created_at int not null
)
    charset = latin1;

INSERT INTO question.community_article_reply_praise (id, user_id, reply_id, created_at) VALUES (1, 20, 1, 1605066599);
INSERT INTO question.community_article_reply_praise (id, user_id, reply_id, created_at) VALUES (2, 22, 20, 1605081005);
INSERT INTO question.community_article_reply_praise (id, user_id, reply_id, created_at) VALUES (4, 22, 18, 1605081012);
INSERT INTO question.community_article_reply_praise (id, user_id, reply_id, created_at) VALUES (5, 22, 17, 1605081013);
INSERT INTO question.community_article_reply_praise (id, user_id, reply_id, created_at) VALUES (6, 22, 16, 1605081032);
INSERT INTO question.community_article_reply_praise (id, user_id, reply_id, created_at) VALUES (7, 20, 20, 1605081121);
INSERT INTO question.community_article_reply_praise (id, user_id, reply_id, created_at) VALUES (8, 20, 17, 1605081131);
INSERT INTO question.community_article_reply_praise (id, user_id, reply_id, created_at) VALUES (9, 20, 19, 1605082758);