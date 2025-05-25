<?php
require '../db.func.php';
require '../tools.func.php';
require 'auth.php';

$prefix = getDBPrefix();
$sql = "SELECT id, adminuser, created_at, login_at, login_ip 
        FROM {$prefix}admin ORDER BY created_at DESC";
$data = query($sql);

require 'header.php';
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <div class="row">
                    <div class="col-10">
                        <h4 class="card-title">所有管理员</h4>
                        <p class="card-category">控制台所有管理员列表</p>
                    </div>
                    <!-- <div class="col-2">
                        <a href="index_add.php" class="btn btn-round btn-info">添加管理员</a>
                    </div> -->
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="text-primary">
                            <th>ID</th>
                            <th>用户名</th>
                            <th>创建时间</th>
                            <th>最后登录时间</th>
                            <th>最后登录IP</th>
                            <!-- <th>操作</th> -->
                        </thead>
                        <tbody>
                            <?php foreach ($data as $admin): ?>
                            <tr>
                                <td><?php echo $admin['id']; ?></td>
                                <td><?php echo $admin['adminuser']; ?></td>
                                <td><?php echo $admin['created_at']; ?></td>
                                <td><?php echo $admin['login_at']; ?></td>
                                <td><?php echo long2ip($admin['login_ip']); ?></td>
                                <!-- <td>
                                    <a href="index_edit.php?id=<?php echo $admin['id']; ?>">编辑</a>
                                    |
                                    <a href="index_del.php?id=<?php echo $admin['id']; ?>" 
                                       onclick="return confirm('确认删除该管理员？')">删除</a>
                                </td> -->
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