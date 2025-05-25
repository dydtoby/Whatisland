<?php
require 'header.php';
?>
<div class="cart-main-area bg__white" style="width: 100%;">
	<div class="container" style="width: 100%;">
		<div class="row" style="margin: 0 auto;">
			<div class="orderMain">
				<div class="col-md-12 col-sm-12 col-xs-12 col">
					<h1 style="color: green;"><?php if (hasInfo()) echo getInfo(); ?></h1>
					<a href="shop_list.php" style="color:#c00;">返回购物</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="only-banner ptb--10 bg__white">
</div>
<?php
require 'footer.php';
?>
