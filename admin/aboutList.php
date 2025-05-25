<?php
require '../tools.func.php';
require 'auth.php';
require '../db.func.php';
$prefix = getDBPrefix();
$sql = "SELECT * FROM {$prefix}about_list ORDER BY created_at DESC";
$data = query($sql);
require 'header.php';
?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-primary">
				<div class="row">
					<div class="col-10">
						<h4 class="card-title ">关于我们列表</h4>
						<p class="card-category"> 所有关于我们条目</p>
					</div>
					<div class="col-2">
						<a href="about_add.php" class="btn btn-round btn-info" style="margin-left: 20px;">添加条目</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead class="text-primary">
						<th width="10%">ID</th>
						<th width="20%">标题</th>
						<th width="45%">内容摘要</th>
						<th width="15%">创建时间</th>
						<th width="10%">操作</th>
						</thead>
						<tbody>
            <?php foreach ($data as $item): ?>
							<tr>
								<td><?php echo $item['id']; ?></td>
								<td><?php echo $item['name']; ?></td>
								<td title="<?php echo $item['content']?>">
                    <?php echo mb_substr($item['content'], 0, 50, 'utf-8') . '...'; ?>
								</td>
								<td><?php echo $item['created_at']; ?></td>
								<td>
									<a href="about_edit.php?id=<?php echo $item['id']; ?>">编辑</a>
									|
									<a href="about_del.php?id=<?php echo $item['id']; ?>" onclick="return confirm('确认删除该条目？')">删除</a>
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