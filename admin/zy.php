<?php
require '../tools.func.php';
require 'auth.php';
require '../db.func.php';
$prefix = getDBPrefix();
$sql = "SELECT * FROM {$prefix}zy ORDER BY created_at DESC";
$data = query($sql);
require 'header.php';
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <div class="row">
                    <div class="col-10">
                        <h4 class="card-title">所有资源</h4>
                        <p class="card-category">资源列表</p>
                    </div>
                    <div class="col-2">
                        <a href="zy_add.php" class="btn btn-round btn-info" style="margin-left: 20px;">添加资源</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="text-primary">
                            <th width="5%">ID</th>
                            <th>资源名称</th>
                            <th>图片</th>
                            <th>浏览数</th>
                            <th>下载量</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $zy): ?>
                            <tr>
                                <td><?php echo $zy['id']; ?></td>
                                <td><?php echo $zy['name']; ?></td>
                                <td>
                                    <?php if (!empty($zy['images'])): ?>
                                    <img src="../<?php echo $zy['images']; ?>" width="100">
                                    <?php endif; ?>
                                </td>
                                <td><?php echo $zy['see']; ?></td>
                                <td><?php echo $zy['down']; ?></td>
                                <td><?php echo $zy['created_at']; ?></td>
                                <td>
                                    <a href="zy_edit.php?id=<?php echo $zy['id']; ?>">编辑</a> |
                                    <a href="zy_del.php?id=<?php echo $zy['id']; ?>" 
                                       onclick="return confirm('确定删除该资源？')">删除</a>
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
<?php require 'footer.php'; ?>