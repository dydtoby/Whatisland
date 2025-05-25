<?php
require '../tools.func.php';
require 'auth.php';
require '../db.func.php';

if (!empty($_POST['name'])) {
    $name = htmlentities($_POST['name']);
    $created_at = date('Y-m-d H:i:s');
    $see = intval($_POST['see']);
    $down = intval($_POST['down']);
    $tab = htmlentities($_POST['tab']);
    
    // 图片上传处理
    $images = '';
    if (!empty($_FILES['images']['name'])) {
        $uploadDir = '../uploads/zy/';
        if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);
        
        $fileName = uniqid() . '_' . $_FILES['images']['name'];
        $targetFile = $uploadDir . $fileName;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        
        if (in_array($fileType, $allowed)) {
            if (move_uploaded_file($_FILES['images']['tmp_name'], $targetFile)) {
                $images = 'uploads/zy/' . $fileName;
            } else {
                setInfo('图片上传失败');
            }
        } else {
            setInfo('只允许上传 JPG, JPEG, PNG 和 GIF 格式的图片');
        }
    }
    
    // 插入数据库
    $prefix = getDBPrefix();
    $sql = "INSERT INTO {$prefix}zy(name, images,see,down, created_at,tab)
            VALUES('$name', '$images', '$see', '$down', '$created_at','$tab')";
    
    if (execute($sql)) {
        setInfo('添加成功');
        header('location: zy.php');
    } else {
        setInfo('添加失败');
    }
}

require 'header.php';
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">添加资源</h4>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">资源名称</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">tab标签（,逗号分割）</label>
                                <input type="text" name="tab" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">浏览数</label>
                                <input type="see" name="see" class="form-control" step="0.01" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">下载量</label>
                                <input type="down" name="down" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">资源图片</label>
                                <div class="custom-file">
                                    <input type="file" name="images" class="custom-file-input" id="customFile" accept="image/*">
                                    <label class="custom-file-label upload_file" for="customFile">选择图片文件</label>
                                </div>
                                <!-- <small class="form-text text-muted">支持 JPG, JPEG, PNG, GIF 格式，大小不超过 2MB</small> -->
                                <!-- 图片预览区域 -->
                                <div class="mt-3">
                                    <img id="imagePreview" src="#" alt="图片预览" class="img-thumbnail" style="max-width: 200px; display: none;">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">添加商品</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
// 显示选中的文件名和图片预览
document.querySelector('.custom-file-input').addEventListener('change', function(e) {
    // 显示文件名
    var fileName = document.getElementById("customFile").files[0].name;
    var nextSibling = e.target.nextElementSibling;
    nextSibling.innerText = fileName;
    
    // 图片预览
    var file = e.target.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function(event) {
            var preview = document.getElementById('imagePreview');
            preview.src = event.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});
</script>
<?php require 'footer.php'; ?>