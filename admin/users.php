<?php
require '../db.func.php';
require '../tools.func.php';
require 'auth.php';
// 1. 写sql查询
$prefix = getDBPrefix();
$sql = "SELECT id, username, age, name, email, phone, created_at,jf
				FROM {$prefix}user ORDER BY created_at DESC";
// 2. 执行查询
$res = query($sql);
// 3. 遍历结果

require 'header.php';
?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-primary">
				<div class="row">
					<div class="col-10">
						<h4 class="card-title ">所有用户</h4>
						<p class="card-category"> 用户列表</p>
					</div>
					<div class="col-2">
						<a href="user_add.php" class="btn btn-round btn-info" style="margin-left: 20px;">添加用户</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<p><?php if (hasInfo()) echo getInfo(); ?></p>
				<div class="table-responsive">
					<table class="table table-hover">
						<thead class=" text-primary">
						<th>
							ID
						</th>
						<th>
							用户名
						</th>
						<th style="display:none;">
							姓名
						</th>
						<th style="display:none;">
							年龄
						</th>
						<th>
							奶油值
						</th>
						<th style="display:none;">
							邮箱
						</th>
						<th style="display:none;">
							联系电话
						</th>
						<th>
							注册时间
						</th>
						<th>
							操作
						</th>
						</thead>
						<tbody>
						<?php foreach ($res as $user): ?>
						<tr>
							<td>
								<?php echo $user['id']; ?>
							</td>
							<td>
                <?php echo $user['username']; ?>
							</td>
							<td style="display:none;">
                <?php echo $user['name']; ?>
							</td>
							<td style="display:none;">
                <?php echo $user['age']; ?>
							</td>
							<td>
                <?php echo $user['jf']; ?>
							</td>
							<td style="display:none;">
                <?php echo $user['email']; ?>
							</td>
							<td style="display:none;">
                <?php echo $user['phone']; ?>
							</td>
							<td>
                <?php echo $user['created_at']; ?>
							</td>
							<td>
								<a href="user_edit.php?id=<?php echo $user['id']; ?>">编辑</a>
								|
                                <a href="user_del.php?id=<?php echo $user['id']; ?>"  onclick="return confirm('确认删除该用户？')">删除</a>
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