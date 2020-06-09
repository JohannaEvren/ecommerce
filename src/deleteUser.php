<?php  

require('config.php');
require('dbconnect.php');



if(isset($_POST['deletebtn'])){
       deleteUser($_POST['userId']);
      }

      $users = fetchAllUsers();
      

      	$data = [

      	"users"  => $users,

      ];

 		

		echo json_encode($data);
			


	
   ?>