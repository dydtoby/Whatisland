# WhatIsland Online Mall And Blog System
## The website has been deployed on: https://whatisland.online/shop/
## github:https://github.com/dydtoby/Whatisland.git
## Module code (COM6023M)
## Name:Yudong.Du

This project is an e-commerce+blog platform based on PHP and MySQL, which includes a complete front-end mall page and back-end management system, suitable for deployment on any server for testing and demonstration.

## Project Structure
whatisland.online/
├── admin/ # background management system(server side)
├── api/ # Interface Service Catalog
├── shop/ # Front end shopping mall page(client side)
├── uploads/ # User uploaded file directory
├── config.php # Website configuration file
├── db.func.php # Database operation functions
├── tools.func.php # utilities
├── localhost.sql # Database export file

## Environmental requirements

- PHP 7.2+
- MySQL 5.7+
- Web server (recommended Apache or Nginx)

## quick start

1. Clone or unzip the project to the root directory of your web server.
2. Create database (sql)：
   - Import the 'localhost. sql' file using PHPMyAdmin or the command line
3. Modify configuration：
   - Edit 'config.php' to set database connection information.
4. visit：
   - client address：`http://yourdomain.com/shop/`
   - server address：`http://yourdomain.com/admin/`
   - Default test server account:admin
   - Default test server password:123456(Using md5 encryption in .sql files)
   - Default test client account:Test001
   - Default test client password:Test123456@(Using sha256 encryption in .sql files)

## Rapid Deployment
   - Install BT panel（https://www.bt.cn/new/btcode.htm）
   Ubuntu/Deepin set up script
   wget -O install.sh http://download.bt.cn/install/install-ubuntu_6.0.sh && sudo bash install.sh
   - LaunchPad
   - Install<Apache/Nginx>,<MySQL 5.7+>,<phpmyadmin>,<php 7.2+>
   - click<website>-<PHP project>-<add website>, enter your domain name, select MySQL for the database, and select PHP 7.2 for the PHP version+
   - Click on the database, add the database, set the database name, username, password, and modify the corresponding values in config. php at the same time. Import data tables using PHPMyAdmin
   - start<Apache/Nginx>,<MySQL 5.7+>
   - 

## Introduction to backend functions

The backend includes the following functional modules：

- Administrator login and permission control
- Product management (add, delete, modify, search)
- Panel content management (add, delete, modify, search)
- Classification management
- User Management
- Order Management and Export
- Message system
- Points redemption and redemption records

## Upload directory instructions

Upload files and store them uniformly in the '/uploads' directory. Please ensure that this directory has write permission.

## API

If you need to expand the integration of mobile devices or mini programs, you can refer to the contents of the 'API/' directory for interface calls.
- The following is a detailed explanation

### Internal API
1) /api/Message.php(Message API)
Basic URL：http://yourdomain.com/message.php
data format：JSON
method   Endpoint             Function Description	Authentication Required
GET	   /message.php	      Get the message list	N/A
POST	   /message.php	      Create a new message	need
PUT	   /message.php	      Update message	      need
DELETE	/message.php?id={id}	Delete message	      need

1. Get message list/details
Endpoint information
‌URL‌: /api/message.php[?id=1&page=2&per_page=15&cid=3&search=关键词]
method‌: GET
- Parameter Description
parameter   type	 REQUIRED	describe	                                        Default value
id	        int	   deny	    Specify message ID (to obtain a single message)	  -
page	      int	   deny	    Current page number	                              1
per_page  	int	   deny	    Display quantity per page (range 5-50)	          15
cid	        int	   deny	    Classification filtering (0 means no filtering)	  0
search	   string	 deny	    Global search keywords (title/content)            -
- Request Example
httpCopy Code
GET /api/message.php?page=2&per_page=10&cid=5&search=内容
- Successful response
jsonCopy Code
{
  "code": 200,
  "msg": "",
  "data": [
    {
      "id": 45,
      "title": "标题",
      "message": "内容.",
      "cate_name": "分类名",
      "col": "#FF5733",
      "created_at": "2025-05-15 14:22:18",
      "username": "admin"
    }
  ],
  "total": 85,
  "page": 2}
- Error examples‌：
jsonCopy Code
{
  "code": 400,
  "msg": "数据查询错误（Data query error）"}


2. Create a message
Endpoint information
‌URL‌: /api/message.php
Method‌: POST
‌Content-Type‌: application/x-www-form-urlencoded
- Request parameters
parameter	type	   REQUIRED	describe
title	    string   correct	Message title (2-50 words)
uid	      int	     correct	user id
cid	      int	     correct	Classification ID
message	  string	 correct	Message content (10-500 words)
- Request Example
httpCopy Code
POST /api/message.php
title=标题（title）&uid=12&cid=3&message=内容（message）
- Successful response
jsonCopy Code
{
  "code": 200,
  "msg": "添加成功（Added successfully）"}

3. Update message
Endpoint information
‌URL‌: /api/message.php
‌方法‌: PUT
‌Content-Type‌: application/x-www-form-urlencoded
- Request parameters
parameter	type	   REQUIRED	   describe
id	      int	     correct	   Message ID to be modified
title	    string	 correct 	   new title
uid	      int	     correct	   user id
cid	      int	     correct	   New Category ID
message	  string	 correct	   new content
New content
httpCopy Code
PUT /api/message.php
id=32&title=修改后标题（Revised title）&uid=12&cid=5&message=更新后的内容（Updated content）...
- Successful response
jsonCopy Code
{
  "code": 200,
  "msg": "更新成功"}

4. Delete message
Endpoint information
URL‌: /api/message.php?id=32
method‌: DELETE
Request Example
httpCopy Code
DELETE /api/message.php?id=32
- Successful response
jsonCopy Code
{
  "code": 200,
  "msg": "删除成功（Delete successfully）"}

- Delete as an error handling standard
All error responses contain the following fields：
jsonCopy Code
{
  "code": 400,
  "msg": "具体错误描述（Specific error description）"}

2) /api/categories.php(Classification API)
Endpoint information
‌URL‌: /api/categories.php
Method‌: GET
- Request Example
httpCopy Code
GET /api/categories.php
Successful response
jsonCopy Code
{
  "code": 200,
  "data": [
    {
      "id": 3,
      "name": "分类1（Category 1）",
      "col": "#4CAF50"
    },
    {
      "id": 2,
      "name": "分类2（Category 2）",
      "col": "#2196F3"
    },
  ]
}

3) /api/users.php(User API)
Endpoint information
‌URL‌: /api/users.php
Method‌: GET
- Request Example
httpCopy Code
GET /api/users.php
- Successful response
{
  "code": 200,
  "data": [
    {
      "id": 1001,
      "username": "admin"
    },
    {
      "id": 1000,
      "username": "guest"
    }
  ]}

### External API

4) Obtain personal information
https://api.vtbs.moe/v1/detail/1555453291
Detail https://api.vtbs.moe/v1/detail/:mid
=> Object, {mid, uname, …}
https://github.com/dd-center/vtbs.moe/blob/master/api.md
Return record of certain vtb based on given mid.
Example: https://api.vtbs.moe/v1/detail/349991143
{
  "mid": 349991143,
  "uname": "神楽めあOfficial",
  "video": 188,
  "roomid": 12235923,
  "sign": "这里是神楽めあ(KaguraMea)！来自日本的清楚系虚拟YouTuber～weibo:@kaguramea　",
  "notice": "",
  "face": "http://i2.hdslb.com/bfs/face/49e143e1cae7f9e51b36c6c670976a95cc41ce12.jpg",
  "rise": 998,
  "topPhoto": "http://i0.hdslb.com/bfs/space/cde2a0fe3273ae4466d135541d965e21c58a7454.png",
  "archiveView": 21543188,
  "follower": 366159,
  "liveStatus": 0,
  "recordNum": 1268,
  "guardNum": 970,
  "liveNum": 559,
  "lastLive": {
    "online": 354234,
    "time": 1558976168120
  },
  "averageLive": 21271218.38426421,
  "weekLive": 0,
  "guardChange": 953,
  "guardType": [1, 15, 960],
  "areaRank": 2,
  "online": 0,
  "title": "【B限】MeAqua 協力お料理!!!!",
  "time": 1560103157470
}

5) Get history of video views and follower counts.
https://api.vtbs.moe/v2/bulkActive/1555453291
Active https://api.vtbs.moe/v2/bulkActive/:mid
=> Array, [...{archiveView, follower, time}]
History of video views and follower counts.
Example: https://api.vtbs.moe/v2/bulkActive/349991143
[{
    "archiveView": 16222668,
    "follower": 298364,
    "time": 1555247781729
  }, {
    "archiveView": 16222668,
    "follower": 298942,
    "time": 1555276084544
  },
  ...
]
- Keys:
   archiveView: Number
   Video views
   follower: Number
   Followers
   time: Number
   Timestamp

6) Get guard changes
https://api.vtbs.moe/v2/bulkGuard/1555453291
Guard https://api.vtbs.moe/v2/bulkGuard/:mid
=> Array, [...{guardNum, areaRank, time}]
History of guard changes.

7) Get avatar from bilibili.com
https://subspace.institute/docs/open-platform/bilibili-avatar/uid
Provide a user UID, which returns the corresponding Bilibili user avatar. This API is mainly used for displaying whatisland user avatars
API Base: https://workers.vrp.moe/bilibili/avatar/<uid>
Params
uid: 用户 UID
Queries
size?: Avatar size, default is 240
Caching: 3600 sec
Why?
Due to the fact that Bilibili.com's avatar images do not allow CORS cross domain calls, and avatar URLs are provided in an unordered hash format, an intermediate service is needed to proxy the acquisition of avatar images
function Avatar() {
  return (
    <img
      src={`https://workers.vrp.moe/bilibili/avatar/1555453291`}
      referrerPolicy='no-referrer'
      loading='lazy'
      alt='avatar'
    />
  )
}

8) Get weather
https://api.openweathermap.org/data/2.5/forecast?q=London&appid=appid&units=metric&cnt=10
How to make an API call
You can search weather forecast for 5 days with data every 3 hours by geographic coordinates. All weather data can be obtained in JSON and XML formats.
- API call
api.openweathermap.org/data/2.5/forecast?lat={lat}&lon={lon}&appid={API key}
Parameters
- lat	required	Latitude. If you need the geocoder to automatic convert city names and zip-codes to geo coordinates and the other way around, please use our Geocoding API
- lon	required	Longitude. If you need the geocoder to automatic convert city names and zip-codes to geo coordinates and the other way around, please use our Geocoding API
- appid	required	Your unique API key (you can always find it on your account page under the "API key" tab)
- units	optional	Units of measurement. standard, metric and imperial units are available. If you do not use the units parameter, standard units will be applied by default. Learn more
- mode	optional	Response format. JSON format is used by default. To get data in XML format use mode=xml. Learn more
- cnt	optional	A number of timestamps, which will be returned in the API response. Learn more
- units	optional	Units of measurement. standard, metric and imperial units are available. If you do not use the units parameter, standard units will be applied by default. Learn more
- lang	optional	You can use the lang parameter to get the output in your language. Learn more

https://openweathermap.org/

## Sql
### SQL Structural Overview
1. imooc_about_list
Used to store page content.
The stored content contains HTML tags and is rich text.

2. imooc_about_t
Store the basic information of the anchor (such as name, birthday, zodiac sign, etc.), and the table structure design tends to display personal profiles.

3. imooc_admin
Administrator account information table.

4. imooc_cart, imooc_order
Used for e-commerce shopping cart and order management, indicating that the site has mall functionality.

5. imooc_jfdh, imooc_jfdh_jl
The "points redemption" module supports the redemption and recording of point based products.

6. imooc_message, imooc_message_cate
User message board and categorization（如“许愿池”、“求求资源”）(such as "Trevi Fountain", "Ask for resources").。

### DDL
-- 创建数据库(CREATE DATABASE)
CREATE DATABASE IF NOT EXISTS `whatisland` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `whatisland`;

-- 表结构(Table Structure)：imooc_about_list
CREATE TABLE `imooc_about_list` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL DEFAULT '',
  `code` varchar(100) NOT NULL DEFAULT '',
  `content` text,
  `created_at` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 表结构(Table Structure)：imooc_about_t
CREATE TABLE `imooc_about_t` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL DEFAULT '',
  `code` varchar(100) NOT NULL DEFAULT '',
  `name` text,
  `created_at` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 表结构(Table Structure)：imooc_admin
CREATE TABLE `imooc_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `adminuser` varchar(50) NOT NULL DEFAULT '',
  `adminpass` char(32) NOT NULL DEFAULT '',
  `created_at` varchar(255) NOT NULL DEFAULT '',
  `login_at` varchar(255) NOT NULL DEFAULT '',
  `login_ip` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 表结构(Table Structure)：imooc_cart
CREATE TABLE `imooc_cart` (
  `id` int(10) UNSIGNED NOT NULL,
  `price` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `products` text,
  `uid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 表结构(Table Structure)：imooc_jfdh
CREATE TABLE `imooc_jfdh` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL DEFAULT '',
  `code` varchar(100) NOT NULL DEFAULT '',
  `description` text,
  `stock` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `price` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `created_at` varchar(255) NOT NULL DEFAULT '',
  `images` varchar(255) NOT NULL,
  `jf` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 表结构(Table Structure)：imooc_jfdh_jl
CREATE TABLE `imooc_jfdh_jl` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL DEFAULT '',
  `uid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` varchar(255) NOT NULL DEFAULT '',
  `pid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `num` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `total_jf` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 表结构(Table Structure)：imooc_message
CREATE TABLE `imooc_message` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  `cid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 表结构(Table Structure)：imooc_message_cate
CREATE TABLE `imooc_message_cate` (
  `id` int(10) UNSIGNED NOT NULL,
  `col` text NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 表结构(Table Structure)：imooc_order
CREATE TABLE `imooc_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `price` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `products` text,
  `uid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` varchar(255) NOT NULL DEFAULT '',
  `address` text NOT NULL,
  `name` text NOT NULL,
  `phone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


### DML
-- imooc_about_list
INSERT INTO `imooc_about_list` (`id`, `name`, `code`, `content`, `created_at`) VALUES
(31, '『库莉姆直播情报』', '', '...', '2025-05-13 19:58:25'),
(32, '关于本站', '', '...', '2025-05-13 19:59:16'),
(34, '隐私政策', '', '...', '2025-05-22 06:41:20'),
(35, '特别感谢', '', '...', '2025-05-22 06:43:48');

-- imooc_about_t
INSERT INTO `imooc_about_t` (`id`, `title`, `code`, `name`, `created_at`) VALUES
(31, '姓名', '', '库莉姆Cream', ''),
(32, '年龄', '', '？？？', ''),
(33, '身高', '', '155 cm', ''),
(34, '星座', '', '天秤座', ''),
(35, '生日', '', '10月10日', '');

-- imooc_admin
INSERT INTO `imooc_admin` (`id`, `adminuser`, `adminpass`, `created_at`, `login_at`, `login_ip`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '2019-01-23 20:21:03', '2025-05-20 15:47:09', 93783387);

-- imooc_jfdh
INSERT INTO `imooc_jfdh` (`id`, `name`, `code`, `description`, `stock`, `price`, `created_at`, `images`, `jf`) VALUES
(18, '&uarr;&uarr;&darr;&darr;.gif', 'test1', '', 98, '0.00', '2025-05-20 18:57:44', 'uploads/jfdh/682c6028801dc_↑↑↓↓.gif', 100);

-- imooc_message
INSERT INTO `imooc_message` (`id`, `uid`, `message`, `cid`, `created_at`, `title`) VALUES
(17, 22, '投币！', 3, '2025-05-20 16:58:32', '将你想许下的愿望都发布在这里吧'),
(18, 22, '1111', 1, '2025-05-20 18:13:15', '111');

-- imooc_message_cate
INSERT INTO `imooc_message_cate` (`id`, `col`, `name`) VALUES
(1, '#4caf50', '综合吹水'),
(2, '#cc2f4f', '求求资源'),
(3, '#9751bd', '许愿池');

## Suggest

- Please delete sensitive files such as' localhost. sql 'before going live.
- Suggest changing the backend path to a name that is difficult to guess.

## Reference

https://openweathermap.org/
https://subspace.institute/docs/open-platform/bilibili-avatar
https://github.com/dd-center/vtbs.moe/blob/master/api.md#guards-update-time-httpsapivtbsmoev1guardtime
https://www.bt.cn/new/btcode.htm

## License

MIT License 
