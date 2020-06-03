<?php
if(!isset($_SESSION['cartItems'])) {
	$_SESSION['cartItems'] = [];
}
/*
echo "<pre>";
print_r($_SESSION['cartItems']);
echo "</pre>";
*/

$cartItemCount = count($_SESSION['cartItems']);
$cartTotalSum = 0;
foreach ($_SESSION['cartItems'] as $cartId => $cartItem) {
	$cartTotalSum += $cartItem['price'] * $cartItem['quantity'];
}
?>
<div class="row">
	<div class="col-lg-12 col-sm-12 col-12 main-section">
		<a href="products.php" class="btn btn-info">Products</a>
		<div class="dropdown">
			<button type="button" class="btn btn-info" data-toggle="dropdown">
				<i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger"><?=$cartItemCount?></span>
			</button>
			<div class="dropdown-menu">
				<div class="row total-header-section">
					<div class="col-lg-6 col-sm-6 col-6">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
						<span class="badge badge-pill badge-danger"><?=$cartItemCount?></span>
					</div>
					<div class="col-lg-6 col-sm-6 col-6 total-section text-right">
						<p>Total: <span class="text-info"><?=$cartTotalSum?> $</span></p>
					</div>
				</div>
		    </div>
            
            <?php foreach ($_SESSION['cartItems'] as $cartId => $cartItem) { ?>
            	<div class="row cart-detail">
			    	<div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
			    		<img src="img/<?=$cartItem['img_url']?>">
			    	</div>
			    	<div class="col-lg-8 col-sm-8 cart-detail-product">
			    		<p><?=$cartItem['title']?></p>
			    		<span class="price text-info"> <?=$cartItem['price']?> $</span> <span class="count"> Quantity: <?=$cartItem['quantity']?></span>
			    	</div>
		        </div>
            <?php } ?>

		    <div class="row">
		    	<div class="col-lg-12 col-sm-12 col-12 text-center checkout">
		    		<a href="#" class="btn btn-primary btn-block">Shop</a>