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
    	//echo "<pre>";
		//print_r($_POST);
		//echo "</pre>";
		
		$cartItem = [$productId => $product];

        //echo "<pre>";
		//print_r($cartItem);
		//echo "</pre>";
		
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
//echo "<pre>";
//print_r($_SERVER);
//echo "</pre>";

//Sidan man kom ifrån
redirect($_SERVER['HTTP_REFERER']);
exit;
