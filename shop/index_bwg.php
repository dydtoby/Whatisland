
  <?php
    require 'header.php';
    $prefix = getDBPrefix();

    $prefix = getDBPrefix();
    $user_id =getSession('id', 'shop'); ;
    $sql = "SELECT images, username, jf,uid
            FROM {$prefix}user 
            WHERE id = '$user_id'";
    $user = queryOne($sql); 
    $avatar_uid = $user['uid'] ?? 0;
    $bTmg_src = "https://workers.vrp.moe/bilibili/avatar/".$avatar_uid;
    $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

    $category = isset($_GET['category']) ? trim($_GET['category']) : '';

    $sql = "SELECT id, name, see, down, images, tab 
            FROM {$prefix}zy 
            WHERE 1=1";

    if (!empty($category)) {
        $sql .= " AND FIND_IN_SET('$category', tab)";
    }

    if (!empty($keyword)) {
        $safeKeyword = "'%" . $keyword . "%'";
        // 添加模糊查询条件：匹配name或tab字段
        $sql .= " AND (name LIKE  $safeKeyword OR tab LIKE  $safeKeyword)";
    }

    $sql .= " ORDER BY created_at DESC";
    $data = query($sql);
    /*随机资源*/
    $random_sql = "SELECT name FROM {$prefix}zy ORDER BY RAND() LIMIT 1";
    $random_result = queryOne($random_sql);
    $random_name = $random_result['name'] ?? '暂无资源';
    // 分类标签
    $sql = "SELECT tab FROM {$prefix}zy";
    $result = query($sql);

    $all_tags = [];
    foreach ($result as $item) {
        if (!empty($item['tab'])) {
            $tags = explode(',', $item['tab']);
            $tags = array_map('trim', $tags);
            $all_tags = array_merge($all_tags, $tags);
        }
    }
    $unique_tags = array_unique(array_filter($all_tags));
    // 检查是否存在category参数
    $current_category = isset($_GET['category']) ? htmlspecialchars($_GET['category']) : '';
    $show_category_container = !empty($current_category);
    ?>        
<style>
    body {
  background-image: url('./images/banner1.jpg');
  background-repeat: no-repeat;
  background-position: center center;
  background-size: cover;
  background-attachment: fixed; /* 关键属性 */
  min-height: 100vh;
  margin: 0;
  position: relative;
}

    </style>
     <div class="Main_S">
    <div class="logo">
    <img src="./images/logo.png">
    </div>
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
    <div class="bwg_M">
        <div class="bwg_M_t Width1440">
            <div class="bwg_M_t_l">
                <div class="bwg_M_t_l_t">
                    <div class="bwg_M_t_l_t_t">
                        <div class="bwg_M_t_l_t_t_m">
                        <img src="./images/index/s1.jpg" alt="">
                        <div class="bwg_M_t_l_t_btn">
                            欢迎来到奶油星物馆
                        </div>
                        </div>
                        <h2>Cream资源的分享区!</h2>
                        <p>免费的资源预览处</p>
                        <div class="bwg_M_t_l_t_b">
                            <div class="bwg_M_t_l_t_b_btn">
                                <img src="./images/index/s2.jpg" alt="">
                                <span><?php echo htmlspecialchars($random_name); ?></span>
                            </div>
                            <img src="./images/index/s3.jpg" alt="">
                        </div>
                    </div>
                    <ul class="bwg_M_t_l_t_b">
                        <li>
                            <img src="./images/index/s4.jpg" alt="">
                        </li>
                        <li>
                            <a href="./index_xyc.php"><img src="./images/index/s5.jpg" alt=""></a>
                        </li>
                        <li>
                            <a href="./about.php">
                            <img src="./images/index/s6.jpg" alt=""></a>
                        </li>
                    </ul>
                    <div class="category-container" style="<?php echo $show_category_container ? 'display:block' : 'display:none'; ?>">
                        <?php if (!empty($unique_tags)) : ?>
                            <ul class="cate_Tab">
                                <?php foreach ($unique_tags as $tag) : ?>
                                    <?php $is_active = ($current_category === $tag); ?>
                                    <li class="<?php echo $is_active ? 'active' : ''; ?>" 
                                        style="<?php echo $is_active ? 'background:#0b4b9e;color:white' : ''; ?>">
                                        <?php echo htmlspecialchars($tag); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else : ?>
                            <p>暂无分类</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="bwg_M_t_r">
                <!-- <img src="./images/index//s7.jpg" alt=""> -->
                <div class="con">
                    <h2>欢迎光临奶油星物馆</h2>
                </div>
            </div>
        </div>
        <div class="bwg_M_two Width1440">
            <div class="bwg_M_title">
                <div class="bwg_M_title_l">
                <h2>最新的资源</h2>
                <span>查看更多 ></span>
                </div>
                <div class="searchList bwg_M_title_r">
                    <form action="" method="GET">
                        <?php if (!empty($current_category)) : ?>
                            <input type="hidden" name="category" value="<?php echo htmlspecialchars($current_category); ?>">
                        <?php endif; ?>
                        <input type="text" name="keyword" placeholder="名称/Tab" value="<?php echo htmlspecialchars($keyword); ?>">
                        <button type="submit" class="btn">搜索</button>
                    </form>
                </div>
            </div>
            <ul>
                <?php foreach ($data as $product): ?>
                        <li>
                        <img src="../<?php echo $product['images']; ?>" alt="">
                            <h2 class="ellipsis"><?php echo $product['name']; ?></h2>
                            <div class="con">
                                <div class="con_1"><?php echo $product['see']; ?></div>
                                <div class="con_2"><?php echo $product['down']; ?></div>
                            </div>
                            <ul class="tab">
                                <?php 
                                // 将逗号分隔的字符串转为数组
                                $tabs = !empty($product['tab']) ? explode(',', $product['tab']) : [];
                                foreach ($tabs as $tab):
                                    // 去除两端空格防止格式问题
                                    $trimmedTab = trim($tab);
                                    if (!empty($trimmedTab)):
                                ?>
                                    <li><?php echo $trimmedTab; ?></li>
                                <?php 
                                    endif;
                                endforeach; 
                                ?>
                            </ul>
                        </li>
                        <?php endforeach; ?>
            </ul>
        </div>
        <?php
        require 'footer.php'
        ?>
        </div>
        <script>
    document.addEventListener('DOMContentLoaded', function() {
        // 获取第一个li元素和分类容器
        const firstLi = document.querySelector('.bwg_M_t_l_t_b > li:first-child');
        const categoryContainer = document.querySelector('.category-container');

        // 点击事件处理
        firstLi.addEventListener('click', function(e) {
            // 切换显示状态
            categoryContainer.style.display = categoryContainer.style.display === 'none' ? 'block' : 'none';
            
            // 添加/移除激活样式
            this.classList.toggle('active');
        });
    });
    document.querySelectorAll('.cate_Tab li').forEach(tag => {
    tag.addEventListener('click', function() {
        const category = this.textContent.trim();
        // 更新URL带category参数
        const url = new URL(window.location.href);
        url.searchParams.set('category', category);
        window.location.href = url.toString();
    });
});

    </script>
</body>
</html>