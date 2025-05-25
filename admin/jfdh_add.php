<?php
require '../tools.func.php';
require 'auth.php';
require '../db.func.php';

// 1. 判断是否为post提交
if (!empty($_POST['name'])) {
    // 2. 接收post数据
    $name = htmlentities($_POST['name']);
    $code = htmlentities($_POST['code']);
    $price = doubleval($_POST['price']);
    $stock = intval($_POST['stock']);
    $description = htmlentities($_POST['description']);
    $created_at = date('Y-m-d H:i:s');
    $jf = intval($_POST['jf']);
    
    // 处理图片上传
    $images = '';
    if (!empty($_FILES['images']['name'])) {
        $uploadDir = '../uploads/jfdh/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        $fileName = uniqid() . '_' . $_FILES['images']['name'];
        $targetFile = $uploadDir . $fileName;
        
        // 检查文件类型
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        
        if (in_array($imageFileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES['images']['tmp_name'], $targetFile)) {
                $images = 'uploads/jfdh/' . $fileName;
            } else {
                setInfo('图片上传失败');
            }
        } else {
            setInfo('只允许上传 JPG, JPEG, PNG 和 GIF 格式的图片');
        }
    }
    
    // 3. 写sql语句
    $prefix = getDBPrefix();
    $sql = "INSERT INTO {$prefix}jfdh(name, code, price, stock, description, images, created_at,jf)
            VALUES('$name', '$code', '$price', '$stock', '$description', '$images', '$created_at','$jf')";
    
    // 4. 执行插入
    if (execute($sql)) {
        setInfo('添加成功');
        header('location: jfdh.php');
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
                <h4 class="card-title">添加商品</h4>
                <p class="card-category">添加一个商品</p>
            </div>
            <div class="card-body">
                <p style="color:#c00";><?php if (hasInfo()) echo getInfo(); ?></p>
                <form action="jfdh_add.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">商品名称</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">奶油值</label>
                                <input type="number" name="jf" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">商品库存</label>
                                <input type="number" name="stock" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">商品编号</label>
                                <input type="text" name="code" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">商品图片</label>
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
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>商品描述</label>
                                <div class="form-group bmd-form-group">
                                    <textarea name="description" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div> -->
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
<?php
require 'footer.php';
?>