<?php 

  require('../../src/config.php');
  require('../../src/dbconnect.php');

 

?>


  <!DOCTYPE html>
		<html>
		<head>

		<title>Admin</title>
       	<link rel="stylesheet" type="text/css" href="css/style.css"> 
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		</head>
		<body>

<div class="container-fluid adminPage">
	<div class="row">
		<div class="offset-1 col-5 prodBox">
			<a href="adminProduct.php">PRODUCT ADMINISTRATION</a>
			
		</div>
		<div class="col-5 userBox">
			<a href="adminUsers.php">USER ADMINISTRATION</a>
		</div>	

	</div>


</div>					

		
