<?php  


require('dbconnect.php');
 require('functions.php');

if(isset($_POST['deletebtn'])){
       deleteProduct($_POST['prodId']);
      }

      $products = fetchAllProducts();
      

      	$data = [

      	"products"  => $products,

      		
      	 ];

 		

		echo json_encode($data);
			


	
   ?>