<?php
require '../tools.func.php';
require 'auth.php';
require '../db.func.php';
$prefix = getDBPrefix();
$sql = "SELECT * FROM {$prefix}product ORDER BY created_at DESC ";
$data = query($sql);
require 'header.php';
?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-primary">
				<div class="row">
					<div class="col-10">
						<h4 class="card-title ">所有商品</h4>
						<p class="card-category"> 所有商品列表</p>
					</div>
					<div class="col-2">
						<a href="product_add.php" class="btn btn-round btn-info" style="margin-left: 20px;">添加商品</a>
					</div>
				</div>

			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-hover" style="table-layout:fixed; ">
						<thead class=" text-primary">
						<th width="5%">
							ID
						</th>
						<th>
							商品编号
						</th>
						<th>
							商品名称
						</th>
						<th>
							商品图片
						</th>
						<th>
							商品描述
						</th>
						<th>
							商品库存
						</th>
						<th>
							商品单价
						</th>
						<th>
							商品上架时间
						</th>
						<th>
							编辑
						</th>
						</thead>
						<tbody>
            <?php foreach ($data as $pro): ?>
							<tr>
								<td>
                    <?php echo $pro['id']; ?>
								</td>
								<td>
                    <?php echo $pro['code']; ?>
								</td>
								<td>
                    <?php echo $pro['name']; ?>
								</td>
								<td>
								<img width="100" src="../<? echo $pro['images']?>"/>
								</td>
								<td title="<?php echo $pro['description']?>">
                    <?php echo mb_substr($pro['description'], 0, 8, 'utf-8') . '...'; ?>
								</td>
								<td>
                    <?php echo $pro['stock']; ?>
								</td>
								<td>
                    <?php echo $pro['price']; ?>
								</td>
								<td>
                    <?php echo $pro['created_at']; ?>
								</td>
								<td>
								<a href="product_edit.php?id=<?php echo $pro['id']; ?>">编辑</a>
								|
                                <a href="product_del.php?id=<?php echo $pro['id']; ?>"  onclick="return confirm('确认删除该用户？')">删除</a>
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
