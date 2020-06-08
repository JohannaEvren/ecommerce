<?php  

require('config.php');
require('dbconnect.php');




if(isset($_POST['deletebtn'])){
       deleteProduct($_POST['prodId']);
      }

      $products = fetchAllProducts();
      

      	$data = [

      	"products"  => $products,

      		
      	 ];

 		

		echo json_encode($data);
			


	
   ?>