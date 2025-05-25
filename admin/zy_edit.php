<?php
require '../tools.func.php';
require 'auth.php';
require '../db.func.php';
setInfo('');
$id = intval($_GET['id']);
if (empty($id)) header('location: zy.php');

$prefix = getDBPrefix();
$sql = "SELECT  id, name, see, down, tab,images, created_at
 FROM {$prefix}zy WHERE id = '$id'";
$zy = queryOne($sql);
if (empty($zy)) {
    header('location: zy.php');
}
if (!empty($_POST['name'])) {
    $name = htmlentities($_POST['name']);
    $see = intval($_POST['see']);
    $down = intval($_POST['down']);
    $tab = htmlentities($_POST['tab']);
    // 图片更新
    $images = $zy['images'];
    if (!empty($_FILES['images']['name'])) {
        $uploadDir = '../uploads/zy/';
        $fileName = uniqid() . '_' . $_FILES['images']['name'];
        $targetFile = $uploadDir . $fileName;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        
        if (in_array($fileType, $allowed)) {
            if (move_uploaded_file($_FILES['images']['tmp_name'], $targetFile)) {
                // 删除旧图片
                if (!empty($images) && file_exists("../$images")) {
                    unlink("../$images");
                }
                $images = 'uploads/zy/' . $fileName;
            }
        }
    }
    
    $sql = "UPDATE {$prefix}zy 
            SET name = '$name', images = '$images',see = '$see',down='$down',tab='$tab'
            WHERE id = '$id'";
    
    if (execute($sql)) {
        setInfo('更新成功');
        // header("location: zy_edit.php?id=$id");
        $zy = array_merge($zy, $_POST);
        $zy['images'] = $images;
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
                <h4 class="card-title">编辑资源</h4>
                <p class="card-category">编辑资源信息</p>
            </div>
            <div class="card-body">
                <p style="color:#c00"><?php if (hasInfo()) echo getInfo(); ?></p>
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">资源名称</label>
                                <input type="text" name="name" value="<?php echo $zy['name']; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">tab标签（,逗号分割）</label>
                                <input type="text" name="tab" value="<?php echo $zy['tab']; ?>" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">浏览数</label>
                                <input type="number" name="see" value="<?php echo $zy['see']; ?>" step="0" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">下载数</label>
                                <input type="number" name="down" value="<?php echo $zy['down']; ?>" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
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
                                    <?php if (!empty($zy['images'])): ?>
                                        <img id="currentImage" src="../<?php echo $zy['images']; ?>" alt="当前图片" class="img-thumbnail" style="max-width: 200px; display: block;">
                                    <?php endif; ?>
                                    <img id="imagePreview" src="#" alt="新图片预览" class="img-thumbnail" style="max-width: 200px; display: none;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">修改资源</button>
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