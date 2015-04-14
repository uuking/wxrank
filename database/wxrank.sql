-- phpMyAdmin SQL Dump
-- version 4.2.8
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-04-14 23:46:20
-- 服务器版本： 5.6.10
-- PHP Version: 5.5.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wxrank`
--
CREATE DATABASE IF NOT EXISTS `wxrank` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `wxrank`;

-- --------------------------------------------------------

--
-- 表的结构 `wx_article`
--

CREATE TABLE IF NOT EXISTS `wx_article` (
`id` bigint(20) unsigned NOT NULL,
  `article_uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属公众号id',
  `article_title` varchar(500) NOT NULL DEFAULT '' COMMENT '文章标题',
  `article_content` longtext NOT NULL COMMENT '文章内容',
  `article_headimg` varchar(200) NOT NULL DEFAULT '' COMMENT '文章头图',
  `article_description` varchar(500) NOT NULL DEFAULT '' COMMENT '文章描述',
  `article_ctime` int(11) NOT NULL DEFAULT '0' COMMENT '微信文章原始创建时间',
  `article_status` int(11) NOT NULL DEFAULT '1' COMMENT '1显示0不显示',
  `article_place` int(11) NOT NULL DEFAULT '0' COMMENT '文章所处位置：1头条，2条，3条，4条'
) ENGINE=MyISAM AUTO_INCREMENT=61156 DEFAULT CHARSET=utf8 COMMENT='文章表';

-- --------------------------------------------------------

--
-- 表的结构 `wx_article_update`
--

CREATE TABLE IF NOT EXISTS `wx_article_update` (
  `article_id` bigint(20) unsigned NOT NULL COMMENT '所属文章id',
  `article_url` varchar(200) NOT NULL DEFAULT '' COMMENT '文章原始URL',
  `article_reads` int(11) NOT NULL DEFAULT '0' COMMENT '文章阅读数',
  `article_suports` int(11) NOT NULL DEFAULT '0' COMMENT '文章点赞数',
  `update_start` int(11) NOT NULL DEFAULT '0' COMMENT '开始更新时间',
  `update_next` int(11) NOT NULL DEFAULT '0' COMMENT '下次更新时间',
  `pinci` int(11) NOT NULL DEFAULT '0' COMMENT '公众号再发布该文章时七天内发文章的次数',
  `article_totals` int(11) NOT NULL DEFAULT '0' COMMENT '文章总分',
  `update_status` int(11) NOT NULL DEFAULT '0' COMMENT '0完成1未完成',
  `article_uid` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '公众号id',
  `article_ctime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文章原始创建时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章更新表';

-- --------------------------------------------------------

--
-- 表的结构 `wx_config`
--

CREATE TABLE IF NOT EXISTS `wx_config` (
`id` int(10) unsigned NOT NULL,
  `config_name` varchar(100) NOT NULL DEFAULT '' COMMENT '配置名称',
  `config_value` varchar(100) NOT NULL DEFAULT '' COMMENT '配置值'
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='配置表';

--
-- 转存表中的数据 `wx_config`
--

INSERT INTO `wx_config` (`id`, `config_name`, `config_value`) VALUES
(11, 'wxkey', 'b2574200810f04e8daabf8fdee2092b403d7a3756263af80e8fe302fc420e9fe90285d0e6a94a88098b7047761792bf6'),
(12, 'time', '1428066544'),
(13, 'gzh_update_interval', '8'),
(14, 'article_update_interval', '4'),
(15, 'days', '2'),
(16, 'uin', 'MjIwOTI2MDMyMQ%3D%3D'),
(17, 'uuid', 'd15262216a0f41'),
(18, 'read_weight', '0.5'),
(19, 'suport_weight', '0.3'),
(20, 'pinci_weight', '0.2'),
(21, 'deny_register_ip', ''),
(22, 'email_active', '1'),
(23, 'safe_str', '!(*&%'),
(24, 'site_name', 'wxrank'),
(25, 'admin_email', '1210889580@qq.com'),
(26, 'email_fromname', 'wxrank'),
(27, 'email_host', 'smtp.yeah.net'),
(28, 'email_password', 'zhangying521'),
(29, 'email_port', '25'),
(30, 'email_timeout', '2'),
(31, 'email_username', '15936177872@yeah.net'),
(32, 'deny_access_ip', '');

-- --------------------------------------------------------

--
-- 表的结构 `wx_errorlog`
--

CREATE TABLE IF NOT EXISTS `wx_errorlog` (
`id` int(10) unsigned NOT NULL,
  `error_content` text NOT NULL COMMENT '错误内容',
  `time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '时间',
  `from_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '出问题的id',
  `error_type` int(11) NOT NULL DEFAULT '0' COMMENT '错误的类别0为其它，1公众号，2文章'
) ENGINE=MyISAM AUTO_INCREMENT=7429477 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `wx_follow`
--

CREATE TABLE IF NOT EXISTS `wx_follow` (
  `from_id` bigint(20) unsigned NOT NULL COMMENT '关注用户id',
  `follow_id` int(10) unsigned NOT NULL COMMENT '被关注公众号id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `wx_gzhinfo`
--

CREATE TABLE IF NOT EXISTS `wx_gzhinfo` (
`id` int(10) unsigned NOT NULL,
  `gzh_tid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '公众号类别id',
  `gzh_name` varchar(100) NOT NULL DEFAULT '' COMMENT '公众号名称',
  `gzh_number` varchar(100) NOT NULL DEFAULT '' COMMENT '公众号微信号',
  `gzh_headimg` varchar(100) NOT NULL DEFAULT '' COMMENT '公众号头像',
  `gzh_codeimg` varchar(100) NOT NULL DEFAULT '' COMMENT '公众号二维码地址',
  `gzh_creatid` int(11) NOT NULL DEFAULT '0' COMMENT '创建人id',
  `gzh_ctime` int(11) NOT NULL DEFAULT '0' COMMENT '公众号创建时间',
  `gzh_openid` varchar(100) NOT NULL DEFAULT '' COMMENT '公众号openid',
  `gzh_order` int(11) NOT NULL DEFAULT '0' COMMENT '公众号显示排序从大到小,默认为0',
  `ghz_descript` varchar(300) NOT NULL DEFAULT '' COMMENT '公众号描述',
  `gzh_certified_text` varchar(300) NOT NULL DEFAULT '' COMMENT '公众号认证信息',
  `gzh_appid` varchar(100) NOT NULL DEFAULT '' COMMENT '公众号appid',
  `gzh_appsecret` varchar(100) NOT NULL DEFAULT '' COMMENT '公众号appsecret'
) ENGINE=MyISAM AUTO_INCREMENT=950 DEFAULT CHARSET=utf8 COMMENT='公众号信息';

-- --------------------------------------------------------

--
-- 表的结构 `wx_gzh_rank`
--

CREATE TABLE IF NOT EXISTS `wx_gzh_rank` (
`id` int(10) unsigned NOT NULL,
  `gzh_id` int(11) NOT NULL DEFAULT '0' COMMENT '公众号id',
  `count_read` int(11) NOT NULL DEFAULT '0' COMMENT '阅读数',
  `count_suport` int(11) NOT NULL DEFAULT '0' COMMENT '点赞数',
  `count_article` int(11) NOT NULL DEFAULT '0' COMMENT '文章总数',
  `totals` int(11) NOT NULL DEFAULT '0' COMMENT '总分',
  `rank_time` int(11) NOT NULL DEFAULT '0' COMMENT '日期',
  `rank_num` int(11) NOT NULL DEFAULT '0' COMMENT '排名',
  `count_topnew` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '头条文章个数',
  `count_topread` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '阅读数大于10万的文章数'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='公众号排行表';

-- --------------------------------------------------------

--
-- 表的结构 `wx_gzh_update`
--

CREATE TABLE IF NOT EXISTS `wx_gzh_update` (
  `gzh_id` int(10) unsigned NOT NULL COMMENT '公众号id',
  `biaoshi` varchar(100) NOT NULL DEFAULT '' COMMENT '唯一标示',
  `start_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新开始时间',
  `next_time` int(11) NOT NULL DEFAULT '0' COMMENT '下次更新次数',
  `error_num` int(11) NOT NULL DEFAULT '0' COMMENT '获取信息错误次数',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态：0不更新，1更新中，2更新但排行不显示'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='公众号更新信息';

-- --------------------------------------------------------

--
-- 表的结构 `wx_mail_log`
--

CREATE TABLE IF NOT EXISTS `wx_mail_log` (
`id` int(10) unsigned NOT NULL,
  `accept` varchar(50) DEFAULT NULL COMMENT '收件人邮箱',
  `subject` varchar(100) DEFAULT NULL COMMENT '邮件标题',
  `message` text COMMENT '邮件内容',
  `sendtime` int(10) unsigned DEFAULT NULL COMMENT '发送时间',
  `status` enum('waiting','success','failed') DEFAULT 'waiting' COMMENT '当前邮件状态(待发送、发送成功、发送失败)',
  `level` enum('1','2','3') DEFAULT '3' COMMENT '邮件优先级(越小越优先)',
  `times` tinyint(2) unsigned DEFAULT '0' COMMENT '发送次数',
  `error` varchar(100) DEFAULT NULL COMMENT '错误信息'
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COMMENT='发送邮件日志';

--
-- 转存表中的数据 `wx_mail_log`
--

INSERT INTO `wx_mail_log` (`id`, `accept`, `subject`, `message`, `sendtime`, `status`, `level`, `times`, `error`) VALUES
(7, '326196998@qq.com', '测试邮件标题', '测试邮件内容', 1405053583, 'failed', '3', 1, 'SMTP 错误：无法连接到 SMTP 主机。'),
(8, '326196998@qq.com', '测试邮件标题', '测试邮件内容', 1405053614, 'success', '3', 1, ''),
(9, '326196998@qq.com', '测试邮件标题', '测试邮件内容', 1405057618, 'success', '3', 1, ''),
(10, '326196998@qq.com', '测试邮件标题', '测试邮件内容', 1405057700, 'failed', '3', 1, '发送地址错误：YiifCMS官方<p>SMTP server error: Invalid User\r\n</p>\r\n'),
(11, '326196998@qq.com', '测试邮件标题', '测试邮件内容', 1405057900, 'failed', '3', 1, '发送地址错误：YiifCMS官方<p>SMTP server error: Invalid User\r\n</p>\r\n'),
(21, 'admin', 'yii内容管理系统 重置密码', '\r\n			<p>尊敬的用户：admin 您好，您已经申请找回密码服务，请点击下面链接进行密码重置：<br/><br/>\r\n			<a href="http://www.yii.local/?r=user/resetPwd&id=1&authcode=ODl0bivszkTuY">http://www.yii.local/?r=user/resetPwd&id=1&authcode=ODl0bivszkTuY</a><br/><br/>(如果上面链接不能点击，请复制到浏览器地址栏中进行访问。)<br/><br/>\r\n			==================<br/><br/>请确保是本人操作，如果有其他疑问，\r\n			请联系本网站的管理员：<a href="mailto:"></a>。</p>\r\n	', 1405478217, 'failed', '3', 1, '必须提供至少一个收件人地址。'),
(49, '1210889580@qq.com', '账号激活', '<p>尊敬的新用户：wxread 您好，欢迎注册yiifcms打造顶级内容管理系统，为了更好的为您服务，请尽快点击下面链接进行账号激活：<br/><br/>\r\n						<a href="http://localhost/yiicms/?r=user/authEmail&authcode=4ca4L2ZeveHea808UqzbVS%252BRNmTV2yTcdF%252B4e41a">http://localhost/yiicms/?r=user/authEmail&authcode=4ca4L2ZeveHea808UqzbVS%252BRNmTV2yTcdF%252B4e41a</a><br/><br/>(如果上面链接不能点击，请复制到浏览器地址栏中进行访问。)<br/><br/>\r\n						==================<br/><br/>再次感谢您的光顾，如果有其他疑问，\r\n						请联系本网站的管理员：<a href="mailto:admin@126.com">admin@126.com</a>。</p>', 1428836756, 'failed', '3', 1, 'SMTP 错误：无法连接到 SMTP 主机。'),
(50, '1210889580@qq.com', '账号激活', '<p>尊敬的新用户：wxread 您好，欢迎注册yiifcms打造顶级内容管理系统，为了更好的为您服务，请尽快点击下面链接进行账号激活：<br/><br/>\r\n						<a href="http://localhost/yiicms/?r=user/authEmail&authcode=5a56L2a4AEO5l9ESqI1lHo2vhy73S4BHJetIrHaEEQ">http://localhost/yiicms/?r=user/authEmail&authcode=5a56L2a4AEO5l9ESqI1lHo2vhy73S4BHJetIrHaEEQ</a><br/><br/>(如果上面链接不能点击，请复制到浏览器地址栏中进行访问。)<br/><br/>\r\n						==================<br/><br/>再次感谢您的光顾，如果有其他疑问，\r\n						请联系本网站的管理员：<a href="mailto:admin@126.com">admin@126.com</a>。</p>', 1428836884, 'success', '3', 1, NULL),
(51, '1210889580@qq.com', '账号激活', '<p>尊敬的新用户：shijunxian 您好，欢迎注册wxrank，为了更好的为您服务，请尽快点击下面链接进行账号激活：<br/><br/>\r\n						<a href="http://wxrank.com/user/authEmail?authcode=3db5eiTTy%252BMlv0cEXXZFZg5GaOSlh42o0T1YHYTt7A">http://wxrank.com/user/authEmail?authcode=3db5eiTTy%252BMlv0cEXXZFZg5GaOSlh42o0T1YHYTt7A</a><br/><br/>(如果上面链接不能点击，请复制到浏览器地址栏中进行访问。)<br/><br/>\r\n						==================<br/><br/>再次感谢您的光顾，如果有其他疑问，\r\n						请联系本网站的管理员：<a href="mailto:1210889580@qq.com">1210889580@qq.com</a>。</p>', 1429021112, 'success', '3', 1, NULL),
(52, '1210889580@qq.com', '账号激活', '<p>尊敬的新用户：1210889580@qq.com 您好，欢迎注册wxrank，为了更好的为您服务，请尽快点击下面链接进行账号激活：<br/><br/>\r\n						<a href="http://wxrank.com/user/authEmail?authcode=0e1aEUzoErFHlN2AsxXqwBCD8fEKxMUXR2flRq5EDQ">http://wxrank.com/user/authEmail?authcode=0e1aEUzoErFHlN2AsxXqwBCD8fEKxMUXR2flRq5EDQ</a><br/><br/>(如果上面链接不能点击，请复制到浏览器地址栏中进行访问。)<br/><br/>\r\n						==================<br/><br/>再次感谢您的光顾，如果有其他疑问，\r\n						请联系本网站的管理员：<a href="mailto:1210889580@qq.com">1210889580@qq.com</a>。</p>', 1429024809, 'success', '3', 1, NULL),
(53, '1210889580@qq.com', '账号激活', '<p>尊敬的新用户：1210889580@qq.com 您好，欢迎注册wxrank，为了更好的为您服务，请尽快点击下面链接进行账号激活：<br/><br/>\r\n						<a href="http://wxrank.com/user/authEmail?authcode=8825I3UdvKav52jsOnILMo7sPH2hdpq%252FY4qLuXG55A">http://wxrank.com/user/authEmail?authcode=8825I3UdvKav52jsOnILMo7sPH2hdpq%252FY4qLuXG55A</a><br/><br/>(如果上面链接不能点击，请复制到浏览器地址栏中进行访问。)<br/><br/>\r\n						==================<br/><br/>再次感谢您的光顾，如果有其他疑问，\r\n						请联系本网站的管理员：<a href="mailto:1210889580@qq.com">1210889580@qq.com</a>。</p>', 1429025155, 'success', '3', 1, NULL),
(54, '2213147763@qq.com', '账号激活', '<p>尊敬的新用户：yuanyuan 您好，欢迎注册wxrank，为了更好的为您服务，请尽快点击下面链接进行账号激活：<br/><br/>\r\n						<a href="http://wxrank.com/user/authEmail?authcode=61744Hn3IAZhXAo5fF6PRE97Mcv7aJ%252FZJXqivkyGAg">http://wxrank.com/user/authEmail?authcode=61744Hn3IAZhXAo5fF6PRE97Mcv7aJ%252FZJXqivkyGAg</a><br/><br/>(如果上面链接不能点击，请复制到浏览器地址栏中进行访问。)<br/><br/>\r\n						==================<br/><br/>再次感谢您的光顾，如果有其他疑问，\r\n						请联系本网站的管理员：<a href="mailto:1210889580@qq.com">1210889580@qq.com</a>。</p>', 1429025481, 'success', '3', 1, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `wx_search`
--

CREATE TABLE IF NOT EXISTS `wx_search` (
`id` int(10) unsigned NOT NULL,
  `search_content` varchar(250) NOT NULL DEFAULT '' COMMENT '搜索内容',
  `search_count` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '搜索次数',
  `search_type` int(11) NOT NULL DEFAULT '1' COMMENT '搜索类别：1公众号，0文章',
  `search_uid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '如果登陆则是登陆用户id,未登录则是0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='搜索表';

-- --------------------------------------------------------

--
-- 表的结构 `wx_term`
--

CREATE TABLE IF NOT EXISTS `wx_term` (
`id` int(11) NOT NULL,
  `term_name` varchar(500) NOT NULL DEFAULT '',
  `term_parent` int(11) NOT NULL DEFAULT '0' COMMENT '父分类id',
  `term_order` int(11) NOT NULL DEFAULT '0' COMMENT '分类排序从大到小'
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wx_term`
--

INSERT INTO `wx_term` (`id`, `term_name`, `term_parent`, `term_order`) VALUES
(1, '资讯·阅读', 0, 0),
(2, '名人·明星', 0, 0),
(3, '生活·购物', 0, 0),
(4, '影音·娱乐', 0, 0),
(5, '社区·交友', 0, 0),
(6, '文化·教育', 0, 0),
(7, '海外·其他', 0, 0),
(8, '演员', 2, 0),
(9, '歌手', 2, 0),
(10, '模特', 2, 0),
(11, '体育', 2, 0),
(12, '科技', 2, 0),
(13, '财经', 2, 0),
(14, '文化', 2, 0),
(15, '时尚', 2, 0),
(16, '房地产', 2, 0),
(17, '教育', 2, 0),
(18, '其它', 2, 0),
(19, '美图', 4, 0),
(20, '影视', 4, 0),
(21, '音乐', 4, 0),
(22, '搞笑', 4, 0),
(23, '星座', 4, 0),
(24, '美女', 4, 0),
(25, '动漫', 4, 0),
(26, '语录', 4, 0),
(27, '游戏', 4, 0),
(28, '八卦', 4, 0),
(29, '其它', 4, 0),
(30, '新闻', 1, 0),
(31, '科技', 1, 0),
(32, '汽车', 1, 0),
(33, '女性', 1, 0),
(34, '综合', 1, 0),
(35, '小说', 1, 0),
(36, '房产', 1, 0),
(37, '财经', 1, 0),
(38, '体育', 1, 0),
(39, '公益', 1, 0),
(40, '其它', 1, 0),
(41, '购物', 3, 0),
(42, '家居', 3, 0),
(43, '时尚', 3, 0),
(44, '逛街', 3, 0),
(45, '美食', 3, 0),
(46, '旅游', 3, 0),
(47, '宠物', 3, 0),
(48, '休闲', 3, 0),
(49, '生活', 3, 0),
(50, '健康', 3, 0),
(51, '创意', 3, 0),
(52, '天气', 3, 0),
(53, '其它', 3, 0),
(54, '社区', 5, 0),
(55, '交友', 5, 0),
(56, '职场', 5, 0),
(57, '婚恋', 5, 0),
(58, '招聘', 5, 0),
(59, '其它', 5, 0),
(60, '读书', 6, 0),
(61, '高校', 6, 0),
(62, '外语', 6, 0),
(63, '教育', 6, 0),
(64, '历史', 6, 0),
(65, '育儿', 6, 0),
(66, '其它', 6, 0),
(67, '兴趣', 7, 0),
(68, '互联网', 7, 0),
(69, '移动互联网', 7, 0),
(70, '电商', 7, 0),
(71, '其它', 7, 0),
(72, '自媒体', 2, 0);

-- --------------------------------------------------------

--
-- 表的结构 `wx_user`
--

CREATE TABLE IF NOT EXISTS `wx_user` (
`id` int(10) unsigned NOT NULL,
  `user_login` varchar(60) NOT NULL DEFAULT '' COMMENT '用户名',
  `user_pass` varchar(64) NOT NULL DEFAULT '' COMMENT '密码',
  `user_nicename` varchar(50) NOT NULL DEFAULT '' COMMENT '昵称',
  `user_email` varchar(100) NOT NULL DEFAULT '' COMMENT '注册Email',
  `user_registered` int(11) NOT NULL DEFAULT '0' COMMENT '注册时间',
  `user_status` tinyint(11) NOT NULL DEFAULT '-1' COMMENT '-1待审核 0 -禁用  1-通过'
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='用户表';

--
-- 转存表中的数据 `wx_user`
--

INSERT INTO `wx_user` (`id`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_registered`, `user_status`) VALUES
(13, '1210889580@qq.com', '$2y$08$Jo9jvG10d023NKjG0GAQm.MJfh2q2x7/pFdrJmAU4ugzH4SPX3Ooq', 'shijunxian', '1210889580@qq.com', 1429025155, -1),
(14, 'yuanyuan', '$2y$08$IT6AkLt3Baor3sd1dIjaq.r7k7B/wZbBe1PrAWE9X1gvURop3hwlK', 'yuanyuan', '2213147763@qq.com', 1429025479, -1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wx_article`
--
ALTER TABLE `wx_article`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`), ADD KEY `article_uid` (`article_uid`);

--
-- Indexes for table `wx_article_update`
--
ALTER TABLE `wx_article_update`
 ADD PRIMARY KEY (`article_id`), ADD UNIQUE KEY `article_id_UNIQUE` (`article_id`), ADD KEY `fk_wx_article_update_wx_article1_idx` (`article_id`);

--
-- Indexes for table `wx_config`
--
ALTER TABLE `wx_config`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `wx_errorlog`
--
ALTER TABLE `wx_errorlog`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `wx_follow`
--
ALTER TABLE `wx_follow`
 ADD PRIMARY KEY (`from_id`), ADD KEY `fk_wx_follow_wx_user1_idx` (`from_id`), ADD KEY `fk_wx_follow_wx_gzhinfo1_idx` (`follow_id`);

--
-- Indexes for table `wx_gzhinfo`
--
ALTER TABLE `wx_gzhinfo`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`), ADD UNIQUE KEY `gzh_number` (`gzh_number`), ADD KEY `gzh_tid` (`gzh_tid`);

--
-- Indexes for table `wx_gzh_rank`
--
ALTER TABLE `wx_gzh_rank`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `wx_gzh_update`
--
ALTER TABLE `wx_gzh_update`
 ADD PRIMARY KEY (`gzh_id`), ADD UNIQUE KEY `gzh_id_UNIQUE` (`gzh_id`), ADD KEY `gzh_id` (`gzh_id`);

--
-- Indexes for table `wx_mail_log`
--
ALTER TABLE `wx_mail_log`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wx_search`
--
ALTER TABLE `wx_search`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`), ADD KEY `fk_wx_search_wx_user1_idx` (`search_uid`);

--
-- Indexes for table `wx_term`
--
ALTER TABLE `wx_term`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wx_user`
--
ALTER TABLE `wx_user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`), ADD UNIQUE KEY `user_login_UNIQUE` (`user_login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wx_article`
--
ALTER TABLE `wx_article`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61156;
--
-- AUTO_INCREMENT for table `wx_config`
--
ALTER TABLE `wx_config`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `wx_errorlog`
--
ALTER TABLE `wx_errorlog`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7429477;
--
-- AUTO_INCREMENT for table `wx_gzhinfo`
--
ALTER TABLE `wx_gzhinfo`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=950;
--
-- AUTO_INCREMENT for table `wx_gzh_rank`
--
ALTER TABLE `wx_gzh_rank`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wx_mail_log`
--
ALTER TABLE `wx_mail_log`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `wx_search`
--
ALTER TABLE `wx_search`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wx_term`
--
ALTER TABLE `wx_term`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `wx_user`
--
ALTER TABLE `wx_user`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
