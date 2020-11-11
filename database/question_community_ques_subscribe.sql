create table community_ques_subscribe
(
    id        int auto_increment
        primary key,
    ques_id   int not null,
    user_id   int not null,
    create_at int not null
)
    charset = utf8mb4;

INSERT INTO question.community_ques_subscribe (id, ques_id, user_id, create_at) VALUES (1, 39, 22, 1605073609);