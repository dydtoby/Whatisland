
  <?php
    require 'header.php';
    require 'auth.php';
    $user_id =getSession('id', 'shop'); 
    $prefix = getDBPrefix();
    $sql = "SELECT images, username, jf,uid
            FROM {$prefix}user 
            WHERE id = '$user_id'";
    $user = queryOne($sql); 
    $avatar_uid = $user['uid'] ?? 0;
    $bTmg_src = "https://workers.vrp.moe/bilibili/avatar/".$avatar_uid;
    $today = date('Y-m-d');
    $sign_sql = "SELECT id FROM {$prefix}qd 
                WHERE userid = '$user_id' 
                AND DATE(created_at) = '$today'";
    $signed = queryOne($sign_sql);

    $exchange_records = [];
    if ($signed) {
        $exchange_sql = "SELECT jl.*, jf.name as product_name 
                        FROM {$prefix}jfdh_jl jl
                        LEFT JOIN {$prefix}jfdh jf 
                        ON jl.pid = jf.id
                        WHERE jl.uid = '{$user['uid']}'
                        ORDER BY jl.created_at DESC 
                        LIMIT 5";
        $exchange_records = query($exchange_sql);

    }
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
        <div class="sea_Main">
            <div class="sea_M Width1440">
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
                    <div class="user_data_r">
                        <div class="user_actions">
                            <div class="btn">修改资料|Edit</div>
                        </div>
                    </div>
                </div>
                <div class="points-display">
                    <h1>当前奶油值|CurrentPts</h1>
                    <div class="num"><?php echo number_format($user['jf']); ?></div>
                </div>
        
                <!-- 签到日历 -->
                <!-- <div class="calendar">
                    <h2>📅 签到日历</h2>
                    <div class="calendar-grid">
                        <div class="day signed ">
                            <div class="date">今天</div>
                            <div class="points">+5</div>
                        </div>
                        <div class="day">
                            <div class="date">明天</div>
                            <div class="points">+5</div>
                        </div>
                        <div class="day"><div class="date">3天</div> <div class="points">+5</div></div>
                        <div class="day"><div class="date">4天</div> <div class="points">+5</div></div>
                        <div class="day"><div class="date">5天</div> <div class="points">+5</div></div>
                        <div class="day"><div class="date">6天</div> <div class="points">+5</div></div>
                        <div class="day"><div class="date">7天</div> <div class="points">+5</div></div>
                    </div>
                    <div class="qdBtn">签到</div>
                </div> -->
                <?php if($signed): ?>
                <div class="exchange-records">
                    <h2>🎁 我的兑换记录My Redemptions</h2>
                    <div class="record-list">
                        <?php if(!empty($exchange_records)): ?>
                            <?php foreach($exchange_records as $record): ?>
                            <div class="record-item">
                                <div class="product-info">
                                    <span class="name"><?php echo $record['product_name']; ?></span>
                                    <span class="quantity">×<?php echo $record['num']; ?></span>
                                </div>
                                <div class="detail-info">
                                    <span class="points">-<?php echo $record['total_jf']; ?>奶油值|Pts</span>
                                    <span class="time"><?php echo date('m/d H:i', strtotime($record['created_at'])); ?></span>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="no-records">暂无兑换记录|No History</div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php else: ?>
                <div class="calendar">
                    <h2>📅 签到日历|Check-in</h2>
                    <div class="calendar-grid">
                        <div class="day signed ">
                            <div class="date">今天today</div>
                            <div class="points">+5</div>
                        </div>
                        <div class="day">
                            <div class="date">明天tmrw</div>
                            <div class="points">+5</div>
                        </div>
                        <div class="day"><div class="date">3天day</div> <div class="points">+5</div></div>
                        <div class="day"><div class="date">4天day</div> <div class="points">+5</div></div>
                        <div class="day"><div class="date">5天day</div> <div class="points">+5</div></div>
                        <div class="day"><div class="date">6天day</div> <div class="points">+5</div></div>
                        <div class="day"><div class="date">7天day</div> <div class="points">+5</div></div>
                    </div>
                    <div class="qdBtn">签到|Check in</div>
                </div> 
                <?php endif; ?>
            </div>
            <div class="tqList Width1440">
                <h2>天气weather</h2>
            <ul>
                <!-- 天气信息将被动态填充到这里 -->
            </ul>
        </div>
        </div>
        <div id="editModal" class="modal">
    <div class="modal-content">

        <!-- 基本资料 -->
        <div id="tab1" class="tab-content active">
            <div class="input-group">
                <label>用户名：</label>
                <input type="text" value="<?php echo $username; ?>" readonly>
            </div>
        </div>

        <!-- 头像修改 -->
        <div id="tab2" class="tab-content">
            <div class="avatar-grid">
                <?php for($i=1;$i<=5;$i++): ?>
                <img src="./images/i<?=$i?>.png" 
                     class="avatar-option <?=$i==1?'selected':''?>" 
                     onclick="selectAvatar(this)"
                     data-src="i<?=$i?>.png">
                <?php endfor; ?>
            </div>
            <button class="confirm-btn" onclick="updateAvatar()">保存头像|Save Avatar</button>
        </div>

        <!-- 密码修改 -->
        <div id="tab3" class="tab-content">
            <div class="input-group">
                <label>新密码|new password：</label>
                <input type="password" id="newPass" required>
                <div class="password-rules">需包含：大写字母、小写字母、数字、特殊字符，至少8位<br>Need to include: uppercase letters, lowercase letters, numbers, special characters, at least 8 digits</div>
            </div>
            <button class="confirm-btn" onclick="updatePassword()">修改密码|change your password</button>
        </div>
        <div class="delete-section">
            <div class="input-group">
                <label>注销账号|Cancellation of Account</label>
                <input type="text" id="uidInp"  placeholder="输入您的|Enter your Bilibili UID">
            </div>
            <button class="confirm-btn"  onclick="confirmDelete()">确认注销|Confirmation of cancellation</button>
        </div>
    </div>
</div>
        <?php
    require 'footer.php'
    ?>
    </div></div>
    <script>
        var swiper = new Swiper(".mySwiper", {
          slidesPerView: 1,
          spaceBetween: 30,
          loop: true,
          pagination: {
            el: ".swiper-pagination",
            clickable: true,
          },
          navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
          },
        });
      </script>
       <script src="./js/jquery-3.5.1.min.js"></script>
      <script>$.ajax({
        url: "https://api.openweathermap.org/data/2.5/forecast?q=York&appid=899a6885afbf0702188ef94eb3204236&units=metric&cnt=10",
        method: "GET",
        dataType: "jsonp",
        success: function (response) {
            // 在这里处理返回的天气信息，并填充到HTML中
            populateWeatherList(response.list);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("请求失败: " + textStatus, errorThrown);
        }
    });
    function populateWeatherList(weatherList) {
    var $ul = $('.tqList ul'); // 获取HTML中的<ul>元素
    $ul.empty(); // 清空<ul>中的现有内容

    // 遍历天气数据
    weatherList.forEach(function (day) {
        // 创建新的<li>元素
        var $li = $('<li></li>');

        // 获取日期信息（这里为了简化，只显示日期，不显示时间）
        var date = new Date(day.dt_txt);
        var formattedDate = date.toLocaleDateString(); // 格式化日期
        var formattedTime = date.toLocaleTimeString('zh-CN', { hour: '2-digit', minute: '2-digit' }); // 格式化时间
        var $tqOne = $('<div class="tqOne"></div>').text(formattedDate);
        var $tqOneP = $('<div class="tqOneP"></div>').text(formattedTime);
        // 创建<p>元素显示日期
        // var $dateP = $('<p></p>').text(formattedDate);

        // 创建天气图标占位符
        var $tqImg = $('<div class="tqImg"></div>');
        // 获取天气状况描述
        var weatherDescription = day.weather[0].description
        if (weatherDescription.toLowerCase().includes('clear')) {
            weatherDescription = '晴|clear'
                $tqImg.addClass('tqImg_q');
        } else if (weatherDescription.toLowerCase().includes('clouds')) {
            weatherDescription = '阴天/多云|clouds'
              $tqImg.addClass('tqImg_yin');
        }
        else if (weatherDescription.toLowerCase().includes('rain')) {
            weatherDescription = '雨|rain'
            $tqImg.addClass('tqImg_yu');
        }
        // 创建<p>元素显示天气状况
        var $weatherP = $('<p></p>').text(weatherDescription);

        // 获取温度信息
        var tempMin = day.main.temp_min;
        var tempMax = day.main.temp_max;

        // 创建<h3>元素显示温度范围
        var $tempH3 = $('<h3></h3>').text(tempMin + '-' + tempMax + '°');

        // 将所有元素添加到<li>中
        $li.append($tqOne ,$tqOneP/*, $dateP*/ , $tqImg, $weatherP, $tempH3);
        // $li.append($tqOne /*, $dateP*/ , $weatherP, $tempH3);

        // 将<li>添加到<ul>中
        $ul.append($li);
    });
}
    
      </script>
              <script>
// 显示修改资料模态框
function showEditModal() {
    document.getElementById('editModal').style.display = 'block';
}

// 关闭模态框
function closeModal() {
    document.getElementById('editModal').style.display = 'none';
}

// 头像选择
let selectedAvatar = 'i1.jpg';
function selectAvatar(element) {
    document.querySelectorAll('.avatar-option').forEach(img => img.classList.remove('selected'));
    element.classList.add('selected');
    selectedAvatar = element.dataset.src;
}

// 密码验证正则
function validatePassword(password) {
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    return regex.test(password);
}

// 更新头像
async function updateAvatar() {
    const selectedAvatar = document.querySelector('.avatar-option.selected').dataset.src;
    fetch(`../api/update_avatar.php?avatar=${encodeURIComponent(selectedAvatar)}`)
        .then(response => response.json())
        .then(data => {
            if(data.code === 200) {
                alert('更新成功|success');
                location.reload();
            } else {
                alert(data.msg);
            }
        });
}

// 更新密码
async function updatePassword() {
    const newPass = document.getElementById('newPass').value;
    
    fetch(`../api/update_password.php?newPass=${encodeURIComponent(newPass)}`)
        .then(response => response.json())
        .then(data => {
            if(data.code === 200) {
                alert('密码修改成功|success');
                location.reload();
            } else {
                alert(data.msg);
            }
        });
}

// 点击遮罩层关闭
document.querySelector('.modal').addEventListener('click', function(e) {
    if(e.target === this) closeModal();
});

// 绑定修改资料按钮点击事件
document.querySelector('.user_actions .btn').addEventListener('click', showEditModal);
//注销
function confirmDelete() {
    const uidInp = document.getElementById('uidInp').value;
    if(uidInp ==='')
    {
        alert('请输入/Enter uid');
        return false;
    }
    fetch(`../api/delete_account.php?uidInp=${encodeURIComponent(uidInp)}`)
        .then(response => response.json())
        .then(data => {
            if(data.code === 200) {
                alert('注销成功|Successful cancellation');
                location.href = '../shop/login.php';
            } else {
                alert(data.msg);
            }
    });
}
// 检查今天是否已签到
function checkSignStatus() {
    fetch('../api/check_sign.php')
        .then(response => response.json())
        .then(data => {
            if(data.signed) {
                document.querySelector('.qdBtn').textContent = '已签到Signed in';
                document.querySelector('.qdBtn').classList.add('signed');
                document.querySelector('.qdBtn').disabled = true;
            }
        });
}

// 签到功能
document.querySelector('.qdBtn').addEventListener('click', function() {
    fetch('../api/qd_api.php', {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        if(data.code === 200) {
            alert(data.msg);
            location.reload();
            // 更新按钮状态
            // this.textContent = '已签到';
            // this.classList.add('signed');
            
            // this.disabled = true;
            // // 更新奶油值显示
            // document.querySelector('.points-display .num').textContent = 
            //     parseInt(document.querySelector('.points-display .num').textContent.replace(/,/g, '')) + 5;
            // document.querySelector('.user_data .num').textContent = 
            //     parseInt(document.querySelector('.user_data .num').textContent.replace(/,/g, '')) + 5;
        } else {
            alert(data.msg);
        }
    });
});

// 页面加载时检查签到状态
window.addEventListener('load', checkSignStatus);
</script>
</body>
</html>