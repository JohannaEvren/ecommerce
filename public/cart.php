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
		<div class="dropdown">
			<button type="button" class="btn btn-dark" data-toggle="dropdown">
				<i class="fa fa-shopping-cart" aria-hidden="true"></i><img src="img/cart.png" style="height: 25px"><span class="badge badge-pill badge-danger"><?=$cartItemCount?></span>
			</button>
			<div class="dropdown-menu">
				<div class="row total-header-section">
					<div class="col-lg-6 col-sm-6 col-6">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
						<span class="badge badge-pill badge-danger"><?=$cartItemCount?></span>
					</div>
					<div class="col-lg-6 col-sm-6 col-6 total-section text-right">
						<p>Total: <span class="text-info"><?=$cartTotalSum?>$</span></p>
					</div>
				</div>
            
                <?php foreach ($_SESSION['cartItems'] as $cartId => $cartItem) { ?>
	            	<div class="row cart-detail">
				    	<div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
				    		<img class="cartimg" src="img/example.jpg">
				    	</div>
				    	<div class="col-lg-8 col-sm-8 cart-detail-product">
				    		<span><b><?=$cartItem['title']?></b></span><span class="price text-info"> <?=$cartItem['price']?> $</span> 
				    		<p>Quantity: <b><?=$cartItem['quantity']?></b></p>
				    	</div>
			        </div>
                <?php } ?>
			    <div class="row">
			    	<div class="col-lg-12 col-sm-12 col-12 text-center checkout">
			    		<a href="checkout.php" class="btn btn-dark btn-block">Shop</a>
			    	</div>
			    </div>
    	    </div>
        </div>
    </div>
</div>
