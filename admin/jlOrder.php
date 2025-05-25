<?php
require '../tools.func.php';
require 'auth.php';
require '../db.func.php';
$prefix = getDBPrefix();

// 获取兑换记录（关联用户和商品表）
$sql = "SELECT jl.*, 
        u.username as username,
        jf.name as product_name 
        FROM {$prefix}jfdh_jl jl
        LEFT JOIN {$prefix}user u ON jl.uid = u.uid
        LEFT JOIN {$prefix}jfdh jf ON jl.pid = jf.id
        ORDER BY jl.created_at DESC";

$records = query($sql);
require 'header.php';
?>
                <div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-primary">
				<div class="row">
					<div class="col-10">
						<h4 class="card-title ">奶油值兑换记录品</h4>
						<p class="card-category"> 所有奶油值兑换操作记录</p>
					</div>
					<div class="col-2">
                        <a href="export_excel.php" class="btn btn-round btn-info" style="margin-left: 20px;">奶油值兑换excel导出</a>
					</div>
				</div>

			</div>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="text-primary">
                            <th>ID</th>
                            <th>兑换用户</th>
                            <th>商品名称</th>
                            <th>兑换数量</th>
                            <th>消耗奶油值</th>
                            <th>兑换时间</th>
                            <th>操作</th>
                        </thead>
                        <tbody>
                            <?php foreach($records as $record): ?>
                            <tr>
                                <td><?php echo $record['id']; ?></td>
                                <td>
                                    <?php echo htmlspecialchars($record['username']); ?>
                                    <!-- (UID:<?php echo $record['uid']; ?>) -->
                                </td>
                                <td><?php echo $record['product_name'] ?? '已下架商品'; ?></td>
                                <td><?php echo $record['num']; ?></td>
                                <td class="text-danger">-<?php echo $record['total_jf']; ?></td>
                                <td><?php echo $record['created_at']; ?></td>
                                <td>
                                    <a href="jfdh_jl_del.php?id=<?php echo $record['id']; ?>" 
                                       onclick="return confirm('确认删除该兑换记录？')"
                                       class="text-danger">删除</a>
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