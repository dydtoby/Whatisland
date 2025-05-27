
  <?php
    require 'header.php';
    $prefix = getDBPrefix();
    $user_id =getSession('id', 'shop'); ;
    $sql = "SELECT images, username, jf,uid
            FROM {$prefix}user 
            WHERE id = '$user_id'";
    $user = queryOne($sql); 
    $avatar_uid = $user['uid'] ?? 0;
    $bTmg_src = "https://workers.vrp.moe/bilibili/avatar/".$avatar_uid;
    $aboutListSql = "SELECT  *
    FROM {$prefix}about_list"; 
    // $aboutListSql .= " ORDER BY created_at DESC";
    $aboutData= query($aboutListSql); 

    $aboutListTSql = "SELECT  *
    FROM {$prefix}about_t";
    // $aboutListSql .= " ORDER BY created_at DESC";
    $aboutTData= query($aboutListTSql); 
    
    $user_id =getSession('id', 'shop'); ;
    $sql = "SELECT images, username, jf
            FROM {$prefix}user 
            WHERE id = '$user_id'";
    $user = queryOne($sql); 

    $userCountSql = "SELECT COUNT(*) AS total FROM {$prefix}user";
    $userCount = queryOne($userCountSql);
    $totalUsers = !empty($userCount['total']) ? number_format($userCount['total']) : 0;

    $resourceCountSql = "SELECT COUNT(*) AS total FROM {$prefix}wp";
    $resourceCount = queryOne($resourceCountSql);
    $totalResources = !empty($resourceCount['total']) ? number_format($resourceCount['total']) : 0;
    ?>
    <style>
  

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
        <div class="about_Main">
                <div class="about_M Width1440">
                    <div class="about_M_t">
                        <div class="about_M_t_t">
                            <h2>About</h2>
                            <h4>基本信息</h4>
                        </div>
                        <div class="about_M_b">
                            <div class="about_M_b_l">
                                <img src="./images/cream.png" alt="">
                            </div>
                            <div class="about_M_b_r">
                            <?php foreach ($aboutTData as $product): ?>
                                <p><?php echo $product['title']; ?>：<span><?php echo $product['name']; ?></span></p>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <ul class="about_M_b_list">
                        <?php foreach ($aboutData as $product): ?>
                        <li>
                            <h2 class="ellipsis"><?php echo $product['name']; ?></h2>
                            <div class="scrollableContent"> <?php echo htmlspecialchars_decode($product['content']); ?></div>
                        </li>
                        <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="about-section">
                        <div class="about-card">
                            <h2 class="about-title">
                                <i class=" glyphicon glyphicon-user"></i>
                                关于WhatIsland
                            </h2>
                            <div class="about-content">
                                <p>欢迎来到本站！我们是一个充满创造力的虚拟社区，致力于为岛民提供：</p>
                                <ul class="feature-list">
                                    <li> <i class="glyphicon glyphicon-inbox"></i><a href="https://whatisland.online/shop/index_bwg.php" target="_blank">创意展示空间</a></li>
                                    <li> <i class="glyphicon glyphicon-headphones"></i><a href="https://whatisland.online/shop/tu.php" target="_blank">资源共享平台</a></li>
                                    <li> <i class="glyphicon glyphicon-flag"></i><a href="https://whatisland.online/shop/index_xyc.php" target="_blank">友好交流环境</a></li>
                                </ul>
                                <div class="stats-grid">
                                    <div class="stat-item">
                                        <div class="stat-number"><?= $totalUsers ?></div>
                                        <div class="stat-label">注册岛民</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number"><?= $totalResources ?></div>
                                        <div class="stat-label">资源总量</div>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        <!-- 联系方式 -->
                        <div class="about-card contact-card">
                            <h2 class="about-title">
                                <i class=" glyphicon glyphicon-envelope"></i>
                                联系我们|Contact Us
                            </h2>
                            <div class="contact-info">
                                <div class="contact-item">
                                    <span class="contact-label">官方邮箱Official Email：</span>
                                    <a href="mailto:3190754144@qq.com">3190754144@qq.com</a>
                                </div>
                                <div class="contact-item">
                                    <span class="contact-label">服务时间Service time：</span>
                                     09:00 - 23:00 (UTC+1)
                                </div>
                                <!-- <button class="feedback-btn">问题反馈</button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <?php
    require 'footer.php'
    ?>
    </div>
</body>
</html>