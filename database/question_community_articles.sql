create table community_articles
(
    id               int(11) unsigned auto_increment
        primary key,
    title            varchar(255) charset utf8mb4 not null comment '标题',
    html_content     text charset utf8mb4         not null comment 'html内容',
    markdown_content text charset utf8mb4         not null comment 'markdown内容',
    tag_id           int(11) unsigned             not null comment 'tag',
    user_id          int                          not null comment '用户Id',
    view_number      int(11) unsigned default 0   not null comment '查看次数',
    reply_number     int              default 0   not null comment '回复人数',
    status           tinyint unsigned default 20  not null comment '关闭 开启 删除',
    created_at       int                          not null,
    updated_at       int              default 0   not null comment '查看次数',
    get_heart        int(11) unsigned default 0   not null
)
    charset = latin1;

INSERT INTO question.community_articles (id, title, html_content, markdown_content, tag_id, user_id, view_number, reply_number, status, created_at, updated_at, get_heart) VALUES (1, '有人用过 tsingsun/yii2-graphql 这个扩展吗？怎么使用，求个示例', '<pre class="prettyprint linenums prettyprinted" style=""><ol class="linenums"><li class="L0"><code><span class="pln"> </span><span class="pun">测试</span></code></li></ol></pre>', '     测试', 11, 20, 87, 20, 10, 1605064704, 1605066742, 1);