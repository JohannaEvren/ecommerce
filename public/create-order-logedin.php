<?php
		require('../src/config.php');
       require('../src/dbconnect.php');


/*
printVariables($_SESSION);
exit;
*/


if(isset($_POST['createOrderLoggedin'])){


	$user = fetchUsersById($_SESSION['id']);
	$userId = $user['id'];
	$adress = $user['street'];
	$zip = $user['postal_code'];
	$city = $user['city'];
	$country = $user['country'];
	$firstName = $user['first_name'];
	$lastName = $user['last_name'];
	$totalPrice = $_POST['totalPrice'];




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



            $_SESSION['orderIdConfirmation'] = $orderId;  

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

                  
        
}

printVariables($orderId);


if(isset($_POST['correctInfo'])){

          header('Location: order-confirmation.php?orderid=<?php echo $orderId; ?>');

}

if(isset($_POST['notCorrectInfo'])){
	header('Location: checkout.php');
}



 ?>


<!DOCTYPE html>
<html lang="sv"> 
<head>
  <meta charset="utf-8">
  
  <title><?php $PageTitle ?></title>

  <link rel="stylesheet" type="text/css" href="css/style_main.css"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1, user-scalable=no">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>


 <div class="container-fluid">
 	

    <div class="row">
    	<div class="offset-3 col-md-10" style="margin-top:100px; margin-bottom: 50px;">
    	<h2>Do you want to use this information for your order?</h2>
    </div>
</div>
<div class="row">
	<div class="confirmInfo" >

            <table> 
          
            <tr>
                <td class="list-group-item"><b>Firstname: </b><?=htmlentities(ucfirst($user['first_name']))?></td>
            </tr>
            <tr>
                <td class="list-group-item"><b>Lastname: </b><?=htmlentities(ucfirst($user['last_name']))?></td>
            </tr><tr>
                <td class="list-group-item"><b>Email: </b><?=htmlentities(ucfirst($user['email']))?></td>
            </tr><tr>
                <td class="list-group-item"><b>Phone: </b><?=htmlentities($user['phone'])?></td>
            </tr><tr>
                <td class="list-group-item"><b>Street: </b><?=htmlentities(ucfirst($user['street']))?></td>
            </tr><tr>
                <td class="list-group-item"><b>Postal Code: </b><?=htmlentities($user['postal_code'])?></td>
            </tr><tr>
                <td class="list-group-item"><b>City: </b><?=htmlentities(ucfirst($user['city']))?></td>
            </tr><tr>
                <td class="list-group-item"><b>Country: </b><?=htmlentities(ucfirst($user['country']))?></td>
            </tr>
        </table>

        <form action="#" method="POST" class="offset-3">
        	<input type="submit" name="correctInfo" value="YES" class="btn btn-dark">
        	<input type="submit" name="notCorrectInfo" value="NO" class="btn btn-dark">
        </form>
    </div>
</div>

