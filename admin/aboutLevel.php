<?php
require '../tools.func.php';
require 'auth.php';
require '../db.func.php';

$prefix = getDBPrefix();
$sql = "SELECT id, title, name, created_at 
        FROM {$prefix}about_t 
        ORDER BY created_at DESC";
$about_list = query($sql);

require 'header.php';
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">关于我们管理</h4>
                <p class="card-category">管理关于我们的内容</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-primary">
                            <tr>
                                <th>ID</th>
                                <th>标题</th>
                                <th>创建时间</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($about_list as $item): ?>
                            <tr>
                                <td><?php echo $item['id']; ?></td>
                                <td><?php echo htmlspecialchars($item['title']); ?></td>
                                <td><?php echo $item['created_at']; ?></td>
                                <td>
                                    <a href="aboutLevelEdit.php?id=<?php echo $item['id']; ?>" class="btn btn-sm btn-primary">编辑</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require 'footer.php';
?>