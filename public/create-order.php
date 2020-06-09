<?php 

	   require('../src/config.php');
       require('../src/dbconnect.php');

	printVariables($_POST);
	


	if(isset($_POST['createOrderBtn'])){

			$totalPrice = trim($_POST['totalPrice']);
		    $firstName = trim($_POST['firstName']);
		    $lastName = trim($_POST['lastName']);
		    $email = trim($_POST['email']);
		    $phone = trim($_POST['phone']);
		    $adress = trim($_POST['adress']);
		    $password = trim($_POST['password']);
		    $city = trim($_POST['city']);
		    $country = trim($_POST['country']);
		    $zip = trim($_POST['postal_code']);
		    

 
	
			$users = fetchUsersByEmail($email);



			if(!empty($users)){  

			$userId = $users['id'];

			}else{

				 try {
		                $query = "
		                    INSERT INTO users (first_name, last_name, email, password, phone, street, postal_code, city, country)
		                    VALUES (:firstname, :lastname, :email, :password, :phone, :street, :postal_code, :city, :country);
		                ";

		                
		                $stmt = $dbconnect->prepare($query);
		                $stmt->bindValue(':firstname', $firstName);
		                $stmt->bindValue(':lastname', $lastName);
		                $stmt->bindValue(':email', $email);
		                $stmt->bindValue(':password', $password);
		                $stmt->bindValue(':phone', $phone);
		                $stmt->bindValue(':street', $adress);
		                $stmt->bindValue(':postal_code', $zip);
		                $stmt->bindValue(':city', $city);
		                $stmt->bindValue(':country', $country);
		                $stmt->execute(); // returns true/false
		                $userId = $dbconnect ->lastInsertId();
		                } catch(\PDOException $e) {
		                    throw new \PDOException($e->getMessage(), (int) $e->getCode());
		                }
		                
		            }


		          

		          



		      try {
		                $query = "
		                    INSERT INTO orders (user_id, total_price, billing_full_name, billing_street, billing_postal_code, billing_city, billing_country)
		                    VALUES (:user_id, :total_price, :billing_full_name, :billing_street, :billing_postal_code, :billing_city, :billing_country);
		                ";

		                
		                $stmt = $dbconnect->prepare($query);
		                $stmt->bindValue(':user_id', $userId);
		                $stmt->bindValue(':total_price', $totalPrice);
		                $stmt->bindValue(':billing_full_name', "{$firstName} {$lastName}");
		                $stmt->bindValue(':billing_street', $adress);
		                $stmt->bindValue(':billing_postal_code', $zip);
		                $stmt->bindValue(':billing_city', $city);
		                $stmt->bindValue(':billing_country', $country);
		                $stmt->execute(); 
		                $orderId = $dbconnect ->lastInsertId();
		               
		                } catch(\PDOException $e) {
		                    throw new \PDOException($e->getMessage(), (int) $e->getCode());
		                }   

						

		             foreach ($_SESSION['cartItems'] as $cartId => $cartItem) {




		             	  try {
				                $query = "
				                    INSERT INTO order_items (order_id, product_id, quantity, unit_price, product_title)
				                    VALUES (:order_id, :product_id, :quantity, :unit_price, :product_title);
				                ";

		                
		                $stmt = $dbconnect->prepare($query);
		                $stmt->bindValue(':order_id', $orderId);
		                $stmt->bindValue(':product_id', $cartItem['id']);
		                $stmt->bindValue(':quantity', $cartItem['quantity']);
		                $stmt->bindValue(':unit_price', $cartItem['price']);
		                $stmt->bindValue(':product_title', $cartItem['title']);
		                $stmt->execute(); 
		                 
		                } catch(\PDOException $e) {
		                    throw new \PDOException($e->getMessage(), (int) $e->getCode());
		                }   

		                  
		                   
		                   }      
		      header('Location: order-confirmation.php');
		      exit;  
	
}

header('Location: checkout.php');
exit;

?>