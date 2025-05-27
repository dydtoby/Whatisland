
<?
    require 'header.php';
    // 1. 查询所有商品 imooc_product
    // 2. 写sql语句
    $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
    $prefix = getDBPrefix();
    // 动态生成SQL查询条件
    $sql = "SELECT  id,name,price,images 
    FROM {$prefix}product
    WHERE 1=1"; // 初始条件
    if (!empty($keyword)) {
    // 对关键词进行安全过滤（防止SQL注入）
    $safeKeyword = "'%" . $keyword . "%'";
    // 添加模糊查询条件：匹配name或tab字段
    $sql .= " AND (name LIKE  $safeKeyword)";
    }

    $sql .= " ORDER BY created_at DESC";
    // echo $sql;  
    $data = query($sql); 
    
    $user_id =getSession('id', 'shop'); ;
    $sql = "SELECT images, username, jf,uid
            FROM {$prefix}user 
            WHERE id = '$user_id'";
    $user = queryOne($sql); 
    $avatar_uid = $user['uid'] ?? 0;
    $bTmg_src = "https://workers.vrp.moe/bilibili/avatar/".$avatar_uid;
?>
<style>
.xny_M_t{justify-content: space-between;}
.bwg_M_title_r{float:right;}
.bwg_M_title_r form{display: flex;}
.Main_S_M{position: relative;top:60px;}
</style><div class="Main_S">
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
          <div class="xny_Main_s">
                <div class="xny_M Width1440">
                    <h2>主页Home>奶油商店街Cream Shop Street>小奶油商城Cream Mall</h2>
                    <ul class="xny_M_t">
                        <li>这里展示了本站所有的商品All Products Here</li>
                        <li>
                        <div class="searchList bwg_M_title_r">
                            <form action="" method="GET">
                                <input type="text" name="keyword" placeholder="搜索商品">
                                <button type="submit" class="btn">搜索|Search</button>
                            </form>
                        </div>
                        </li>
                    </ul>
                    
                    <ul class="xny_M_b xny_M_b_Ul">
                    <?php foreach ($data as $product): ?>
                        <li>
                            <img src="../<?php echo $product['images']; ?>" alt="">
                            <h2 class="ellipsis"><?php echo $product['name']; ?></h2>
                            <div class="price">$<?php echo $product['price']; ?></div>
                            <a class="c_btn" href="cart_add.php?product_id=<?php echo $product['id']; ?>&quantity=1">加入购物车Add</a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
          </div>
                <?php
    require 'footer.php'
    ?>
          
    </div> 
   
    <script src="./js/main.js"></script>
</body>
</html>