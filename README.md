# WhatIsland Online Mall And Blog System
## The website has been deployed on: https://whatisland.online/shop/
## github:https://github.com/dydtoby/Whatisland.git
## Module code (COM6023M)
## Name:Yudong.Du

This project is an e-commerce+blog platform based on PHP and MySQL, Designed for the virtual anchor "库莉姆Cream" fan community.The system integrates a variety of functions such as shopping mall, points system, message board, resource sharing, etc., providing a complete front-end and back-end solution.

##  主题特色(Theme Features)
**Project features**: VTuber fan community platform based on the theme of "Cream/Cream".
**Technical Architecture**: Native PHP + MySQL + jQuery + ECharts

## tech stack
- **Back-end**: PHP 7.2+
- **Database**: MySQL 5.7+ (database name: sht_cc)
- **Frontend**: HTML5 + CSS3 + JavaScript + jQuery + ECharts
- **Server**: Apache/Nginx
- **UI Design**: Custom CSS
- **External APIs**: Bilibili Avatar API, VTuber Data API, Weather API

### 1. 页面主题(CN)
- **Cream广场**: VTuber数据展示中心
- **奶油星物馆**: 展示页面
- **许愿池**: 用户留言互动
- **鼠鼠银行**: 积分兑换中心
- **岛民海景房**: 个人中心
- **兔堡堡**: 资源分享平台
- **小奶油商城**: 商品购买
### 1. Page Topics(EN)
- **Cream Square**: VTuber Data Display Centre
- **Cream Star Museum**: Showcase page
- **Wishing Pool**: Interactive user feedback centre
- **Mouse Bank**: Points Exchange Centre
- **Islander Seaview Room**: Personal Centre
- **Rabbit Castle**: Resource Sharing Platform
- **Small Cream Mall**: Buy Products

### 2. 设计风格(CN)
- 以"奶油/Cream"为主题的可爱风格
- 粉色系配色方案
- 圆角设计元素
- 响应式布局
### 2. Design style(EN)
- Cute style with "Cream" theme.
- Pink colour scheme
- Rounded corners
- Responsive layout

##  安全特性(Safety features)

### 1. 数据安全(CN)
- 密码使用SHA256加密存储
- SQL查询防注入处理
- 用户输入HTML转义
- 登录验证码防暴力破解
### 1. Data security(EN)
- Passwords are stored using SHA256 encryption
- SQL query anti-injection processing
- User input HTML escaping
- Anti-breakdown of login authentication code

### 2. 权限控制(CN)
- 管理后台登录验证
- Session状态管理
- 文件上传类型限制
- 用户操作权限验证
### 2. Privilege control(EN)
- Admin backend login authentication
- Session status management
- Restrictions on file upload types
- User operation authority verification


### 当前版本特性(CN)
-  完整的用户注册登录系统
-  VTuber数据展示和图表
-  积分签到和兑换系统
-  商城购物车功能
-  留言板(许愿池)功能
-  文件上传下载系统
-  管理后台完整功能
-  B站头像集成
-  响应式设计
### Current version features(EN)
- Complete user registration and login system
- VTuber data presentation and charting
- Points check-in and redemption system
- Shopping cart function
- Message board (wishing pool) function
- File upload and download system
- Management backend complete function
- B-site avatar integration
- Responsive design

## Project Structure

```
demo/
├── admin/                  # 后台管理系统Back-office management system
│   ├── login.php          # 管理员登录Administrator Login
│   ├── auth.php           # 权限验证permission verification
│   ├── index.php          # 控制台首页Console Home
│   ├── users.php          # 用户管理user management
│   ├── user_add.php       # 添加用户Add User
│   ├── user_edit.php      # 编辑用户Edit user
│   ├── user_del.php       # 删除用户Delete user
│   ├── products.php       # 商品管理Commodity management
│   ├── product_add.php    # 添加商品Add Product
│   ├── product_edit.php   # 编辑商品Edit Product
│   ├── product_del.php    # 删除商品Delete Product
│   ├── orders.php         # 订单管理Order Management
│   ├── order_edit.php     # 编辑订单Edit Order
│   ├── jfdh.php           # 积分兑换商品管理Points Redemption Product Management
│   ├── jlOrder.php        # 积分兑换记录Points Redemption Record
│   ├── message.php        # 许愿池管理Wishing Pool Management
│   ├── cate_list.php      # 许愿池分类管理Wishing Pool Category Management
│   ├── carts.php          # 购物车管理Shopping Cart Management
│   ├── zy.php             # 资源管理Resource management
│   ├── aboutLevel.php     # About-T管理 management
│   ├── aboutList.php      # About-List管理 management
│   ├── export_excel.php   # 数据导出Data export
│   └── assets/            # 后台静态资源Backend static resources
├── shop/                   # 前台用户界面Frontend User Interface
│   ├── index.php          # 首页 - Cream广场 (VTuber数据展示)Home - Cream Square (VTuber Data Display)
│   ├── login.php          # 用户登录user login
│   ├── register.php       # 用户注册User Registration
│   ├── logout.php         # 退出登录Log out
│   ├── shop_list.php      # 小奶油商城 (商品列表)Little Cream Mall (Product List)
│   ├── cart.php           # 购物车cart
│   ├── cart_add.php       # 添加到购物车Add to Cart
│   ├── cart_del.php       # 删除购物车商品Delete Shopping Cart Items
│   ├── checkout.php       # 结算页面checkout page
│   ├── sea.php            # 岛民海景房 (个人中心/签到)Islander Seaview Room (Personal Centre / Check-in)
│   ├── tu.php             # 兔堡堡 (资源分享)Fort Bunny (Resource Sharing)
│   ├── index_xyc.php      # 许愿池 (留言板)Wishing Fountain (Message Board)
│   ├── index_bwg.php      # 奶油星物馆 (展示页面)Cream Star Museum (Show page)
│   ├── shop_blank.php     # 鼠鼠银行 (积分兑换)Mouse Bank (Points Redemption)
│   ├── about.php          # 关于页面About Page
│   ├── get_messages.php   # 获取留言数据Get Message Data
│   ├── captcha.php        # 验证码生成CAPTCHA Generation
│   ├── css/               # 前台样式文件Frontend Style File
│   ├── js/                # 前台脚本文件 (jQuery, ECharts)Frontend script files (jQuery, ECharts)
│   └── images/            # 前台图片资源Frontend Image Resources
├── api/                    # API接口API interface
│   ├── message.php        # 留言管理API (CRUD)Message Management API (CRUD)
│   ├── users.php          # 用户列表API User List API
│   ├── categories.php     # 分类列表API Categorised Listings API
│   ├── upload.php         # 文件上传API File Upload API
│   ├── qd_api.php         # 签到API Check-in API
│   ├── exchange_api.php   # 积分兑换API Points Redemption API
│   ├── update_avatar.php  # 更新头像API Update Avatar API
│   ├── update_password.php # 修改密码API Change Password API
│   ├── delete_account.php # 删除账户API Delete Account API
│   ├── download.php       # 文件下载API File Download API
│   ├── delete_file.php    # 删除文件API Delete File API
│   └── check_jf.php       # 检查积分API Check Points API
├── uploads/                # 文件上传目录 File Upload Directory
│   ├── products/          # 商品图片 Product Images
│   ├── zy/                # 资源文件 resource document
│   └── jfdh/              # 积分兑换商品图片 Points Redemption Product Images
├── config.php              # 数据库配置 Database Configuration
├── db.func.php             # 数据库操作函数 Database Manipulation Functions
└── tools.func.php          # 工具函数 (Session管理) Tool Functions (Session Management)
```
### Environment requirements
- PHP 7.2 or higher
- MySQL 5.7 or higher
- Apache or Nginx server

 **数据库配置文件**
   ```php
   // config.php (Configured, if you need to change it)
   return [
       'DB_HOST' => '127.0.0.1',
       'DB_PORT' => '3306',
       'DB_USER' => 'root',
       'DB_PASS' => '123456',
       'DB_NAME' => 'root',
       'DB_PREFIX' => 'imooc_',
       'DB_CHARSET' => 'utf8',
   ];
   ```

## quick start

1. Clone or unzip the project to the root directory of your web server.
2. Create database (sql)：
   - Import the 'localhost. sql' file using PHPMyAdmin or the command line
3. Modify configuration：
   - Edit 'config.php' to set database connection information.
4. visit：
   - client address：`http://yourdomain.com/shop/`
   - server address：`http://yourdomain.com/admin/`
  **Administrator account** 
  - username：admin
  - password：123456
  **beta user** 
  - username：Test001
  - password：Test123456@

## Rapid Deployment
   - Install BT panel（https://www.bt.cn/new/btcode.htm）
   Ubuntu/Deepin set up script
   wget -O install.sh http://download.bt.cn/install/install-ubuntu_6.0.sh && sudo bash install.sh
   - LaunchPad
   - Install<Apache/Nginx>,<MySQL 5.7+>,<php MyAdmin>,<php 7.2+>
   - click<website>-<PHP project>-<add website>, enter your domain name, select MySQL for the database, and select PHP 7.2 for the PHP version+
   - Click on the database, add the database, set the database name, username, password, and modify the corresponding values in config. php at the same time. Import data tables using PHPMyAdmin
   - start<Apache/Nginx>,<MySQL 5.7+> 

## 功能模块详解（CN）

### 前台功能 (shop/)

#### 1. Cream广场 (index.php)
- **VTuber数据展示**: 显示库莉姆的B站数据统计
- **关注历史图表**: 使用ECharts展示粉丝增长趋势
- **舰团变化图表**: 显示舰团数据变化
- **B站头像集成**: 自动获取B站用户头像

#### 2. 小奶油商城 (shop_list.php)
- **商品浏览**: 展示所有商品
- **商品搜索**: 支持关键词搜索
- **购物车功能**: 添加商品到购物车
- **商品管理**: 价格、库存、图片展示

#### 3. 岛民海景房 (sea.php) - 个人中心
- **用户信息**: 显示用户名、积分、头像
- **签到系统**: 每日签到获取积分
- **兑换记录**: 查看积分兑换历史
- **天气信息**: 集成天气API显示

#### 4. 许愿池 (index_xyc.php)
- **留言发布**: 用户可发布许愿内容
- **分类管理**: 支持不同类型的许愿分类
- **留言展示**: 实时显示所有用户留言

#### 5. 鼠鼠银行 (shop_blank.php)
- **积分兑换**: 使用积分兑换虚拟商品
- **兑换商品**: 表情包、特殊道具等
- **库存管理**: 实时显示商品库存

#### 6. 兔堡堡 (tu.php)
- **资源分享**: 用户上传和分享资源
- **文件管理**: 支持文件上传下载
- **积分消耗**: 上传下载需要消耗积分

### 后台功能 (admin/)

#### 1. 控制台 (index.php)
- **管理员列表**: 显示所有管理员信息
- **登录记录**: 管理员登录时间和IP

#### 2. 用户管理
- **用户列表** (users.php): 查看所有注册用户
- **用户编辑** (user_edit.php): 修改用户信息、积分
- **用户添加** (user_add.php): 手动添加用户
- **用户删除** (user_del.php): 删除用户账户

#### 3. 商品管理
- **商品列表** (products.php): 管理所有商品
- **商品编辑** (product_edit.php): 修改商品信息
- **商品添加** (product_add.php): 添加新商品
- **商品删除** (product_del.php): 删除商品

#### 4. 积分系统管理
- **积分商品** (jfdh.php): 管理可兑换的积分商品
- **兑换记录** (jlOrder.php): 查看所有兑换记录
- **积分调整**: 手动调整用户积分

#### 5. 内容管理
- **许愿池管理** (message.php): 管理用户留言
- **分类管理** (cate_list.php): 管理留言分类
- **资源管理** (zy.php): 管理用户上传的资源
- **关于页面** (aboutList.php): 管理关于页面内容

## Function Module Details (EN)

### Frontend Functions (shop/)

#### 1. Cream Square (index.php)
- **VTuber Data Display**: displays Cream's B-site stats
- **Following History Chart**: Showing the trend of follower growth using ECharts
- **Corps Change Chart**: Showing changes in corps data
- **B site avatar integration**: Automatically get avatars of B site users.

#### 2. Little Cream Mall (shop_list.php)
- **Product Browse**: show all products
- **Product Search**: Support keyword search.
- **Cart Function**: Add products to cart.
- **Product Management**: Price, Inventory, Picture Display

#### 3. Islander Sea View (sea.php) - Personal Centre
- **User information**: display username, points, avatar
- **Check-in system**: daily check-in for points
- **Redemption History**: View history of points redemption.
- **Weather Information**: Integrate weather API to display the weather information.

#### 4. Wishing Pool (index_xyc.php)
- **Message Post**: Users can post their wishes.
- **Category Management**: Support different types of wish categories.
- **Message Display**: Show all user's messages in real time.

#### 5. Mouse Bank (shop_blank.php)
- **Points Redemption**: Redeem points for virtual goods.
- **Commodity exchange**: emoticons, special props, etc.
- **Inventory Management**: Real-time display of product inventory.

#### 6. Bunny Burger (tu.php)
- **Resource Sharing**: Users upload and share resources.
- **File Management**: Support uploading and downloading files.
- **Points Consumption**: Uploading and downloading requires points.

### Background Functions (admin/)

#### 1. Control Panel (index.php)
- **Administrator List**: Show all administrators' information.
- **Login History**: Administrator login time and IP address.

#### 2. User Management
- **User list** (users.php): View all registered users.
- **User Edit** (user_edit.php): Edit user information and credits.
- **User Add** (user_add.php): Add users manually.
- **User Delete** (user_del.php): Deletes a user account.

#### 3. Product Management
- **Products list** (products.php): Manage all products.
- **Product Edit** (product_edit.php): Modify product information.
- **Product Add** (product_add.php): Add a new product.
- **Product Delete** (product_del.php): Deletes a product.

#### 4. Points System Management
- **Points products** (jfdh.php): Manage redeemable points products.
- **Redemption History** (jlOrder.php): View all redemption history.
- **Points Adjustment**: Manually adjust user points.

#### 5. Content Management
- **Wishing Pool Management** (message.php): Manage user's messages.
- **Category Management** (cate_list.php): Manage the categories of the messages.
- **Resource Management** (zy.php): Manage resources uploaded by users.
- **About page** (aboutList.php): manages the content of the about page.

## Upload directory instructions

Upload files and store them uniformly in the '/uploads' directory. Please ensure that this directory has write permission.

## API Document

If you need to expand the integration of mobile devices or mini programs, you can refer to the contents of the 'API/' directory for interface calls.
- The following is a detailed explanation

### Basic Information

**API Base URL**: `https://whatisland.online/api/`  
**data format**: JSON  
**character encoding**: UTF-8  

### Common Response Format

```json
{
  "code": 200,
  "msg": "The operation was successful.",
  "data": {},
  "total": 0,
  "page": 1
}
```

### Internal API
#### 1 /api/Message.php(Message API)
Basic URL：http://whatisland(yourdomain).com/message.php
data format：JSON
method   Endpoint             Function Description	Authentication Required
GET	     /message.php	        Get the message list	N/A
POST	   /message.php	        Create a new message	need
PUT	     /message.php	        Update message	      need
DELETE	 /message.php?id={id}	Delete message	      need

##### 1.1 Get message list/details
Endpoint information
```http
‌URL‌: /api/message.php[?id=1&page=2&per_page=15&cid=3&search=关键词（keyword）]
```
method‌: GET
- **Parameter Description**
Default value
parameter   type	 REQUIRED	describe	                                        
id	        int	   deny	    Specify message ID (to obtain a single message)	  -
page	      int	   deny	    Current page number	                              1
per_page  	int	   deny	    Display quantity per page (range 5-50)	          15
cid	        int	   deny	    Classification filtering (0 means no filtering)	  0
search	   string	 deny	    Global search keywords (title/content)            -
- **Request Example**
httpCopy Code
GET /api/message.php?page=2&per_page=10&cid=5&search=内容(element)
- **Successful response**
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
- **Error examples‌：**
jsonCopy Code
{
  "code": 400,
  "msg": "数据查询错误"} （Data query error）


##### 1.2 Create a message
Endpoint information
‌URL‌: /api/message.php
Method‌: POST
‌Content-Type‌: application/x-www-form-urlencoded
- **Request parameters**
parameter	type	   REQUIRED	describe
title	    string   correct	Message title (2-50 words)
uid	      int	     correct	user id
cid	      int	     correct	Classification ID
message	  string	 correct	Message content (10-500 words)
- **Request Example**
httpCopy Code
POST /api/message.php
title=标题（title）&uid=12&cid=3&message=内容（message）
- **Successful response**
jsonCopy Code
{
  "code": 200,
  "msg": "添加成功"}//（Added successfully）

##### 1.3 Update message
Endpoint information
‌URL‌: /api/message.php
methodologies‌: PUT
‌Content-Type‌: application/x-www-form-urlencoded
- **Request parameters**
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
- **Successful response**
jsonCopy Code
{
  "code": 200,
  "msg": "更新成功"}

##### 1.4 Delete message
Endpoint information
URL‌: /api/message.php?id=32
method‌: DELETE
Request Example
httpCopy Code
DELETE /api/message.php?id=32
- **Successful response**
jsonCopy Code
{
  "code": 200,
  "msg": "删除成功（Delete successfully）"}

- **Delete as an error handling standard**
All error responses contain the following fields：
jsonCopy Code
{
  "code": 400,
  "msg": "具体错误描述（Specific error description）"}

#### 2 /api/categories.php(Classification API)
Endpoint information
‌URL‌: /api/categories.php
Method‌: GET
- **Request Example**
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

#### 3 /api/users.php(User API)
Endpoint information
‌URL‌: /api/users.php
Method‌: GET
- **Request Example**
httpCopy Code
GET /api/users.php
- **Successful response**
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

#### 4. check-in system API (qd_api.php)
```http
POST /api/qd_api.php
Content-Type: application/x-www-form-urlencoded

userid=123
```

**Sample response**:
```json
{
  "code": 200,
  "msg": "签到成功", (Sign in successfully)
  "data": {
    "points": 5,
    "new_jf": 155
  }
}
```
#### 5. Redeeming Points API (exchange_api.php)
```http
POST /api/exchange_api.php
Content-Type: application/x-www-form-urlencoded

user_id=123&product_id=18&quantity=1
```

#### 6. File Upload API (upload.php)

```http
POST /api/upload.php
Content-Type: multipart/form-data

file: [binary data]
name: 文件名称(file name)
```
#### 7. user operation API

##### 7.1 Update Avatar (update_avatar.php)
```http
POST /api/update_avatar.php
Content-Type: application/x-www-form-urlencoded

uid=123&avatar=i1.png
```

##### 7.2 change your password (update_password.php)
```http
POST /api/update_password.php
Content-Type: application/x-www-form-urlencoded

uid=123&newPassword=新密码(newPassword)
```

##### 7.3 Checkpoints (check_jf.php)
```http
GET /api/check_jf.php?user_id=123
```


### External API
- **Params**
- `uid`: User Bilibili.com's UID (required)
<uid>:https://space.bilibili.com/<uid>

#### 8 Obtain personal information
**API URL** https://api.vtbs.moe/v1/detail/<uid>

**Example of a request**:
```javascript
// Get VTuber details
fetch(`https://api.vtbs.moe/v1/detail/349991143`)
  .then(response => response.json())
  .then(data => console.log(data));
```
**Sample response**:
Return record of certain vtb based on given <uid>.
Example: https://api.vtbs.moe/v1/detail/349991143
```json
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
```

#### 9 Get history of video views and follower counts.
**API URL**: https://api.vtbs.moe/v2/bulkActive/<uid>
**Function Description**: Get the history of video plays and followers for charting trends.
**Example of a request**:
```javascript
// Getting historical data
fetch(`https://api.vtbs.moe/v2/bulkActive/349991143`)
  .then(response => response.json())
  .then(data => {
    // For ECharts charts
    const dates = data.map(item => new Date(item.time).toLocaleDateString());
    const followers = data.map(item => item.follower);
    const views = data.map(item => item.archiveView);
  });
```

**Sample response**:
```json
[
  {
    "archiveView": 16222668,
    "follower": 298364,
    "time": 1555247781729
  },
  {
    "archiveView": 16222668,
    "follower": 298942,
    "time": 1555276084544
  }
]
```
- **Keys:**
- `archiveView`: total number of video views(numbers)
- `follower`: number of fans(numbers)
- `time`: timestamp(numbers)

#### 10 Get guard changes
**API URL**: https://api.vtbs.moe/v2/bulkGuard/<uid>

- **WHY?** Get historical changes in the number of ship groups and divisional rankings.

**Example of a request**:
```javascript
// Getting guard data
fetch(`https://api.vtbs.moe/v2/bulkGuard/349991143`)
  .then(response => response.json())
  .then(data => console.log(data));
```
**Sample response**:
```json
[
  {
    "guardNum": 970,
    "areaRank": 2,
    "time": 1555247781729
  },
  {
    "guardNum": 975,
    "areaRank": 2,
    "time": 1555276084544
  }
]
```

**Field Description**:
- `guardNum`: Number of ship groups
- `areaRank`: Divisional Rankings
- `time`: timestamp

#### 11 Get avatar from bilibili.com
Provide a user UID, which returns the corresponding Bilibili user avatar. This API is mainly used for displaying whatisland user avatars
**API Base**: https://workers.vrp.moe/bilibili/avatar/<uid>

- **Params**
- `uid`: User Bilibili.com's UID (required)
- `size`: Avatar size, default 240 (optional)
- **Caching**: 3600 sec

- **Why?**
Due to the fact that Bilibili.com's avatar images do not allow CORS cross domain calls, and avatar URLs are provided in an unordered hash format, an intermediate service is needed to proxy the acquisition of avatar images
**usage example**:
```javascript
// Get avatars of users on Bilibili.com
const avatarUrl = `https://workers.vrp.moe/bilibili/avatar/${uid}`;

function Avatar({ uid }) {
  return (
    <img
      src={`https://workers.vrp.moe/bilibili/avatar/${uid}`}
      referrerPolicy='no-referrer'
      loading='lazy'
      alt='avatar'
    />
  )
}
```

#### 12 Get weather
**API URL**: https://api.openweathermap.org/data/2.5/forecast

**Functional Description**: Get a 5-day weather forecast with data updated every 3 hours.

**request parameter**:
| Parameter | Required | Description |
|------|------|------|
| lat | Required | Latitude |
| lon | Required | Longitude | appid | Required | API key
| appid | Required | API Key | units | optional | Longitude | | appid | Required | API Key | units
| units | optional | Units of measurement (metric=metric, imperial=imperial) | | lang | optional
| lang | optional | language (zh_cn=Chinese) | | units | optional
| cnt | optional | number of timestamps returned |
*** Translated with www.DeepL.com/Translator (free version) ***

**Example of a request**:
```javascript
// Getting weather data
const apiKey = 'YOUR_API_KEY';
const lat = 35;
const lon = 139;

fetch(`https://api.openweathermap.org/data/2.5/forecast?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric&lang=zh_cn`)
  .then(response => response.json())
  .then(data => console.log(data));
```

**Sample response**:
```json
{
  "cod": "200",
  "message": 0,
  "cnt": 40,
  "list": [
    {
      "dt": 1578326400,
      "main": {
        "temp": 7.57,
        "feels_like": 4.58,
        "temp_min": 7.57,
        "temp_max": 7.57,
        "pressure": 1025,
        "humidity": 81
      },
      "weather": [
        {
          "id": 800,
          "main": "Clear",
          "description": "晴",
          "icon": "01d"
        }
      ],
      "wind": {
        "speed": 2.68,
        "deg": 298
      }
    }
  ],
  "city": {
    "id": 1851632,
    "name": "Tokyo",
    "coord": {
      "lat": 35,
      "lon": 139
    },
    "country": "JP"
  }
}
```

## Sql（Please refer to the .sql file for details, the content is for demonstration only）
### Main data table (prefix: imooc_)

| Table Name | Description |
|------|------|
| imooc_user | Users Table (Username, Password, Points, B Station UID) |
| imooc_admin | admin table |
| imooc_product | Product table | imooc_cart | imooc_cart
| imooc_cart | Shopping Cart table |
| imooc_order | order form | imooc_message | imooc_messages | imooc_admin
| imooc_message | Message table (wishing pool content) |
| imooc_message_cate | message_cate | message_categorisation | imooc_message_cate
| imooc_jfdh | Points Redeemable Products Table | | imooc_jfdh | points_cate_table
| imooc_jfdh_jl | Points Redemption Record Table | | imooc_qd | Points Redemption Table
| imooc_qd | Check-In Record Table | imooc_wp
| imooc_wp | File Upload Form | imooc_about_tabs
| imooc_about_list | about_list | imooc_qd | check-in list | imooc_wp | upload_list
| imooc_about_t | about_page_title table |

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
