<?php
require '../tools.func.php';
require 'auth.php';
require '../db.func.php';

$id = intval($_GET['id']);
if (empty($id)) {
    header('location: aboutList.php');
}

$prefix = getDBPrefix();
$sql = "SELECT * FROM {$prefix}about_list WHERE id = '$id'";
$item = queryOne($sql);
if (empty($item)) {
    header('location: aboutList.php');
}

if (!empty($_POST['name'])) {
    $name = htmlentities($_POST['name']);
    $content = htmlentities($_POST['content']);
    
    $sql = "UPDATE {$prefix}about_list 
            SET name = '$name', content = '$content'
            WHERE id = '$id'";
    
    if (execute($sql)) {
        $item = array_merge($item, $_POST);
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
                <h4 class="card-title">编辑条目</h4>
                <p class="card-category">编辑关于我们条目</p>
            </div>
            <div class="card-body">
                <p style="color:#c00"><?php if (hasInfo()) echo getInfo(); ?></p>
                <form method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">标题</label>
                                <input type="text" name="name" value="<?php echo $item['name']; ?>" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>详细内容</label>
                                <div class="form-group bmd-form-group">
                                    <textarea name="content" class="form-control" rows="8" required><?php echo $item['content']; ?></textarea>
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