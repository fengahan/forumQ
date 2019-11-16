#### 用户信息表

```mysql

CREATE TABLE `community_users` (
  `id` int(13) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `user_token` varchar(120) NOT NULL DEFAULT '' COMMENT '用户token',
  `email` varchar(40) NOT NULL DEFAULT '' COMMENT 'email地址',
  `password` varchar(65) NOT NULL DEFAULT '' COMMENT '用户密码',
  `phone` varchar(20)  NOT NULL DEFAULT '' COMMENT '联系电话',
  `wechat` varchar(20)  NOT NULL DEFAULT '' COMMENT '微信号',
  `qq` bigint(15) unsigned NOT NULL DEFAULT 0 COMMENT 'qq',
  `nickname` varchar(100) NOT NULL DEFAULT '' COMMENT '昵称',
  `birthday` int(11) NOT NULL DEFAULT '' COMMENT '生日',
  `avatar` varchar(255) NOT NULL DEFAULT '' COMMENT '头像图',
  `gender` tinyint(3) unsigned DEFAULT '0' COMMENT '性别【0 未知 1 男 2 女】',
  `province` varchar(255) NOT NULL DEFAULT '' COMMENT '省份',
  `city` varchar(255) NOT NULL DEFAULT '' COMMENT '城市',
  `country` varchar(255) NOT NULL DEFAULT '' COMMENT '县区',
  `company` varchar(255) NOT NULL DEFAULT '' COMMENT '公司',
  `direction_tags` varchar(255) NOT NULL DEFAULT '' COMMENT 'json用户技能类型标签',
  `integral` int(13) DEFAULT '0' COMMENT '积分',
  `balance` decimal(10,2) unsigned DEFAULT '0.00' COMMENT '余额',
  `type` tinyint(3) unsigned DEFAULT '0' COMMENT '用户类型【0 普通用户 1 邀请码用户】',
  `origin` tinyint(3) unsigned DEFAULT '0' COMMENT '用户来源【0 官网注册 1 GitHub 授权】',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态【0：正常用户，1 黑名单，2 用户被删除】',
  `last_time` int(11) unsigned NOT NULL DEFAULT '' COMMENT '最后登陆时间',
  `update_time` int(13) unsigned DEFAULT '0' COMMENT '修改时间',
  `add_time` int(13) unsigned DEFAULT '0' COMMENT '注册时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_token` (`user_token`),
  KEY `nickname` (`nickname`),
  KEY `email` (`email`),
  KEY `update_time` (`update_time`),
  KEY `last_time` (`last_time`),
  KEY `add_time` (`add_time`),
  KEY `update_time` (`update_time`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COMMENT='用户表';

```

#### 用户文章

```mysql

CREATE TABLE `community_articles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '发布人ID',
  `title` varchar(255) NOT NULL COMMENT '文章标题',
  `summary` varchar(255) NOT NULL COMMENT '文章概要【如果是收费文章最好填上】',
  `content` text NOT NULL COMMENT '文章内容',
  `is_top` tinyint(11) unsigned NOT NULL DEFAULT '0' COMMENT '置顶',
  `is_pay` tinyint(11) unsigned NOT NULL DEFAULT '0' COMMENT '0 普通 1 付费 2 收费(收费之后内容不可见，可以多人付费查看，第一个人决定公开与否)',
  `integral` tinyint(11) unsigned NOT NULL DEFAULT '0' COMMENT '积分数目',
  `reply_nums` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '回复数量',
  `view_nums` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '浏览量',
  `praise_nums` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '文章被点赞数',
  `collection_nums` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '文章被收藏数',
  `industry_tags` varchar(255) DEFAULT '' COMMENT 'json文章行业类型标签',
  `attributes_tags` varchar(255) DEFAULT '' COMMENT 'json文章属性类型标签',
  `status` tinyint(4) unsigned NOT NULL DEFAULT '1' COMMENT '0 正常 1 删除 2 系统屏蔽所有不可见 3系统屏蔽所有者可见 4 收费文章只有作者和付款者可见',
  `created_time` int(11) unsigned DEFAULT '0' COMMENT '发表时间',
  `updated_time` int(11) unsigned DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COMMENT='文章表';

```

#### 文章回复表

```mysql

CREATE TABLE `community_articles_reply` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '文章ID',
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '上一个评论Id为0回复文章',
  `user_id` int(11)  unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `content` text NOT NULL COMMENT '回复内容',
  `praise_nums` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '点赞数量',
  `is_adoption` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '是否采纳 1 采纳 可以采纳多个当要付多份金额',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 正常 1 删除 2 付费问答只有付费者和回答者可见',
  `created_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='文章回复表';

```

#### 文章付费用户表

```mysql

CREATE TABLE `community_articles_pay` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '文章ID',
  `payment_user_id` int(11)  unsigned NOT NULL DEFAULT '0' COMMENT '付款用户id',
  `receipt_user_id` int(11)  unsigned NOT NULL DEFAULT '0' COMMENT '收款用户id',
  `integral` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '积分',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 正常 1 删除',
  `created_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='文章回复表';

```

#### 文章与评论被点赞表

```mysql

CREATE TABLE `community_article_praise` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '被点赞表id',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1 文章 2 评论 3 用户点赞用户',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '点赞用户ID',
  `praise_user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '被点赞用户ID',
  `article_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '被点赞ID',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '0 删除点赞 1 取消点赞 2 点赞未读 3 点赞已读',
  `created_time` int(11) NOT NULL DEFAULT '0' COMMENT '点赞时间',
  `updated_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`) USING BTREE COMMENT '点赞用户id'
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COMMENT='文章被点赞表';


```

#### 用户关注表

```mysql

CREATE TABLE `community_user_attention` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `attention_user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '被关注用户ID',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 删除关注 1 取消关注 2 关注未读 3 关注已读',
  `created_time` int(11) NOT NULL DEFAULT '0' COMMENT '关注开始时间',
  `updated_time` int(11) NOT NULL DEFAULT '0' COMMENT '关注更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='用户关注用户表';


```

#### 用户收藏表

```mysql

CREATE TABLE `community_user_collection` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1 文章 2 评论',
  `collection_user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '被收藏用户ID',
  `article_id` int(11) unsigned NOT NULL COMMENT '文章ID',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 正常  1删除',
  `created_time` int(11) NOT NULL DEFAULT '0' COMMENT '收藏开始时间',
  `updated_time` int(11) NOT NULL DEFAULT '0' COMMENT '收藏更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='用户收藏文章表';

```

#### 用户积分明细表

```mysql

CREATE TABLE `community_user_integral` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `payment_user_id` int(11)  unsigned NOT NULL DEFAULT '0' COMMENT '付款用户id',
  `receipt_user_id` int(11)  unsigned NOT NULL DEFAULT '0' COMMENT '收款用户id',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1 评论回答被采纳 2 文章付费',
  `origin_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '采纳，付费等等 id',
  `before_integral` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '之前积分',
  `current_integral` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '当前积分',
  `integral` int(11) NOT NULL DEFAULT '0' COMMENT '积分数量 【有加减】',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 正常  1删除',
  `created_time` int(11) NOT NULL DEFAULT '0' COMMENT '开始时间',
  `updated_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='用户收藏文章表';

```

#### 标签属性表

```mysql

CREATE TABLE `community_tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '标签表id',
  `type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '标签类型【1 技能类型标签，2 文章行业类型标签，3 文章属性类型标签】',
  `creator` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '标签创建者【0 系统，】',
  `title` varchar(45) NOT NULL COMMENT '标签名称',
  `status` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '0正常 1删除 2未开放',
  `updated_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `created_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COMMENT='标签属性表';

```

1. type 标签的类型 【1 用户技能类型标签 [PHP GO LINUX JS HTML CSS H5 MYSQL]】
【2 文章行业类型标签[PHP GO LINUX JS HTML CSS H5 MYSQL VUE VUEX NUXT UBUNTU CentOS]】
【3 文章属性类型标签[Issue Suggestion Optimization Future]】
1.  creator 标签的创建者 【0 系统创建 其余为用户ID用户创建】


#### 用户标签属性映射表

```mysql

CREATE TABLE `community_tag_map` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '标签类型【1 技能类型标签，2 文章行业类型标签，3 文章属性类型标签】',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `tag_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '标签id',
  `status` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '0正常 1删除 2未开放',
  `updated_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `created_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COMMENT='标签属性表';

```