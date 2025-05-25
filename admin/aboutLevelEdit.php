<?php
require '../tools.func.php';
require 'auth.php';
require '../db.func.php';

// 1. 接收id
$id = intval($_GET['id']);
if (empty($id)) {
    header('location: about_list.php');
}

// 2. 根据id查询内容
$prefix = getDBPrefix();
$sql = "SELECT id, title, name, created_at
        FROM {$prefix}about_t WHERE id = '$id'";
$about = queryOne($sql);
if (empty($about)) {
    header('location: about_list.php');
}

// 3. 判断是否为post提交
if (!empty($_POST['title'])) {
    // 4. 接收post数据
    $title = htmlentities($_POST['title']);
    $name = htmlentities($_POST['name']);
    
    // 5. 更新数据记录
    $sql = "UPDATE {$prefix}about_t 
            SET title = '$title', name = '$name'
            WHERE id = '$id'";
    
    if (execute($sql)) {
        $about = array_merge($about, $_POST);
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
                <h4 class="card-title">编辑关于我们</h4>
                <p class="card-category">编辑关于我们的内容</p>
            </div>
            <div class="card-body">
                <p style="color:#c00"><?php if (hasInfo()) echo getInfo(); ?></p>
                <form method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">标题</label>
                                <input type="text" name="title" value="<?php echo $about['title']; ?>" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>内容</label>
                                <div class="form-group bmd-form-group">
                                    <textarea name="name" class="form-control" rows="10"><?php echo $about['name']; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">保存修改</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
require 'footer.php';
?>