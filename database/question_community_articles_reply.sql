create table community_articles_reply
(
    id               int(11) unsigned auto_increment
        primary key,
    article_id       int(11) unsigned default 0 not null comment '文章ID',
    parent_id        int(11) unsigned default 0 not null comment '上一个评论Id',
    user_id          int(11) unsigned default 0 not null comment '用户id',
    html_content     text                       not null comment '回复内容',
    praise_nums      int(11) unsigned default 0 null comment '点赞数量',
    status           tinyint          default 0 not null comment '0 正常 1 删除 ',
    created_at       int              default 0 not null comment '创建时间',
    updated_at       int              default 0 not null comment '更新时间',
    markdown_content text                       not null,
    article_user_id  int                        not null
)
    comment '文章回复表' charset = utf8mb4;

create index article_id
    on community_articles_reply (article_id);

INSERT INTO question.community_articles_reply (id, article_id, parent_id, user_id, html_content, praise_nums, status, created_at, updated_at, markdown_content, article_user_id) VALUES (1, 1, 0, 20, '<p>cfv</p>
', 1, 10, 1605066591, 1605066591, 'cfv', 20);
INSERT INTO question.community_articles_reply (id, article_id, parent_id, user_id, html_content, praise_nums, status, created_at, updated_at, markdown_content, article_user_id) VALUES (2, 1, 0, 20, '<p><strong>asds</strong></p>
', 0, 10, 1605066652, 1605066652, '**asds**', 20);
INSERT INTO question.community_articles_reply (id, article_id, parent_id, user_id, html_content, praise_nums, status, created_at, updated_at, markdown_content, article_user_id) VALUES (3, 1, 0, 20, '<p>``````</p>
', 0, 10, 1605067261, 1605067261, '``````', 20);
INSERT INTO question.community_articles_reply (id, article_id, parent_id, user_id, html_content, praise_nums, status, created_at, updated_at, markdown_content, article_user_id) VALUES (4, 1, 0, 20, '<table>
<thead>
<tr>
<th>标题</th>
<th>时间</th>
</tr>
</thead>
<tbody>
<tr>
<td>测试</td>
<td>123</td>
</tr>
<tr>
<td>测试0</td>
<td>5678</td>
</tr>
</tbody>
</table>
', 0, 10, 1605067320, 1605067320, '|   标题|时间   |
| ------------ | ------------ |
|  测试 |123   |
|   测试0|5678   |
', 20);
INSERT INTO question.community_articles_reply (id, article_id, parent_id, user_id, html_content, praise_nums, status, created_at, updated_at, markdown_content, article_user_id) VALUES (5, 1, 3, 22, '<table>
<thead>
<tr>
<th></th>
<th></th>
<th></th>
<th></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
</tbody>
</table>
', 0, 10, 1605067420, 1605067420, '|   |   |   |   |   |
| ------------ | ------------ | ------------ | ------------ | ------------ |
|   |   |   |   |   |
|   |   |   |   |   |
|   |   |   |   |   |
|   |   |   |   |   |
|   |   |   |   |   |
', 20);
INSERT INTO question.community_articles_reply (id, article_id, parent_id, user_id, html_content, praise_nums, status, created_at, updated_at, markdown_content, article_user_id) VALUES (6, 1, 5, 20, '<p><img src="/static/upload/editor/hh7Un2x5kE2q260ca9.png" alt=""></p>
', 0, 10, 1605067902, 1605067902, '![](/static/upload/editor/hh7Un2x5kE2q260ca9.png)', 20);
INSERT INTO question.community_articles_reply (id, article_id, parent_id, user_id, html_content, praise_nums, status, created_at, updated_at, markdown_content, article_user_id) VALUES (7, 1, 5, 20, '<pre class="prettyprint linenums prettyprinted" style=""><ol class="linenums"><li class="L0"><code class="lang-php"><span class="kwd">function</span><span class="pln"> getName</span><span class="pun">(){</span></code></li><li class="L1"><code class="lang-php"></code></li><li class="L2"><code class="lang-php"><span class="pln">    </span><span class="kwd">return</span><span class="pln"> </span><span class="str">''Lucky''</span></code></li><li class="L3"><code class="lang-php"></code></li><li class="L4"><code class="lang-php"><span class="pun">}</span></code></li></ol></pre>
', 0, 10, 1605070298, 1605070298, '```php
function getName(){

	return ''Lucky''

}
```', 20);
INSERT INTO question.community_articles_reply (id, article_id, parent_id, user_id, html_content, praise_nums, status, created_at, updated_at, markdown_content, article_user_id) VALUES (8, 1, 5, 20, '<pre class="prettyprint linenums prettyprinted" style=""><ol class="linenums"><li class="L0"><code class="lang-php"><span class="kwd">function</span><span class="pln"> getName</span><span class="pun">(){</span></code></li><li class="L1"><code class="lang-php"></code></li><li class="L2"><code class="lang-php"><span class="pln">    </span><span class="kwd">return</span><span class="pln"> </span><span class="str">''Lucky''</span></code></li><li class="L3"><code class="lang-php"></code></li><li class="L4"><code class="lang-php"><span class="pun">}</span></code></li></ol></pre>
', 0, 10, 1605070309, 1605070309, '```php
function getName(){

	return ''Lucky''

}
```', 20);
INSERT INTO question.community_articles_reply (id, article_id, parent_id, user_id, html_content, praise_nums, status, created_at, updated_at, markdown_content, article_user_id) VALUES (9, 1, 5, 20, '<pre class="prettyprint linenums prettyprinted" style=""><ol class="linenums"><li class="L0"><code class="lang-php"><span class="kwd">function</span><span class="pln"> getName</span><span class="pun">(){</span></code></li><li class="L1"><code class="lang-php"></code></li><li class="L2"><code class="lang-php"><span class="pln">    </span><span class="kwd">return</span><span class="pln"> </span><span class="str">''Lucky''</span></code></li><li class="L3"><code class="lang-php"></code></li><li class="L4"><code class="lang-php"><span class="pun">}</span></code></li></ol></pre>
', 0, 10, 1605070414, 1605070414, '```php
function getName(){

	return ''Lucky''

}
```', 20);
INSERT INTO question.community_articles_reply (id, article_id, parent_id, user_id, html_content, praise_nums, status, created_at, updated_at, markdown_content, article_user_id) VALUES (10, 1, 5, 20, '<pre class="prettyprint linenums prettyprinted" style=""><ol class="linenums"><li class="L0"><code class="lang-php"><span class="kwd">function</span><span class="pln"> getName</span><span class="pun">(){</span></code></li><li class="L1"><code class="lang-php"></code></li><li class="L2"><code class="lang-php"><span class="pln">    </span><span class="kwd">return</span><span class="pln"> </span><span class="str">''Lucky''</span></code></li><li class="L3"><code class="lang-php"></code></li><li class="L4"><code class="lang-php"><span class="pun">}</span></code></li></ol></pre>
', 0, 10, 1605070438, 1605070438, '```php
function getName(){

	return ''Lucky''

}
```', 20);
INSERT INTO question.community_articles_reply (id, article_id, parent_id, user_id, html_content, praise_nums, status, created_at, updated_at, markdown_content, article_user_id) VALUES (11, 1, 5, 20, '<pre class="prettyprint linenums prettyprinted" style=""><ol class="linenums"><li class="L0"><code class="lang-php"><span class="kwd">function</span><span class="pln"> getName</span><span class="pun">(){</span></code></li><li class="L1"><code class="lang-php"></code></li><li class="L2"><code class="lang-php"><span class="pln">    </span><span class="kwd">return</span><span class="pln"> </span><span class="str">''Lucky''</span></code></li><li class="L3"><code class="lang-php"></code></li><li class="L4"><code class="lang-php"><span class="pun">}</span></code></li></ol></pre>
', 0, 10, 1605070701, 1605070701, '```php
function getName(){

	return ''Lucky''

}
```', 20);
INSERT INTO question.community_articles_reply (id, article_id, parent_id, user_id, html_content, praise_nums, status, created_at, updated_at, markdown_content, article_user_id) VALUES (12, 1, 1, 22, '<p>测试</p>
', 0, 10, 1605070803, 1605070803, '测试', 20);
INSERT INTO question.community_articles_reply (id, article_id, parent_id, user_id, html_content, praise_nums, status, created_at, updated_at, markdown_content, article_user_id) VALUES (13, 1, 0, 22, '<p>KKKK</p>
', 0, 10, 1605079471, 1605079471, 'KKKK', 20);
INSERT INTO question.community_articles_reply (id, article_id, parent_id, user_id, html_content, praise_nums, status, created_at, updated_at, markdown_content, article_user_id) VALUES (14, 1, 0, 22, '<p>asd</p>
', 0, 10, 1605079936, 1605079936, 'asd', 20);
INSERT INTO question.community_articles_reply (id, article_id, parent_id, user_id, html_content, praise_nums, status, created_at, updated_at, markdown_content, article_user_id) VALUES (15, 1, 0, 22, '<p>asd</p>
', 0, 10, 1605079960, 1605079960, 'asd', 20);
INSERT INTO question.community_articles_reply (id, article_id, parent_id, user_id, html_content, praise_nums, status, created_at, updated_at, markdown_content, article_user_id) VALUES (16, 1, 0, 22, '<p>asd</p>
', 1, 10, 1605079966, 1605079966, 'asd', 20);
INSERT INTO question.community_articles_reply (id, article_id, parent_id, user_id, html_content, praise_nums, status, created_at, updated_at, markdown_content, article_user_id) VALUES (17, 1, 0, 22, '<p>asd</p>
', 2, 10, 1605080157, 1605080157, 'asd', 20);
INSERT INTO question.community_articles_reply (id, article_id, parent_id, user_id, html_content, praise_nums, status, created_at, updated_at, markdown_content, article_user_id) VALUES (18, 1, 0, 22, '<p>fasfa</p>
', 1, 10, 1605080345, 1605080345, 'fasfa', 20);
INSERT INTO question.community_articles_reply (id, article_id, parent_id, user_id, html_content, praise_nums, status, created_at, updated_at, markdown_content, article_user_id) VALUES (19, 1, 12, 20, '<p>测试测试测试测试</p>
', 1, 10, 1605080785, 1605080785, '测试测试测试测试', 20);
INSERT INTO question.community_articles_reply (id, article_id, parent_id, user_id, html_content, praise_nums, status, created_at, updated_at, markdown_content, article_user_id) VALUES (20, 1, 5, 20, '<p>A A A A </p>
', 2, 10, 1605080932, 1605080932, 'A A A A ', 20);