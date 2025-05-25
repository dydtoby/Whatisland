/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 80041
Source Host           : localhost:3306
Source Database       : whatisland

Target Server Type    : MYSQL
Target Server Version : 80041
File Encoding         : 65001

Date: 2025-05-24 01:18:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `imooc_about_list`
-- ----------------------------
DROP TABLE IF EXISTS `imooc_about_list`;
CREATE TABLE `imooc_about_list` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `code` varchar(100) NOT NULL DEFAULT '',
  `content` text,
  `created_at` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of imooc_about_list
-- ----------------------------
INSERT INTO `imooc_about_list` VALUES ('31', '『库莉姆直播情报』', '', '全职陪伴系vup，出道日2021年4月25日/生日10月10日&lt;/br&gt;\r\n直播通知禁言群（无门槛）：124939430&lt;/br&gt;\r\n活跃粉丝团群（需要验证粉丝牌）：975747635&lt;/br&gt;\r\n注：非粉丝禁入，严禁小团体，牌子长期不点亮会移除&lt;/br&gt;\r\n阿姆是虚拟世界狂热厨，励志创造虚拟幻想乡，我们一起努力养成『沃布吉岛』家园吧&lt;/br&gt;\r\n粉丝名：icecream&lt;/br&gt;\r\n牌子：丢莉姆（Dream的谐音）&lt;/br&gt;\r\n二创TAG：#奶油星球的沃布吉岛#&lt;/br&gt;\r\n周边礼物返图TAG：#沃布吉岛藏宝图#&lt;/br&gt;\r\nicecream的日常合影TAG：#沃布吉岛旅行日记#（大家的日常记录）&lt;/br&gt;\r\n&lt;a href=&quot;https://space.bilibili.com/1555453291&quot; target=&quot;_blank&quot; style=&quot;color:rgb(59, 91, 209);&quot;&gt;库莉姆Cream的主页传送门&lt;/a&gt;&lt;/br&gt;\r\n&lt;a href=&quot;https://live.bilibili.com/22749172=&quot;_blank&quot; style=&quot;color:rgb(59, 91, 209);&quot;&gt;直播间传送门&lt;/a&gt;&lt;/br&gt;\r\n录播号&lt;a href=&quot;https://space.bilibili.com/1455308312&quot; target=&quot;_blank&quot; style=&quot;color:rgb(59, 91, 209);&quot;&gt;@小奶油保护协会&lt;/a&gt;&lt;/br&gt;\r\n&lt;p&gt;&mdash;&mdash;&lt;a href=&quot;https://www.bilibili.com/opus/1061254189444759558&quot; target=&quot;_blank&quot; style=&quot;color:rgb(59, 91, 209);&quot;&gt;《小奶油の秘密》&lt;/a&gt;&lt;/p&gt;', '2025-05-13 19:58:25');
INSERT INTO `imooc_about_list` VALUES ('32', '关于本站', '', '&lt;p&gt;本站创建于2025年5月20日，为纪念最伟大库莉姆Cream宝宝建立，本站用到的所有形象、素材资源的版权均归属于相应版权方。&lt;/p&gt;&lt;h3&gt;建站初衷&lt;/h3&gt;&lt;ul&gt;&lt;li&gt;给大家一个可以交流的地方&lt;/li&gt;&lt;li&gt;为库莉姆Cream提供可视化数据&lt;/li&gt;&lt;li&gt;课程作业...&lt;/li&gt;&lt;/ul&gt;&lt;h3&gt;其他说明&lt;/h3&gt;&lt;ul&gt;&lt;li&gt;出于部署便捷性以及隐私考虑，本站目前架设在境外，如访问困难可尝试通过代理访问&lt;/li&gt;&lt;li&gt;本网站未使用第三方统计工具，不会将访问数据提供给第三方&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;更多说明，请参考本站的隐私政策', '2025-05-13 19:59:16');
INSERT INTO `imooc_about_list` VALUES ('34', '隐私政策', '', '  &lt;p&gt;&lt;strong&gt;生效日期：&lt;/strong&gt;2025年5月20日&lt;br&gt;\r\n     &lt;strong&gt;更新日期：&lt;/strong&gt;2025年5月22日&lt;/p&gt;\r\n\r\n  &lt;p&gt;感谢您使用本平台服务！我们非常重视您的隐私保护，并承诺依据《中华人民共和国个人信息保护法》《中华人民共和国网络安全法》等相关法律法规，妥善保护您的个人信息安全。请在使用我们的产品或服务前，务必阅读并理解本隐私政策。&lt;/p&gt;\r\n\r\n  &lt;h2&gt;一、我们收集的信息&lt;/h2&gt;\r\n  &lt;p&gt;在您使用我们的社交和商城服务过程中，我们仅收集以下信息：&lt;/p&gt;\r\n  &lt;ul&gt;\r\n    &lt;li&gt;&lt;strong&gt;B站UID：&lt;/strong&gt;通过授权登录等方式绑定B站账户时，我们将获取您的公开UID作为唯一身份标识。不收集手机号、邮箱等其他敏感信息。&lt;/li&gt;\r\n    &lt;li&gt;&lt;strong&gt;自动收集的设备及行为信息：&lt;/strong&gt;如设备型号、操作系统、访问时间、IP地址、浏览行为等，用于优化服务与安全防护。&lt;/li&gt;\r\n  &lt;/ul&gt;\r\n\r\n  &lt;h2&gt;二、信息的使用目的&lt;/h2&gt;\r\n  &lt;ul&gt;\r\n    &lt;li&gt;创建和管理您的平台账户&lt;/li&gt;\r\n    &lt;li&gt;实现商城购物与售后服务&lt;/li&gt;\r\n    &lt;li&gt;支持社交功能，如评论、互动&lt;/li&gt;\r\n    &lt;li&gt;优化服务体验和系统安全&lt;/li&gt;\r\n    &lt;li&gt;遵守法律法规的相关义务&lt;/li&gt;\r\n  &lt;/ul&gt;\r\n\r\n  &lt;h2&gt;三、信息的存储与保护&lt;/h2&gt;\r\n  &lt;ul&gt;\r\n    &lt;li&gt;所有数据存储在中国境内的服务器&lt;/li&gt;\r\n    &lt;li&gt;采用加密、访问控制等行业标准措施保护安全&lt;/li&gt;\r\n    &lt;li&gt;在达成使用目的所需时间内保留，之后删除或匿名化处理&lt;/li&gt;\r\n  &lt;/ul&gt;\r\n\r\n  &lt;h2&gt;四、信息的共享与披露&lt;/h2&gt;\r\n  &lt;p&gt;我们不会出售或非法共享您的信息，除以下情况外：&lt;/p&gt;\r\n  &lt;ul&gt;\r\n    &lt;li&gt;法律法规或监管要求&lt;/li&gt;\r\n    &lt;li&gt;为实现必要功能与可信第三方共享&lt;/li&gt;\r\n    &lt;li&gt;经您明确同意&lt;/li&gt;\r\n  &lt;/ul&gt;\r\n\r\n  &lt;h2&gt;五、您的权利&lt;/h2&gt;\r\n  &lt;ul&gt;\r\n    &lt;li&gt;访问、更正或删除您的信息&lt;/li&gt;\r\n    &lt;li&gt;注销账户&lt;/li&gt;\r\n    &lt;li&gt;撤回授权&lt;/li&gt;\r\n    &lt;li&gt;获取有关隐私政策的解释&lt;/li&gt;\r\n  &lt;/ul&gt;\r\n\r\n  &lt;h2&gt;六、未成年人保护&lt;/h2&gt;\r\n  &lt;p&gt;本平台不面向14周岁以下未成年人提供服务。如您为未成年人，应在监护人指导下使用我们的服务。&lt;/p&gt;\r\n\r\n  &lt;h2&gt;七、Cookie与本地存储&lt;/h2&gt;\r\n  &lt;p&gt;我们使用Cookie和本地存储技术以提升体验，您可通过浏览器设置禁用，但可能影响部分功能使用。&lt;/p&gt;\r\n\r\n  &lt;h2&gt;八、政策变更&lt;/h2&gt;\r\n  &lt;p&gt;我们可能不时更新本政策，变更将在本页面公布，重大变更将通过公告或弹窗通知您。&lt;/p&gt;\r\n&lt;/body&gt;\r\n&lt;/html&gt;\r\n', '2025-05-22 06:41:20');
INSERT INTO `imooc_about_list` VALUES ('35', '特别感谢', '', '&lt;p&gt;特别感谢&lt;a href=&quot;https://laplace.live/&quot; target=&quot;_blank&quot; style=&quot;color:rgb(59, 91, 209);&quot;&gt;Laplace&lt;/a&gt;以及&lt;a href=&quot;https://vtbs.moe/&quot; target=&quot;_blank&quot; style=&quot;color:rgb(59, 91, 209);&quot;&gt;VTBS&lt;/a&gt;提供的api以及帮助&lt;/p&gt;', '2025-05-22 06:43:48');

-- ----------------------------
-- Table structure for `imooc_about_t`
-- ----------------------------
DROP TABLE IF EXISTS `imooc_about_t`;
CREATE TABLE `imooc_about_t` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL DEFAULT '',
  `code` varchar(100) NOT NULL DEFAULT '',
  `name` text,
  `created_at` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of imooc_about_t
-- ----------------------------
INSERT INTO `imooc_about_t` VALUES ('31', '姓名', '', '库莉姆Cream', '');
INSERT INTO `imooc_about_t` VALUES ('32', '年龄', '', '？？？', '');
INSERT INTO `imooc_about_t` VALUES ('33', '身高', '', '155 cm', '');
INSERT INTO `imooc_about_t` VALUES ('34', '星座', '', '天秤座', '');
INSERT INTO `imooc_about_t` VALUES ('35', '生日', '', '10月10日', '');

-- ----------------------------
-- Table structure for `imooc_admin`
-- ----------------------------
DROP TABLE IF EXISTS `imooc_admin`;
CREATE TABLE `imooc_admin` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `adminuser` varchar(50) NOT NULL DEFAULT '',
  `adminpass` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `created_at` varchar(255) NOT NULL DEFAULT '',
  `login_at` varchar(255) NOT NULL DEFAULT '',
  `login_ip` bigint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of imooc_admin
-- ----------------------------
INSERT INTO `imooc_admin` VALUES ('1', 'admin', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2019-01-23 20:21:03', '2025-05-24 01:11:26', '2130706433');

-- ----------------------------
-- Table structure for `imooc_cart`
-- ----------------------------
DROP TABLE IF EXISTS `imooc_cart`;
CREATE TABLE `imooc_cart` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `quantity` int unsigned NOT NULL DEFAULT '0',
  `products` text,
  `uid` int unsigned NOT NULL DEFAULT '0',
  `created_at` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of imooc_cart
-- ----------------------------

-- ----------------------------
-- Table structure for `imooc_jfdh`
-- ----------------------------
DROP TABLE IF EXISTS `imooc_jfdh`;
CREATE TABLE `imooc_jfdh` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `code` varchar(100) NOT NULL DEFAULT '',
  `description` text,
  `stock` int unsigned NOT NULL DEFAULT '0',
  `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `created_at` varchar(255) NOT NULL DEFAULT '',
  `images` varchar(255) NOT NULL,
  `jf` int unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of imooc_jfdh
-- ----------------------------
INSERT INTO `imooc_jfdh` VALUES ('18', '&uarr;&uarr;&darr;&darr;.gif', 'test1', '', '98', '0.00', '2025-05-20 18:57:44', 'uploads/jfdh/682c6028801dc_↑↑↓↓.gif', '100');

-- ----------------------------
-- Table structure for `imooc_jfdh_jl`
-- ----------------------------
DROP TABLE IF EXISTS `imooc_jfdh_jl`;
CREATE TABLE `imooc_jfdh_jl` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `uid` int unsigned NOT NULL DEFAULT '0',
  `created_at` varchar(255) NOT NULL DEFAULT '',
  `pid` int unsigned NOT NULL DEFAULT '0',
  `num` int unsigned NOT NULL DEFAULT '0',
  `total_jf` int unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of imooc_jfdh_jl
-- ----------------------------

-- ----------------------------
-- Table structure for `imooc_message`
-- ----------------------------
DROP TABLE IF EXISTS `imooc_message`;
CREATE TABLE `imooc_message` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `uid` int unsigned NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  `cid` int unsigned NOT NULL DEFAULT '0',
  `created_at` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of imooc_message
-- ----------------------------
INSERT INTO `imooc_message` VALUES ('17', '22', '投币！', '3', '2025-05-20 16:58:32', '将你想许下的愿望都发布在这里吧');
INSERT INTO `imooc_message` VALUES ('18', '22', '1111', '1', '2025-05-20 18:13:15', '111');

-- ----------------------------
-- Table structure for `imooc_message_cate`
-- ----------------------------
DROP TABLE IF EXISTS `imooc_message_cate`;
CREATE TABLE `imooc_message_cate` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `col` text NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of imooc_message_cate
-- ----------------------------
INSERT INTO `imooc_message_cate` VALUES ('1', '#4caf50', '综合吹水');
INSERT INTO `imooc_message_cate` VALUES ('2', '#cc2f4f', '求求资源');
INSERT INTO `imooc_message_cate` VALUES ('3', '#9751bd', '许愿池');

-- ----------------------------
-- Table structure for `imooc_order`
-- ----------------------------
DROP TABLE IF EXISTS `imooc_order`;
CREATE TABLE `imooc_order` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `quantity` int unsigned NOT NULL DEFAULT '0',
  `products` text,
  `uid` int unsigned NOT NULL DEFAULT '0',
  `created_at` varchar(255) NOT NULL DEFAULT '',
  `address` text NOT NULL,
  `name` text NOT NULL,
  `phone` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of imooc_order
-- ----------------------------

-- ----------------------------
-- Table structure for `imooc_product`
-- ----------------------------
DROP TABLE IF EXISTS `imooc_product`;
CREATE TABLE `imooc_product` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `code` varchar(100) NOT NULL DEFAULT '',
  `description` text,
  `stock` int unsigned NOT NULL DEFAULT '0',
  `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `created_at` varchar(255) NOT NULL DEFAULT '',
  `images` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of imooc_product
-- ----------------------------
INSERT INTO `imooc_product` VALUES ('31', '大头贴1-4', 'sdk:test', '', '97', '1.00', '2025-05-20 18:50:45', 'uploads/products/682c5ec93d091_大头贴1-4.png');
INSERT INTO `imooc_product` VALUES ('32', '大头贴5-8', 'sdk:test2', '', '98', '1.00', '2025-05-20 18:54:39', 'uploads/products/682c5f6f2a854_大头贴5-8.png');

-- ----------------------------
-- Table structure for `imooc_qd`
-- ----------------------------
DROP TABLE IF EXISTS `imooc_qd`;
CREATE TABLE `imooc_qd` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `jf` int NOT NULL,
  `userid` int unsigned NOT NULL DEFAULT '0',
  `created_at` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of imooc_qd
-- ----------------------------
INSERT INTO `imooc_qd` VALUES ('34', '5', '15', '2025-05-13 20:54:40');
INSERT INTO `imooc_qd` VALUES ('38', '5', '17', '2025-05-19 17:26:57');
INSERT INTO `imooc_qd` VALUES ('39', '5', '18', '2025-05-20 03:42:31');
INSERT INTO `imooc_qd` VALUES ('40', '5', '21', '2025-05-20 10:28:51');
INSERT INTO `imooc_qd` VALUES ('41', '5', '22', '2025-05-20 21:10:40');
INSERT INTO `imooc_qd` VALUES ('42', '5', '22', '2025-05-21 00:00:43');
INSERT INTO `imooc_qd` VALUES ('43', '5', '23', '2025-05-22 23:59:53');

-- ----------------------------
-- Table structure for `imooc_user`
-- ----------------------------
DROP TABLE IF EXISTS `imooc_user`;
CREATE TABLE `imooc_user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL DEFAULT '',
  `password` text NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `age` tinyint unsigned NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL DEFAULT '',
  `phone` varchar(20) NOT NULL DEFAULT '',
  `created_at` varchar(255) NOT NULL DEFAULT '',
  `jf` int NOT NULL DEFAULT '0',
  `uid` int NOT NULL DEFAULT '0',
  `images` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of imooc_user
-- ----------------------------
INSERT INTO `imooc_user` VALUES ('23', 'Test001', 'ed123f7a7277b8451becd84748700602445ade725386f89d67a056f003fb2d22', '', '0', '', '', '2025-05-22 23:56:54', '9999999', '2', 'i3.png');

-- ----------------------------
-- Table structure for `imooc_wp`
-- ----------------------------
DROP TABLE IF EXISTS `imooc_wp`;
CREATE TABLE `imooc_wp` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `files` text NOT NULL,
  `userid` int unsigned NOT NULL DEFAULT '0',
  `created_at` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of imooc_wp
-- ----------------------------

-- ----------------------------
-- Table structure for `imooc_zy`
-- ----------------------------
DROP TABLE IF EXISTS `imooc_zy`;
CREATE TABLE `imooc_zy` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `see` int unsigned NOT NULL DEFAULT '0',
  `down` int unsigned NOT NULL DEFAULT '0',
  `created_at` varchar(255) NOT NULL DEFAULT '',
  `images` varchar(255) NOT NULL,
  `tab` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of imooc_zy
-- ----------------------------
INSERT INTO `imooc_zy` VALUES ('19', '莓果可可恋人', '1', '1', '2025-05-20 15:56:56', 'uploads/zy/682c35c82e8ee_1莓果可可恋人.png', '小奶油衣橱');
INSERT INTO `imooc_zy` VALUES ('20', '芋泥眠眠卷', '1', '1', '2025-05-20 15:57:17', 'uploads/zy/682c35dd70189_2芋泥眠眠卷.png', '小奶油衣橱');
INSERT INTO `imooc_zy` VALUES ('21', '蜜桃香芋物语', '1', '1', '2025-05-20 15:57:35', 'uploads/zy/682c35ef5cfd7_3蜜桃香芋物语.png', '小奶油衣橱');
INSERT INTO `imooc_zy` VALUES ('22', '狐兔千层', '1', '1', '2025-05-20 15:57:54', 'uploads/zy/682c36020e5a4_4狐兔千层.png', '小奶油衣橱');
INSERT INTO `imooc_zy` VALUES ('24', '星屑可可', '1', '1', '2025-05-20 15:58:15', 'uploads/zy/682c3617ac0a8_5星屑可可.png', '小奶油衣橱');
INSERT INTO `imooc_zy` VALUES ('25', '奶霜桃桃密语', '1', '1', '2025-05-20 15:58:39', 'uploads/zy/682c362f4f08e_6奶霜桃桃密语.png', '小奶油衣橱');
INSERT INTO `imooc_zy` VALUES ('26', '红酒心朗姆', '1', '1', '2025-05-20 15:58:59', 'uploads/zy/682c3643a5fad_7红酒心朗姆.png', '小奶油衣橱');
INSERT INTO `imooc_zy` VALUES ('27', '雪绒紫薯', '1', '1', '2025-05-20 15:59:17', 'uploads/zy/682c3655b77c8_8雪绒紫薯.png', '小奶油衣橱');
INSERT INTO `imooc_zy` VALUES ('28', '黑糖珍珠雪媚', '1', '1', '2025-05-20 18:25:11', 'uploads/zy/682c58873543f_9黑糖珍珠雪媚.png', '小奶油衣橱');
INSERT INTO `imooc_zy` VALUES ('29', '雪梨琉璃酿', '1', '1', '2025-05-20 18:25:30', 'uploads/zy/682c589ad5edf_10雪梨琉璃酿.png', '小奶油衣橱');
INSERT INTO `imooc_zy` VALUES ('31', '圣诞相思恋', '1', '1', '2025-05-20 18:26:24', 'uploads/zy/682c58d0c14c5_11圣诞相思恋.png', '小奶油衣橱');
INSERT INTO `imooc_zy` VALUES ('32', '奥栗奥泥', '1', '1', '2025-05-20 18:26:49', 'uploads/zy/682c58e9eb993_12奥栗奥泥.png', '小奶油衣橱');
INSERT INTO `imooc_zy` VALUES ('33', '桃胶西米露', '1', '1', '2025-05-20 18:27:44', 'uploads/zy/682c59206e22a_13桃胶西米露.png', '小奶油衣橱');
INSERT INTO `imooc_zy` VALUES ('34', '焦糖蔷薇物语', '1', '1', '2025-05-20 18:28:10', 'uploads/zy/682c593a2aaf0_14焦糖蔷薇物语.png', '小奶油衣橱');
INSERT INTO `imooc_zy` VALUES ('35', '雪夜小猫饼', '1', '1', '2025-05-20 18:28:30', 'uploads/zy/682c594e22a80_15雪夜小猫饼.png', '小奶油衣橱');
INSERT INTO `imooc_zy` VALUES ('36', '午夜黑加仑', '1', '1', '2025-05-20 18:28:48', 'uploads/zy/682c5960b0b36_16午夜黑加仑.png', '小奶油衣橱');
INSERT INTO `imooc_zy` VALUES ('37', '蓝山奶霜拿铁', '1', '1', '2025-05-20 18:29:06', 'uploads/zy/682c5972e125d_17蓝山奶霜拿铁.png', '小奶油衣橱');
INSERT INTO `imooc_zy` VALUES ('38', '乌梅桑葚', '1', '1', '2025-05-20 18:29:26', 'uploads/zy/682c5986852a7_18乌梅桑葚.png', '小奶油衣橱');
INSERT INTO `imooc_zy` VALUES ('39', '暗夜紫米露', '1', '1', '2025-05-20 18:29:46', 'uploads/zy/682c599a5cfb7_19暗夜紫米露.png', '小奶油衣橱');
INSERT INTO `imooc_zy` VALUES ('40', '白玉杨梅', '1', '1', '2025-05-20 18:30:04', 'uploads/zy/682c59ac0e4a9_20白玉杨梅.png', '小奶油衣橱');
INSERT INTO `imooc_zy` VALUES ('41', '人鱼小紫苏', '1', '1', '2025-05-20 18:30:24', 'uploads/zy/682c59c04450c_21人鱼小紫苏.png', '小奶油衣橱');
INSERT INTO `imooc_zy` VALUES ('42', '黑米幽灵布蕾', '1', '1', '2025-05-20 18:30:41', 'uploads/zy/682c59fb1d7a9_22黑米幽灵布蕾.png', '小奶油衣橱');
INSERT INTO `imooc_zy` VALUES ('43', '莓巧美式', '1', '1', '2025-05-20 18:31:04', 'uploads/zy/682c59e805d53_23莓巧美式.png', '小奶油衣橱');
INSERT INTO `imooc_zy` VALUES ('44', '樱桃苏打', '1', '1', '2025-05-20 18:31:45', 'uploads/zy/682c5a1144b3a_24樱桃苏打.png', '小奶油衣橱');
INSERT INTO `imooc_zy` VALUES ('45', '焦糖栗栗拿铁', '1', '1', '2025-05-20 18:32:11', 'uploads/zy/682c5a3cade82_25焦糖栗栗拿铁.png', '小奶油衣橱');
INSERT INTO `imooc_zy` VALUES ('46', '莓桃巧巧', '1', '1', '2025-05-20 18:33:18', 'uploads/zy/682c5a6e86fc1_26莓桃巧巧.png', '小奶油衣橱');
INSERT INTO `imooc_zy` VALUES ('47', '春桃问酒', '1', '1', '2025-05-20 18:33:39', 'uploads/zy/682c5a9cb1b9f_27春桃问酒.png', '小奶油衣橱');
INSERT INTO `imooc_zy` VALUES ('48', '樱吹雪', '1', '1', '2025-05-20 18:33:42', 'uploads/zy/682c5acbd8d74_28樱吹雪.png', '小奶油衣橱');
INSERT INTO `imooc_zy` VALUES ('49', '小梨煎雪', '1', '1', '2025-05-20 18:35:13', 'uploads/zy/682c5ae168b9f_29小梨煎雪.png', '小奶油衣橱');
INSERT INTO `imooc_zy` VALUES ('50', '黑糖喵奇朵', '1', '1', '2025-05-20 18:35:32', 'uploads/zy/682c5af412b3d_30黑糖喵奇朵.png', '小奶油衣橱');
INSERT INTO `imooc_zy` VALUES ('51', '小爱神', '1', '1', '2025-05-20 18:35:53', 'uploads/zy/682c5b0912c99_31小爱神.png', '小奶油衣橱');
INSERT INTO `imooc_zy` VALUES ('53', '全收集！大头贴1-31', '1', '1', '2025-05-20 18:40:14', 'uploads/zy/682c5c0e0a8a2_大头贴all.png', '大头贴');
