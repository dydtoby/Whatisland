
  <?php
    require 'header.php';
    require 'auth.php';
    $prefix = getDBPrefix();
    $user_id =getSession('id', 'shop');
    $sql = "SELECT images, username, jf,uid
            FROM {$prefix}user 
            WHERE id = '$user_id'";
    $user = queryOne($sql); 
    $avatar_uid = $user['uid'] ?? 0;
    $bTmg_src = "https://workers.vrp.moe/bilibili/avatar/".$avatar_uid;
    ?> <style>
    footer{margin-top: 150px;}
    body{position: relative;}
    /* 上传模态框样式 */
.modal {
    display: none;
    position: fixed;
    z-index: 100;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
}

.modal-content {
    background-color: #fefefe;
    margin: 10% auto;
    padding: 20px;
    border-radius: 8px;
    width: 400px;
    max-width: 90%;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover {
    color: black;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
}

.form-group input[type="file"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.confirm-btn {
    background-color: #4CAF50;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

.confirm-btn:hover {
    background-color: #45a049;
}    .Main_S_M{position: relative;top:60px;}
.logo {
  top: -120px;
}.touxiang {
  top: -120px;
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
    <div class="tu_Main">
            <div class="tu_M Width1440">
                <div class="bwg_M_title">
                    <h2>兔堡堡资源库</h2>
                    <button class="upload-btn">
                        <img src="./images/icons/upload.png" alt="">
                        上传文件
                    </button>
                </div>
                
                <!-- <div class="file-manager"> -->
                    <!-- <div class="file-toolbar">
                        <div class="search-box">
                            <input type="text" placeholder="搜索资源...">
                        </div>
                        <div class="file-actions">
                            <button class="new-folder">新建文件夹</button>
                        </div>
                    </div>
                     -->
                    <div class="file-list">
                        <?php
                        $prefix = getDBPrefix();
                        $user_id = getSession('id', 'shop');
                        
                        // 获取用户上传的文件列表
                        $sql = "SELECT id, name, files, created_at 
                                FROM {$prefix}wp 
                                WHERE userid = '$user_id' 
                                ORDER BY created_at DESC";
                        $files = query($sql);
                        
                        if (!empty($files)) {
                            foreach ($files as $file) {
                                // 获取文件类型对应的图标
                                $ext = pathinfo($file['files'], PATHINFO_EXTENSION);
                                $icon = getFileIcon($ext);
                                
                                // 格式化日期
                                $date = date('Y-m-d', strtotime($file['created_at']));
                                ?>
                                <div class="file-item">
                                    <!-- <img src="<?php echo $icon; ?>" class="file-icon"> -->
                                    <div class="file-info">
                                        <h3><?php echo htmlspecialchars($file['name']); ?></h3>
                                        <span><?php echo $date; ?></span>
                                    </div>
                                    <div class="file-actions">
                                        <button class="download-btn" onclick="downloadFile(<?php echo $file['id']; ?>)">下载</button>
                                        <button class="delete-btn" onclick="deleteFile(<?php echo $file['id']; ?>)">删除</button>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo '<div class="no-files">暂无上传文件</div>';
                        }
                        
                        // 文件类型图标函数
                        function getFileIcon($ext) {
                            $ext = strtolower($ext);
                            $imageExts = ['jpg', 'jpeg', 'png', 'gif'];
                            if (in_array($ext, $imageExts)) {
                                return './images/icons/image.png';
                            }
                            switch ($ext) {
                                case 'pdf': return './images/icons/pdf.png';
                                case 'doc':
                                case 'docx': return './images/icons/word.png';
                                case 'xls':
                                case 'xlsx': return './images/icons/excel.png';
                                case 'txt': return './images/icons/txt.png';
                                default: return './images/icons/file.png';
                            }
                        }
                        ?>
                    </div>
                <!-- </div> -->
            </div>
        </div>
        <div id="uploadModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>上传文件</h2>
        <form id="uploadForm" enctype="multipart/form-data">
            <div class="form-group">
                <label for="fileInput">选择文件：</label>
                <input type="file" id="fileInput" name="file" required>
            </div>
            <button type="submit" class="confirm-btn">上传</button>
        </form>
        <div class="progress-container" style="margin: 15px 0; display: none;">
            <div class="progress-bar" style="height: 20px; background: #eee; border-radius: 10px;">
                <div class="progress" style="width: 0%; height: 100%; background: #4CAF50; border-radius: 10px; transition: width 0.3s;"></div>
            </div>
            <div class="progress-text" style="text-align: center; margin-top: 5px;">0%</div>
        </div>
    </div>
</div>
</div>
        <?php
        require 'footer.php'
        ?>
    </div> 
    
<script>
// 显示上传模态框
document.querySelector('.upload-btn').addEventListener('click', function() {
    document.getElementById('uploadModal').style.display = 'block';
});

// 关闭模态框
function closeModal() {
    document.getElementById('uploadModal').style.display = 'none';
}

// 点击遮罩层关闭
document.querySelector('.modal').addEventListener('click', function(e) {
    if(e.target === this) closeModal();
});

// 文件上传处理
document.getElementById('uploadForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const fileInput = document.getElementById('fileInput');
    if(fileInput.files.length === 0) {
        alert('请选择文件');
        return;
    }

    // 显示进度条
    const progressContainer = document.querySelector('.progress-container');
    const progressBar = document.querySelector('.progress');
    const progressText = document.querySelector('.progress-text');
    progressContainer.style.display = 'block';

    const xhr = new XMLHttpRequest();
    const formData = new FormData();
    formData.append('file', fileInput.files[0]);

    xhr.upload.addEventListener('progress', function(e) {
        if (e.lengthComputable) {
            const percent = Math.round((e.loaded / e.total) * 100);
            progressBar.style.width = percent + '%';
            progressText.textContent = percent + '%';
        }
    });

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            progressContainer.style.display = 'none';
            try {
                const data = JSON.parse(xhr.responseText);
                if (data.code === 200) {
                    alert(data.msg);
                    closeModal();
                    // 更新奶油值显示
                    document.querySelectorAll('.num').forEach(el => {
                        el.textContent = (parseInt(el.textContent.replace(/,/g, '')) - 500).toLocaleString();
                    });
                    // 刷新文件列表
                    setTimeout(() => location.reload(), 1000);
                } else {
                    alert('上传失败: ' + data.msg);
                }
            } catch (error) {
                alert('上传请求失败');
            }
        }
    };

    xhr.open('POST', '../api/upload.php', true);
    xhr.send(formData);
});
// 下载文件
// function downloadFile(fileId) {
//     window.open(`../api/download.php?id=${fileId}`, '_blank');
// }

function downloadFile(fileId) {
  // 改用fetch API处理请求
  fetch(`../api/download.php?id=${fileId}`, {
    credentials: 'include' // 携带cookie用于session验证
  })
  .then(response => {
    // 获取Content-Type检查响应类型
    const contentType = response.headers.get('content-type')
    
    // 错误响应处理（JSON格式）
    if (contentType.includes('application/json')) {
      return response.json().then(errData => {
        throw new Error(errData.msg || '下载失败')
      })
    }
    
    // 文件流处理（octet-stream）
    if (contentType.includes('octet-stream')) {
      return response.blob().then(blob => {
        // 创建临时URL触发下载
        const url = window.URL.createObjectURL(blob)
        const a = document.createElement('a')
        a.href = url
        
        // 从Content-Disposition获取文件名
        const disposition = response.headers.get('content-disposition')
        a.download = disposition 
          ? disposition.split('filename=')[1].replace(/"/g, '')
          : 'download.file'

        document.body.appendChild(a)
        a.click()
        
        // 清理资源
        window.URL.revokeObjectURL(url)
        document.body.removeChild(a)
      })
    }
    
    throw new Error('未知响应类型')
  })
  .catch(error => {
    console.error('下载失败:', error)
    alert(error.message) // 或用UI框架显示错误提示
  })
}
// 删除文件
function deleteFile(fileId) {
    if(confirm('确定要删除这个文件吗？')) {
        fetch(`../api/delete_file.php?id=${fileId}`, {
            method: 'POST'
        })
        .then(response => response.json())
        .then(data => {
            if(data.code === 200) {
                alert('删除成功');
                location.reload();
            } else {
                alert( data.msg);
            }
        });
    }
}
</script>
</body>
</html>