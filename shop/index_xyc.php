<?php
require 'header.php';
require 'auth.php';
$prefix = getDBPrefix();
$user_id =getSession('id', 'shop'); ;
$sql = "SELECT images, username, jf,uid
        FROM {$prefix}user 
        WHERE id = '$user_id'";
$user = queryOne($sql); 
$avatar_uid = $user['uid'] ?? 0;
$bTmg_src = "https://workers.vrp.moe/bilibili/avatar/".$avatar_uid;
?>
<style>
    .Main_S_M{
    top:60px;
    position: relative;
}
</style>
<script>
// 时间格式化函数（移植到前端）
function timeAgo(datetime) {
    const date = new Date(datetime);
    const now = new Date();
    const diff = Math.floor((now - date) / 1000); // 秒差
    
    const units = {
        年: 31536000,
        月: 2592000,
        周: 604800,
        天: 86400,
        小时: 3600,
        分钟: 60,
        秒: 1
    };

    for (let [unit, sec] of Object.entries(units)) {
        if (diff >= sec) {
            const value = Math.floor(diff / sec);
            return `${value}${unit}前`;
        }
    }
    return '刚刚';
}

document.addEventListener('DOMContentLoaded', function() {
    // 表单提交处理
    const postForm = document.querySelector('.post_creator form');
    
    postForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // 获取表单数据
        const formData = new FormData(this);
        const title = formData.get('title').trim();
        const message = formData.get('message').trim();
        const cid = parseInt(formData.get('cid'));
        // 客户端验证
        if (!title || !message) {
            alert('标题和内容不能为空|Title and content cannot be empty');
            return;
        }
        if (cid === 0) {
            alert('请选择分类|Please select a category');
            return;
        }

        try {
            // 显示加载状态
            const submitBtn = this.querySelector('.post_btn');
            submitBtn.disabled = true;
            submitBtn.textContent = '提交中|posting...';

            // 调用API提交数据
            const response = await fetch('../api/message.php', {
                method: 'POST',
                body: formData,
            });
            
            const result = await response.json();
            
            if (result.code === 200) {
                alert('发布成功Publish Successfully');
                // 清空表单
                this.reset();
                // 刷新留言列表
                await loadMessages(currentCid);
            } else {
                alert(result.msg || '发布失败Failure to publish');
            }
        } catch (error) {
            console.error('提交失败Failed to submit:', error);
            alert('网络错误，请稍后重试<br>Network error, please try again later');
        } finally {
            // 恢复按钮状态
            const submitBtn = this.querySelector('.post_btn');
            submitBtn.disabled = false;
            submitBtn.textContent = '发射！|update';
        }
    });

    // 加载初始数据
    loadCategories();
    loadMessages();
    CateClick();
    // setupDragControl();
});

// 当前选中的分类ID
let currentCid = 0;

// 加载分类数据
async function loadCategories() {
    try {
        const response = await fetch('../api/categories.php');
        const { code, data } = await response.json();
        
        if (code === 200) {
            // 渲染分类侧边栏
            renderCategorySidebar(data);
            // 填充分类选择器
            renderCategorySelector(data);
        }
    } catch (error) {
        console.error('加载分类失败|Failed to load category:', error);
    }
}

// 加载留言数据
// 在全局变量区域添加
let currentSearch = '';

// 修改后的加载留言函数
// 加载留言数据
async function loadMessages(cid = 0, search = '') {
    // 先获取元素引用
    const messageList = document.querySelector('.xyc_M_r_b');
    
    try {
        messageList.classList.add('loading');
        
        // 构建动态参数
        const params = new URLSearchParams();
        if (cid > 0) params.append('cid', cid);
        if (search) params.append('search', search);
        
        const response = await fetch(`../api/message.php?${params}`);
        const { code, data } = await response.json();
        
        if (code === 200) {
            renderMessages(data);
            updateActiveCategory(cid);
            currentSearch = search;
        }
    } catch (error) {
        console.error('加载失败:', error);
    } finally {
        // 添加空值保护
        if (messageList) {
            messageList.classList.remove('loading');
        }
    }
}

// 新增搜索处理函数
function handleSearch() {
    const keyword = document.getElementById('searchInput').value.trim();
    loadMessages(currentCid, keyword);
}

function updateActiveCategory(cid) {
    document.querySelectorAll('.category-item, .allCate').forEach(item => {
        const itemCid = item.classList.contains('allCate') 
            ? 0 
            : parseInt(item.dataset.cid);
        item.classList.toggle('active', itemCid === cid);
    });
}
function CateClick(){
    
const sidebar = document.querySelector('.xyc_M_l_b');
sidebar.addEventListener('click', function(e) {
    // 检查点击的元素是否包含特定类名
    var clicked = e.target;
    
    // 检查是否是.allCate
    if (clicked.classList.contains('allCate')) {
        currentCid = 0;
        loadMessages(currentCid);
        return;
    }
    
    // 检查是否是.category-item或它的父元素
    var categoryItem = clicked.closest('.category-item');
    if (categoryItem) {
        currentCid = parseInt(categoryItem.dataset.cid);
        loadMessages(currentCid);
    }
});
}
// 渲染分类侧边栏
function renderCategorySidebar(categories) {
    const sidebar = document.querySelector('.xyc_M_l_b');
    sidebar.innerHTML = `
        <h2>类别</h2>
        ${categories.map(cate => `
            <li data-cid="${cate.id}" class="category-item">
                <span style="background:${cate.col}"></span>
                ${cate.name}
            </li>
        `).join('')}
        <li class="allCate">所有类别</li>
    `;
}

// 渲染分类选择器
function renderCategorySelector(categories) {
    const selector = document.querySelector('select[name="cid"]');
    selector.innerHTML = `
        <option value="0">-- 选择分类|Select Cat. --</option>
        ${categories.map(cate => `
            <option value="${cate.id}">${cate.name}</option>
        `).join('')}
    `;
}

// 渲染留言列表
function renderMessages(messages) {
    const list = document.querySelector('.xyc_M_r_b ul');
    if (messages.length === 0) {
        list.innerHTML = `
            <li class="no-data">
                <img src="images/empty.svg" alt="无数据|No data">
                <p>当前分类还没有留言哦~|No message~</p>
            </li>
        `;
        return;
    }

    list.innerHTML = messages.map(msg => `
        <li>
            <div class="xyc_M_r_b_1">
                <h2 class="icon">${msg.title}</h2>
                <div class="tab">
                    <span style="background:${msg.col || '#eee'}"></span>
                    ${msg.cate_name || '未分类|Uncategorised'}
                </div>
                <p>${msg.message.replace(/\n/g, '<br>')}</p>
            </div>
            <div class="xyc_M_r_b_2">${msg.username || '匿名用户'}</div>
            <div class="xyc_M_r_b_4">${timeAgo(msg.created_at)}</div>
        </li>
    `).join('');
}

</script>

<style>
.loading {
    position: relative;
    opacity: 0.7;
}
.loading::after {
    content: "loading...";
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #666;
}
</style>
<div class="Main_S">
    <div class="logo">
    <img src="./images/logo.png">
    </div>
    <!-- <div class="bgMainImg"></div> -->
    <div class="touxiang">
        <img class="bTmg" 
            src="<?php echo $bTmg_src; ?>"
            referrerpolicy="no-referrer"
            loading="lazy"
            alt="B站头像"
            onerror="this.style.display='none'">
        <img class="b2Tmg" 
            src="<?php echo !empty($user['images']) ? './images/'.$user['images'] : './images/i3.png'; ?>"
            alt="本地头像">
    </div>
    <div class="Main_S_M">
        <div class="xyc_M Width1440">
        <div class="xyc_M_l xyc_M_l_M">
            <div class="searchList">
                <input type="text" id="searchInput" placeholder="名称/分类">
                <button class="btn" onclick="handleSearch()">搜索</button>
            </div>
                <ul class="xyc_M_l_t">
                    <li>话题|Subject</li>
                    <li>更多|More</li>
                </ul>
                <ul class="xyc_M_l_b"> 
                    <h2>类别|Cat.</h2>   
                </ul>
            </div>
            <div class="xyc_right_Main">
                <div class="post_creator">
                    <form>
                        <div class="creator_header">
                            <input type="text" name="title" placeholder="标题|Caption" required>
                            <textarea name="message" placeholder="有什么新鲜事分享给大家|What's new?... (ﾉ>ω<)ﾉ" required></textarea>
                            <input type="hidden" name="uid" value="<?php echo  getSession('id', 'shop');?>">
                        </div>
                        <div class="creator_footer">
                            <select name="cid" class="cate-select" required>
                                <!-- 动态填充 -->
                            </select>
                            <button type="submit" class="post_btn">发射/post!</button>
                        </div>
                    </form>
                </div>
                <div class="xyc_M_r">
                <div class="xyc_M_r_c" style="margin-top:0;">
                    <div class="xyc_M_r_c_l">
                        话题|Subject
                    </div>
                    <ul class="xyc_M_r_c_r">
                        <li>用户|User</li>   
                        <li>活动|Function</li>
                    </ul>
                </div>
                <div class="xyc_M_r_b">
                    <ul>
                       
                    </ul>
                </div>
            </div>
            </div>
        </div>
    <?php
// 时间格式化函数
function time_ago($datetime) {
    $time = strtotime($datetime);
    $diff = time() - $time;
    
    $units = [
        31536000 => '年',
        2592000 => '月',
        604800 => '周',
        86400 => '天',
        3600 => '小时',
        60 => '分钟',
        1 => '秒'
    ];

    foreach ($units as $sec => $unit) {
        if ($diff >= $sec) {
            $value = floor($diff / $sec);
            return $value . $unit . '前';
        }
    }
    return '刚刚|New';
}

require 'footer.php';
?>
    </div>
    </div>
</body>
</html>