<?php
require '../tools.func.php';
require 'auth.php';
require '../db.func.php';

$prefix = getDBPrefix();
$id = intval($_GET['id']);

// 获取分类信息
$cate = queryOne("SELECT * FROM {$prefix}message_cate WHERE id = '$id'");
if (!$cate) {
    header('Location: cate_list.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $color = trim($_POST['color']);

    // 验证数据
    if (empty($name)) {
        setInfo('分类名称不能为空');
    } elseif (!preg_match('/^#[0-9a-fA-F]{6}$/', $color)) {
        setInfo('颜色格式不正确');
    } else {
        // 检查重复（排除自己）
        $exists = queryOne("SELECT id FROM {$prefix}message_cate 
                          WHERE name = '".addslashes($name)."' 
                          AND id != '$id'");
        if ($exists) {
            setInfo('分类名称已存在');
        } else {
            $sql = "UPDATE {$prefix}message_cate 
                    SET name = '".addslashes($name)."', 
                        col = '$color' 
                    WHERE id = '$id'";
            if (execute($sql)) {
                setInfo('修改成功');
                header("Location: cate_list.php");
                exit;
            } else {
                setInfo('修改失败');
            }
        }
    }
}

require 'header.php';
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">编辑分类</h4>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">分类名称</label>
                                <input type="text" name="name" 
                                       value="<?php echo htmlspecialchars($cate['name']); ?>" 
                                       class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">选择颜色</label>
                                <input type="color" name="color" 
                                       value="<?php echo $cate['col']; ?>" 
                                       class="form-control" 
                                       style="height: 40px; padding: 5px;">
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