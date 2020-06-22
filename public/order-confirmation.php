<?php
       require('../src/config.php');
       require('../src/dbconnect.php');

               $cartItemCount = count($_SESSION['cartItems']);
               $cartTotalSum = 0;
                foreach ($_SESSION['cartItems'] as $cartId => $cartItem) {
                $cartTotalSum += $cartItem['price'] * $cartItem['quantity'];
              }; 




      try {
       
        $query = "
        SELECT * FROM orders
        WHERE id = :id";

        $stmt = $dbconnect->prepare($query);
        $stmt->bindvalue(':id', $_SESSION['orderIdConfirmation']);
        $stmt->execute();
        
        $order = $stmt->fetch();
    } catch (\PDOException $e) {
      throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }

  
      $users = fetchUsersById($order['user_id']);

      

      
       
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




          <div class="offset-1 col-10 showCart">
            <div class="shoppingCart">
             <h1 id="title">Thank you for your order <?=$users['first_name']?></h1><br><br>
             <h4>Your order confirmation ID is <?=$order['id']?> </h4>
           </div>
            <div class="offset col-10"> 
            

          <?php foreach($_SESSION['cartItems'] as $cartId => $cartItem){ ?>

                    <div class="offset-1 col-12"> 
                      <div class="row">
                          <div class="col-2"><?=htmlentities($cartItem['title'])?></div> 
                          <div class="col-8"><?=htmlentities($cartItem['description'])?></div>
                          <div class="col-2"><h5><?=htmlentities($cartItem['price'])?> SEK</h5></div>
                        </tr>
                        <hr>
                     
                        </div>
                      </div>


          
          

               <?php };?>



            </div>

               <div class="offset-8 col-3">
                <h3>Total: <?=$cartTotalSum?> $ </h3>
              </div>
              <br><br><br><br><br>
           
                <h4 style="text-align: center;"> <a style="color:red;" href="products.php">BACK TO SHOP</a></h4>
                 </div>



                 <?php 

                 unset($_SESSION['cartItems']); 
                unset($_SESSION['orderIdConfirmation']);   


                 ?>










        


