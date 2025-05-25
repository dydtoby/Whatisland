<?php
require '../tools.func.php';
require 'auth.php';
require '../db.func.php';

if (!empty($_POST['name'])) {
    $name = htmlentities($_POST['name']);
    $content = htmlentities($_POST['content']);
    $created_at = date('Y-m-d H:i:s');
    
    $prefix = getDBPrefix();
    $sql = "INSERT INTO {$prefix}about_list (name, content, created_at)
            VALUES('$name', '$content', '$created_at')";
    
    if (execute($sql)) {
        setInfo('添加成功');
        header('location: aboutList.php');
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
                <h4 class="card-title">添加条目</h4>
                <p class="card-category">添加新的关于我们条目</p>
            </div>
            <div class="card-body">
                <p style="color:#c00"><?php if (hasInfo()) echo getInfo(); ?></p>
                <form method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">标题</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>详细内容</label>
                                <div class="form-group bmd-form-group">
                                    <textarea name="content" class="form-control" rows="8" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">添加条目</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
require 'footer.php';
?>