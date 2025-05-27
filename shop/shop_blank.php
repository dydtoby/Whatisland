
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
     $sql = "SELECT  id,name,price,images,stock,jf
    FROM {$prefix}jfdh"; // 初始条件
    $sql .= " ORDER BY created_at DESC";
    $data = query($sql); 

    
    ?>
    <style>
    .Main_S_M{position: relative;top:60px;}
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
        <div class="blank_Main">
            <div class="blank_M Width1440">
            <div class="user_header">
                    <div class="user_avatar">
                        <img class="bTmg" 
                        src="<?php echo $bTmg_src; ?>"
                        referrerpolicy="no-referrer"
                        loading="lazy"
                        alt="B站头像"
                        onerror="this.style.display='none'">
                    </div>
                    <div class="user_avatar">
                    <img src="<?php echo !empty($user['images']) ? './images/'.$user['images'] : ''; ?>">
                    </div>
                    <div class="user_info">
                    <h1><?php echo htmlspecialchars($user['username']); ?>
                            <span class="verify_badge"></span>
                        </h1>
                        <div class="user_data">
                            <div class="data_item">
                                <span class="num"><?php echo number_format($user['jf']); ?></span>
                                <span class="label">累计奶油值|TotalPts</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="goods_grid">
                    <h2>奶油值兑换|Pts Redeem</h2>
                    <?php foreach ($data as $product): ?>
                        <div class="goods_item" data-id="<?php echo $product['id']; ?>">
                        <div class="goods_thumb">
                        <img src="../<?php echo $product['images']; ?>" alt="">
                        </div>
                        <div class="goods_info">
                        <h3 class="ellipsis"><?php echo $product['name']; ?></h3>
                            <div class="goods_price">
                            <span class="cost"><?php echo $product['jf']; ?>奶油值|Pts</span>
                            </div>
                            <div class="goods_actions">
                                <button class="exchange_btn">
                                    立即兑换|Exch.
                                </button>
                                <div class="remaining">剩余:<?php echo $product['stock']; ?>件|Last: <?php echo $product['stock']; ?>pc
                                </div>
                            </div>
                            
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                   
                    
                </div>
            </div>
        </div>
        <div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div class="modal-tabs">
            <div class="tab active" onclick="switchTab(1)">修改头像</div>
            <div class="tab" onclick="switchTab(2)">修改密码</div>
        </div>

        <!-- 头像修改 -->
        <div id="tab1" class="tab-content active">
            <div class="current-user">当前用户：<?=htmlspecialchars($_SESSION['username'])?></div>
            <div class="avatar-grid">
                <?php for($i=1;$i<=5;$i++): ?>
                <img src="./images/i<?=$i?>.jpg" 
                     class="avatar-option <?=$i==1?'selected':''?>" 
                     onclick="selectAvatar(this)"
                     data-src="i<?=$i?>.jpg">
                <?php endfor; ?>
            </div>
            <button class="confirm-btn" onclick="updateAvatar()">保存头像</button>
        </div>

        <!-- 密码修改 -->
        <div id="tab2" class="tab-content">
            <form id="passwordForm">
                <div class="form-group">
                    <label>当前密码：</label>
                    <input type="password" id="currentPass" required>
                </div>
                <div class="form-group">
                    <label>新密码：</label>
                    <input type="password" id="newPass" required>
                    <div class="password-rules">
                        需包含：大写字母、小写字母、数字、特殊字符，至少8位
                    </div>
                </div>
                <div class="form-group">
                    <label>确认密码：</label>
                    <input type="password" id="confirmPass" required>
                </div>
                <button type="button" class="confirm-btn" onclick="updatePassword()">修改密码</button>
            </form>
        </div>
    </div>
</div>

<!-- 注销确认模态框 -->
<div id="deleteModal" class="modal">
    <div class="modal-content small">
        <h3>确认注销账号</h3>
        <p>此操作将永久删除您的所有数据！</p>
        <div class="input-group">
            <label>输入UID确认：</label>
            <input type="text" id="confirmUid">
        </div>
        <div class="action-buttons">
            <button class="cancel-btn" onclick="closeModal()">取消</button>
            <button class="confirm-btn danger" onclick="confirmDelete()">确认注销</button>
        </div>
    </div>
</div> 
        <?php
    require 'footer.php'
    ?>
    </div>
    <script src="./js/main.js"></script>
    <script>
// 奶油值兑换功能
document.querySelectorAll('.exchange_btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const productItem = this.closest('.goods_item');
        const productId = productItem.dataset.id;
        const productJf = parseInt(productItem.querySelector('.cost').textContent);
        const productStock = parseInt(productItem.querySelector('.remaining').textContent.match(/\d+/)[0]);
        const quantity = 1;
        
        // 显示确认对话框
        if(confirm(`确定要兑换此商品吗？将消耗${productJf * quantity}奶油值`)) {
            exchangeProduct(productId, quantity);
        }
    });
});

function exchangeProduct(productId, quantity) {
    fetch('../api/exchange_api.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `product_id=${productId}&quantity=${quantity}`
    })
    .then(response => response.json())
    .then(data => {
        if(data.code === 200) {
            alert(data.msg);
            // 更新页面显示
            location.reload(); // 简单起见直接刷新页面
        } else {
            alert('兑换失败: ' + data.msg);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('兑换请求失败');
    });
}
</script>
</body>
</html>