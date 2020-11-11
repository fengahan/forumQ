create table community_user_message
(
    id         int(11) unsigned auto_increment
        primary key,
    user_id    int                     not null,
    content    varchar(255) default '' not null,
    status     tinyint(3)   default 10 not null comment '10未读20已读30已删除',
    created_at int                     not null,
    read_time  int          default 0  not null,
    url        varchar(255)            not null
)
    charset = utf8mb4;

INSERT INTO question.community_user_message (id, user_id, content, status, created_at, read_time, url) VALUES (1, 20, '赵朝阳回复了您的文章[有人用过 tsingsun/yii2-graphql 这个扩展吗？怎么使用，求个示例]', 20, 1605066592, 0, '');
INSERT INTO question.community_user_message (id, user_id, content, status, created_at, read_time, url) VALUES (2, 20, '赵朝阳回复了您的文章[有人用过 tsingsun/yii2-graphql 这个扩展吗？怎么使用，求个示例]', 20, 1605066652, 0, '');
INSERT INTO question.community_user_message (id, user_id, content, status, created_at, read_time, url) VALUES (3, 20, '赵朝阳回复了您的文章[有人用过 tsingsun/yii2-graphql 这个扩展吗？怎么使用，求个示例]', 20, 1605067261, 0, '');
INSERT INTO question.community_user_message (id, user_id, content, status, created_at, read_time, url) VALUES (4, 20, '赵朝阳回复了您的文章[有人用过 tsingsun/yii2-graphql 这个扩展吗？怎么使用，求个示例]', 20, 1605067320, 0, '');
INSERT INTO question.community_user_message (id, user_id, content, status, created_at, read_time, url) VALUES (5, 20, '赵朝阳回复了您的文章[有人用过 tsingsun/yii2-graphql 这个扩展吗？怎么使用，求个示例]', 20, 1605067420, 0, '');
INSERT INTO question.community_user_message (id, user_id, content, status, created_at, read_time, url) VALUES (6, 20, '赵朝阳回复了您的文章[有人用过 tsingsun/yii2-graphql 这个扩展吗？怎么使用，求个示例]', 20, 1605067902, 0, '');
INSERT INTO question.community_user_message (id, user_id, content, status, created_at, read_time, url) VALUES (7, 20, '赵朝阳在[有人用过 tsingsun/yii2-graphql 这个扩展吗？怎么使用，求个示例]中回复了您', 20, 1605070803, 0, '');
INSERT INTO question.community_user_message (id, user_id, content, status, created_at, read_time, url) VALUES (8, 20, '赵朝阳回复了您的问答[分享一个redis 使用集合]', 20, 1605073684, 0, '');
INSERT INTO question.community_user_message (id, user_id, content, status, created_at, read_time, url) VALUES (15, 22, '赵朝阳在问答 [分享一个redis 使用集合]中采取了您的回复', 20, 1605074174, 0, '');
INSERT INTO question.community_user_message (id, user_id, content, status, created_at, read_time, url) VALUES (16, 22, '您订阅的问答[分享一个redis 使用集合]有了最佳回复', 20, 1605074174, 0, '');
INSERT INTO question.community_user_message (id, user_id, content, status, created_at, read_time, url) VALUES (17, 20, '陈皮在[有人用过 tsingsun/yii2-graphql 这个扩展吗？怎么使用，求个示例]中回复了您', 20, 1605079471, 0, '');
INSERT INTO question.community_user_message (id, user_id, content, status, created_at, read_time, url) VALUES (18, 20, '陈皮在[有人用过 tsingsun/yii2-graphql 这个扩展吗？怎么使用，求个示例]中回复了您', 20, 1605080157, 0, 'http://127.0.0.1:8080/question/detail#reply-content-17');
INSERT INTO question.community_user_message (id, user_id, content, status, created_at, read_time, url) VALUES (19, 20, '陈皮在[有人用过 tsingsun/yii2-graphql 这个扩展吗？怎么使用，求个示例]中回复了您', 20, 1605080345, 0, 'http://127.0.0.1:8080/article/detail?article_id=1#reply-content-18');
INSERT INTO question.community_user_message (id, user_id, content, status, created_at, read_time, url) VALUES (20, 22, '赵朝阳在[有人用过 tsingsun/yii2-graphql 这个扩展吗？怎么使用，求个示例]中回复了您', 20, 1605080932, 0, 'http://127.0.0.1:8080/article/detail?article_id=1#reply-content-20');