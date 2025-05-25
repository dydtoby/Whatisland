<?php
require '../tools.func.php';
require 'auth.php';
require '../db.func.php';

// 1. 接收id
$id = intval($_GET['id']);
if (empty($id)) {
    header('location: orders.php');
    exit;
}

// 2. 根据id查询订单
$prefix = getDBPrefix();
$sql = "SELECT id, uid, price, quantity, created_at, name, phone, address, products
        FROM {$prefix}order WHERE id = '$id'";
$order = queryOne($sql);

// 3. 解析商品数据并获取最新信息（新增部分）
$products = [];
if (!empty($order['products'])) {
    // 解析原始商品数据
    $original_products = json_decode($order['products'], true);
    
    if (json_last_error() === JSON_ERROR_NONE) {
        // 获取所有商品ID
        $product_ids = array_map('intval', array_keys($original_products));
        
        // 查询最新商品信息
        $sql = "SELECT id, name FROM {$prefix}product 
                WHERE id IN (".implode(',', $product_ids).")";
        $latest_products = query($sql);
        
        // 创建商品名称映射表
        $product_map = [];
        foreach ($latest_products as $p) {
            $product_map[$p['id']] = $p['name'];
        }
        
        // 合并商品信息
        foreach ($original_products as $pid => $item) {
            $products[$pid] = [
                'quantity' => $item['quantity'],
                'product' => [
                    'id' => $pid,
                    'name' => $product_map[$pid] ?? '[已下架]'.$item['product']['name'],
                    'price' => $item['product']['price'],
                    'images' => $item['product']['images']
                ]
            ];
        }
    } else {
        setInfo('商品数据解析失败');
    }
}

// 3. 获取用户列表
$users = query("SELECT id, username FROM {$prefix}user");

// 4. 判断是否为post提交
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 接收post数据
    $uid = intval($_POST['uid']);
    $price = floatval($_POST['price']);
    $quantity = intval($_POST['quantity']);
    $name = htmlspecialchars(trim($_POST['name']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $address = htmlspecialchars(trim($_POST['address']));
    
    // 验证收货信息
    if (empty($name) || empty($phone) || empty($address)) {
        setInfo('请填写完整的收货信息');
    } elseif (!preg_match('/^1[3-9]\d{9}$/', $phone)) {
        setInfo('请输入有效的手机号码');
    } else {
        // 更新订单数据
        $sql = "UPDATE {$prefix}order 
                SET uid = '$uid', price = '$price', 
                    quantity = '$quantity', name = '$name',
                    phone = '$phone', address = '$address'
                WHERE id = '$id'";
        
        if (execute($sql)) {
            // 更新成功，刷新订单数据
            $order = queryOne("SELECT * FROM {$prefix}order WHERE id = '$id'");
            setInfo('订单更新成功');
        } else {
            setInfo('订单更新失败');
        }
    }
}

require 'header.php';
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">编辑订单</h4>
                <p class="card-category">编辑订单信息</p>
            </div>
            <div class="card-body">
                <p style="color:#c00"><?php if (hasInfo()) echo getInfo(); ?></p>
                <div class="card" style="margin-bottom: 30px;">
                    <div class="card-header card-header-info">
                        <h5 class="card-title">商品明细</h5>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($products)): ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>商品名称</th>
                                            <th>单价</th>
                                            <th>数量</th>
                                            <th>小计</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $total = 0;
                                        foreach ($products as $pid => $item): 
                                            $product = $item['product'];
                                            $subtotal = $product['price'] * $item['quantity'];
                                            $total += $subtotal;
                                        ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($product['name']); ?></td>
                                            <td>￥<?php echo number_format($product['price'], 2); ?></td>
                                            <td><?php echo $item['quantity']; ?></td>
                                            <td>￥<?php echo number_format($subtotal, 2); ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <tr class="bg-light">
                                            <td colspan="4" class="text-right"><strong>订单总价：</strong></td>
                                            <td>
                                                ￥<?php echo number_format($total, 2); ?>
                                                <?php if ($total != $order['price']): ?>
                                                    <span class="text-danger">（数据库记录：￥<?php echo number_format($order['price'], 2); ?>）</span>
                                                <?php endif; ?>
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-warning">暂无商品信息</div>
                        <?php endif; ?>
                    </div>
                </div>
                <form method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">用户</label>
                                <select name="uid" class="form-control" required disabled>
                                    <?php foreach ($users as $user): ?>
                                    <option value="<?php echo $user['id']; ?>" 
                                        <?php if ($user['id'] == $order['uid']) echo 'selected'; ?>>
                                        <?php echo $user['username']; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">订单价格</label>
                                <input type="number" name="price" value="<?php echo $order['price']; ?>" 
                                    step="0.01" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">商品数量</label>
                                <input type="number" name="quantity" value="<?php echo $order['quantity']; ?>" 
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">收货人姓名</label>
                                <input type="text" name="name" value="<?php echo htmlspecialchars($order['name']); ?>" 
                                    class="form-control" required maxlength="20">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">联系电话</label>
                                <input type="tel" name="phone" value="<?php echo htmlspecialchars($order['phone']); ?>" 
                                    class="form-control" required pattern="\d{11}" title="请输入11位手机号码">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">下单时间</label>
                                <input type="text" value="<?php echo $order['created_at']; ?>" 
                                    class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">收货地址</label>
                                <textarea name="address" class="form-control" required
                                    rows="3" minlength="10"><?php echo htmlspecialchars($order['address']); ?></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">更新订单</button>
                    <a href="orders.php" class="btn btn-default pull-right" style="margin-right: 10px;">返回</a>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
require 'footer.php';
?>