<?php
require '../tools.func.php';
require 'auth.php';
require '../db.func.php';

// 1. 接收id
$id = intval($_GET['id']);
if (empty($id)) {
    header('location: jfdh.php');
}

// 2. 根据id查询商品
$prefix = getDBPrefix();
$sql = "SELECT id, name, code, description, stock, price, images, created_at,jf
        FROM {$prefix}jfdh WHERE id = '$id'";
$jfdh = queryOne($sql);
if (empty($jfdh)) {
    header('location: jfdh.php');
}

// 3. 判断是否为post提交
if (!empty($_POST['name'])) {
    // 4. 接收post数据
    $name = htmlentities($_POST['name']);
    $price = doubleval($_POST['price']);
    $stock = intval($_POST['stock']);
    $code = htmlentities($_POST['code']);
    $description = htmlentities($_POST['description']);
    $jf = intval($_POST['jf']);
    
    // 处理图片上传
    $images = $jfdh['images']; // 保留原有图片
    
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
                // 删除旧图片
                if (!empty($images) && file_exists('../' . $images)) {
                    unlink('../' . $images);
                }
                $images = 'uploads/jfdh/' . $fileName;
            } else {
                setInfo('图片上传失败');
            }
        } else {
            setInfo('只允许上传 JPG, JPEG, PNG 和 GIF 格式的图片');
        }
    }
    
    // 5. 更新数据记录
    $sql = "UPDATE {$prefix}jfdh 
            SET name = '$name', price = '$price', stock = '$stock', 
                code = '$code', description = '$description', images = '$images',jf = '$jf'
            WHERE id = '$id'";
    
    if (execute($sql)) {
        $jfdh = array_merge($jfdh, $_POST);
        $jfdh['images'] = $images;
        setInfo('更新成功');
    } else {
        setInfo('更新失败');
    }
}

require 'header.php';
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">编辑商品</h4>
                <p class="card-category">编辑商品信息</p>
            </div>
            <div class="card-body">
                <p style="color:#c00"><?php if (hasInfo()) echo getInfo(); ?></p>
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">商品名称</label>
                                <input type="text" name="name" value="<?php echo $jfdh['name']; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">奶油值</label>
                                <input type="number" name="jf" value="<?php echo $jfdh['jf']; ?>" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">商品库存</label>
                                <input type="number" name="stock" value="<?php echo $jfdh['stock']; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">商品编号</label>
                                <input type="text" name="code" value="<?php echo $jfdh['code']; ?>" class="form-control" required>
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
                                    <?php if (!empty($jfdh['images'])): ?>
                                        <img id="currentImage" src="../<?php echo $jfdh['images']; ?>" alt="当前图片" class="img-thumbnail" style="max-width: 200px; display: block;">
                                    <?php endif; ?>
                                    <img id="imagePreview" src="#" alt="新图片预览" class="img-thumbnail" style="max-width: 200px; display: none;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>商品描述</label>
                                <div class="form-group bmd-form-group">
                                    <textarea name="description" class="form-control" rows="5"><?php echo $jfdh['description']; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <button type="submit" class="btn btn-primary pull-right">修改商品</button>
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
            // 隐藏当前图片，显示新图片预览
            var currentImage = document.getElementById('currentImage');
            if (currentImage) {
                currentImage.style.display = 'none';
            }
            
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