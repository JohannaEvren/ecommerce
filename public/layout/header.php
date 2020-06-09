<?php 
if (isset($_SESSION['first_name'])) {
    echo '<style>.logedin { display:none;} .signuplink { display:none;} </style>';
} else {
	echo '<style>.logedout{ display:none;}</style>';
}

?>


<!DOCTYPE html>
<html lang="sv"> 
<head>
  <meta charset="utf-8">
  
  <title><?php $PageTitle ?></title>
  <link rel="stylesheet" type="text/css" href="css/style_main.css"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1, user-scalable=no">
  <link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>
		<header>
			
			
			<label for="cartbutton" id="shoppingc" >
				<img src="img/shoppingbag-cutout.png" width="25px">
			</label>

			<a href="index.html"><p>INREDNING</p></a>
			
			<nav class="menu">
				<ul>
					<a class="logedin" href="register.php"><li>SIGN UP</li></a>
					<a class="logedin" href="login.php"><li>LOG IN</li></a>
					<a class="logedout" href="logout.php"><li>LOG OUT</li></a>
					<a class="logedout" href="mypages.php"><li>MY PAGES</li></a>
					<a href="admin/admin.php"><li>ADMIN</li></a>
				</ul>
			</nav>
			<div class="loginbtns">
           

		</header>
<hr>
    