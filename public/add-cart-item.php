<?php
require('../src/config.php');
require('../src/dbconnect.php'); 

//echo "<pre>";
//print_r($_POST);
//echo "</pre>";

if(!empty($_POST['quantity'])) {
	$productId = (int) $_POST['productId'];
	$quantity = (int) $_POST['quantity'];

    $product = fetchProductsById($_POST['productId']);

    if ($product) {
    	$product = array_merge($product, ['quantity' => $quantity]);
		
		$cartItem = [$productId => $product];
		
        if (empty($_SESSION['cartItems'])) {
        	$_SESSION['cartItems'] = $cartItem;
        } else {
        	if (isset($_SESSION['cartItems'][$productId])) {
        		$_SESSION['cartItems'][$productId]['quantity'] += $quantity;
        	} else {
        		$_SESSION['cartItems'] += $cartItem;
        	}
        }
    }
}

// Sidan man kom från.
redirect($_SERVER['HTTP_REFERER']);
exit;
