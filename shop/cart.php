<?php
require 'header.php';
require 'auth.php';
// 1. 从数据表当中查询购物车数据
$uid = getSession('id', 'shop');
$prefix = getDBPrefix();
$sql = "SELECT id,price,products,quantity 
        FROM {$prefix}cart WHERE uid = '$uid'";
$cart_page_data = queryOne($sql);
if (!empty($cart_page_data)) {
    $cart_page_data['products'] = json_decode($cart_page_data['products'], true);
}
// 2. 遍历数据到页面
?>
<section class="cartMain navMain Width1440">
    <p style="color:#c00;"><?php if (hasInfo()) echo getInfo(); ?></p>
    <form action="checkout.php" method="post" id="checkoutForm">
        <!-- 收货信息 -->
        <div class="shipping-info">
            <h2>收货信息|Receiving Information</h2>
            
            <div class="form-group">
                <label>收货人姓名|Name of consignee：</label>
                <input type="text" name="name" required 
                       placeholder="请输入收货人姓名|name of consignee" maxlength="20">
            </div>

            <div class="form-group">
                <label>联系电话|telephone number：</label>
                <input type="tel" name="phone" required 
                       placeholder="请输入手机号|CN/UK telephone number" pattern="\d{11}">
            </div>

            <div class="form-group">
                <label>收货地址|shipping address：</label>
                <textarea name="address" required 
                          placeholder="请输入详细地址（街道、门牌号等）|Please enter full address (street, house number, etc.)" 
                          rows="3" minlength="10"></textarea>
            </div>
        </div>
    <ul class="cartList">
    <?php if (!empty($cart_page_data) && !empty($cart_page_data['products'])): ?>
        <?php foreach ($cart_page_data['products'] as $pid => $cart_product): ?>
        <li data-pid="<?php echo $pid; ?>">
            <div class="left">
                <img src="../<?php echo $cart_product['product']['images']; ?>" alt="">
                <div class="con">
                    <div class="title_t"><?php echo $cart_product['product']['name']; ?></div>
                    <div class="price">￥<?php echo $cart_product['product']['price']; ?></div>
                </div>
            </div>
            <div class="rigMain">
                <div class="right">
                    <div class="prev" onclick="updateQuantity(this, -1)">-</div>
                    <input type="text" class="inp" value="<?php echo $cart_product['quantity']; ?>" 
                           onchange="updateCart(this)" data-pid="<?php echo $pid; ?>">
                    <div class="add" onclick="updateQuantity(this, 1)">+</div>
                </div>
                <a class="del"   onclick="return confirm('确认删除？')" href="cart_del.php?product_id=<?php echo $pid; ?>&cart_id=<?php echo $cart_page_data['id']; ?>">删除|DELET</a> 
            </div>
        </li>
        <?php endforeach; ?>
    <?php else: ?>
        <li>购物车为空|Shopping cart is empty</li>
    <?php endif; ?>
    </ul>
    <div class="addList">
    <div class="left">
                <a class="btn" href="shop_list.php">返回购物|Back to Shopping</a>
                </div>
       <div class="right">
         <div class="allPrice">总价|total price：￥<span id="totalPrice" style="font-size: 24px;font-weight: bold;color: #c00;"><?php echo isset($cart_page_data['price']) ? number_format($cart_page_data['price'], 2) : '0.00' ?></span></div>
         <!-- <a class="btn"  href="checkout.php">结算</a> -->
         
         <button type="submit" class="btn">提交订单|Order</button>
            <input type="hidden" name="cart_id" value="<?php echo $cart_page_data['id'] ?? ''; ?>">
       </div>
    </div>
        </div>
    </form>
</section>
</section>

<script>
// 数量加减功能
function updateQuantity(button, change) {
    const input = button.parentElement.querySelector('.inp');
    let quantity = parseInt(input.value) + change;
    
    // 确保数量不小于1
    quantity = quantity < 1 ? 1 : quantity;
    
    input.value = quantity;
    updateCart(input); // 更新购物车
}

// 更新购物车数量
function updateCart(input) {
    const pid = input.dataset.pid;
    const quantity = input.value;
    
    // 发送AJAX请求更新购物车
    fetch('update_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `product_id=${pid}&quantity=${quantity}` 
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            // 更新总价显示
            document.getElementById('totalPrice').textContent = data.total_price;
        } else {
            alert('更新失败: ' + data.message);
            // 恢复原值
            input.value = data.original_quantity || quantity;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('网络错误，请重试');
    });
}
</script>
<script>
//添加表单验证(Add Form Validation)
document.getElementById('checkoutForm').addEventListener('submit', function(e) {
    const phone = document.querySelector('input[name="phone"]').value.trim();
    const address = document.querySelector('textarea[name="address"]').value.trim();

    // 手机号正则表达式
    const chinaLocal = /^1[3-9]\d{9}$/;       // 中国本地格式，如 13812345678
    const chinaIntl = /^\+861[3-9]\d{9}$/;    // 中国国际格式，如 +8613812345678
    const ukLocal = /^07\d{9}$/;              // 英国本地格式，如 07123456789
    const ukIntl = /^\+447\d{9}$/;            // 英国国际格式，如 +447123456789

    // 验证手机号
    if (
        !chinaLocal.test(phone) &&
        !chinaIntl.test(phone) &&
        !ukLocal.test(phone) &&
        !ukIntl.test(phone)
    ) {
        alert('请输入有效的中国或英国手机号码（支持国际格式）');
        e.preventDefault();
        return false;
    }

    // 地址验证
    if (address.length < 10) {
        alert('地址信息过短，请填写详细地址');
        e.preventDefault();
        return false;
    }
});
</script>

<?php
require 'footer.php';
?>