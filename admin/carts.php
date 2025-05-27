<?php
require '../tools.func.php';
require '../db.func.php';
require 'auth.php';
$prefix = getDBPrefix();
$sql = "SELECT id, price, quantity, uid, created_at FROM {$prefix}cart ORDER BY created_at DESC";
$back_cart_data = [];
$cart = query($sql);
foreach ($cart as $c) {
  $sql = "SELECT username FROM {$prefix}user WHERE id = '{$c['uid']}'";
  $user = queryOne($sql);
  $c['username'] = !empty($user['username'])?$user['username']:'';
  $back_cart_data[] = $c;
}
require 'header.php';
?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-primary">
				<div class="row">
					<div class="col-12">
						<h4 class="card-title ">所有购物车</h4>
						<p class="card-category"> 所有购物车列表</p>
					</div>
				</div>

			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead class=" text-primary">
						<th>
							ID
						</th>
						<th>
							购物车用户
						</th>
						<th>
							商品总量
						</th>
						<th>
							购物车总价
						</th>
						<th>
							添加时间
						</th>
						<th>
							编辑
						</th>
						</thead>
						<tbody>
						<?php foreach ($back_cart_data as $cart): ?>
						<tr>
							<td>
								<?php echo $cart['id']; ?>
							</td>
							<td>
                <?php echo $cart['username']; ?>
							</td>
							<td>
                <?php echo $cart['quantity']; ?>
							</td>
							<td>
                <?php echo $cart['price']; ?>
							</td>
							<td>
                <?php echo $cart['created_at']; ?>
							</td>
							<td>
							<a href="cart_del.php?cart_id=<?php echo $cart['id']?>"  onclick="return confirm('确认删除该购物车？')">删除</a>
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
