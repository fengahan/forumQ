create table community_user_invite_map
(
    id                 int(11) unsigned auto_increment
        primary key,
    user_id            int(11) unsigned not null,
    parent_id          int              not null,
    parent_invite_code int              not null,
    created_at         int              not null,
    updated_at         int              not null
)
    charset = latin1;

INSERT INTO question.community_user_invite_map (id, user_id, parent_id, parent_invite_code, created_at, updated_at) VALUES (1, 20, 22, 26915647, 1587823337, 1587823337);
INSERT INTO question.community_user_invite_map (id, user_id, parent_id, parent_invite_code, created_at, updated_at) VALUES (2, 20, 22, 26915647, 1587823338, 1587823338);
INSERT INTO question.community_user_invite_map (id, user_id, parent_id, parent_invite_code, created_at, updated_at) VALUES (3, 20, 22, 26915647, 1587823344, 1587823344);
INSERT INTO question.community_user_invite_map (id, user_id, parent_id, parent_invite_code, created_at, updated_at) VALUES (4, 20, 22, 26915647, 1587823347, 1587823347);
INSERT INTO question.community_user_invite_map (id, user_id, parent_id, parent_invite_code, created_at, updated_at) VALUES (5, 20, 22, 26915647, 1587823348, 1587823348);
INSERT INTO question.community_user_invite_map (id, user_id, parent_id, parent_invite_code, created_at, updated_at) VALUES (6, 20, 22, 26915647, 1587823350, 1587823350);
INSERT INTO question.community_user_invite_map (id, user_id, parent_id, parent_invite_code, created_at, updated_at) VALUES (7, 20, 22, 26915647, 1587823503, 1587823503);