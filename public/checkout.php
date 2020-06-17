<?php
       require('../src/config.php');
       require('../src/dbconnect.php');

         //$products = fetchAllProducts();

               $cartItemCount = count($_SESSION['cartItems']);
               $cartTotalSum = 0;
                foreach ($_SESSION['cartItems'] as $cartId => $cartItem) {
                $cartTotalSum += $cartItem['price'] * $cartItem['quantity'];
              }; 


              $msg = '';
              $error = '';
              $userId = '';
              $totalPrice = '';
              $firstName = '';
              $lastName = '';
              $email = '';
              $phone = '';
              $adress = '';
              $password = '';
              $confirmPassword = '';
              $city = '';
              $country = '';
              $zip = '';
                    
             


              if(isset($_POST['createOrderBtn'])){

                    $totalPrice = trim($_POST['totalPrice']);
                    $firstName = trim($_POST['firstName']);
                    $lastName = trim($_POST['lastName']);
                    $email = trim($_POST['email']);
                    $phone = trim($_POST['phone']);
                    $adress = trim($_POST['adress']);
                    $password = trim($_POST['password']);
                    $confirmPassword = trim($_POST['password2']);
                    $city = trim($_POST['city']);
                    $country = trim($_POST['country']);
                    $zip = trim($_POST['postal_code']);
                    
             
              
                  $user = fetchUsersByEmail($email);
                  $users = fetchAllUsers(); 
                 
                 


      if(!empty($user)){  

        if($password === $user['password']){

          $userId = $user['id'];

        } else{
              $error .= "<li class='list-group-item list-group-item-danger'>User already exists but with another password.</li>";

        }

      } else{


        foreach ($users as $user) {

              if($_POST['email'] == $user['email']){
                $error .= "<li class='list-group-item list-group-item-danger'>Email already exists</li>";
              }
          }

               if($password != $confirmPassword){
                $error .= "<li class='list-group-item list-group-item-danger'>the confirmed password does not match</li>";

               } 

              if(trim($firstName) == ''){
                  $error .= "<li class='list-group-item list-group-item-danger'>First name can not be empty</li>";

                }

                if(trim($lastName) == ''){
                  $error .= "<li class='list-group-item list-group-item-danger'>Last name can not be empty</li>";

                }

                if(trim($email) == ''){
                  $error .= "<li class='list-group-item list-group-item-danger'>Email can not be empty</li>";

                }
                 if(trim($password) == ''){
                  $error .= "<li class='list-group-item list-group-item-danger'>Password can not be empty</li>";

                }
                  if(trim($phone) == ''){
                  $error .= "<li class='list-group-item list-group-item-danger'>phone can not be empty</li>";

                }
                if(trim($adress) == ''){
                  $error .= "<li class='list-group-item list-group-item-danger'>Street can not be empty</li>";

                }
                if(trim($zip) == ''){
                  $error .= "<li class='list-group-item list-group-item-danger'>Postal code can not be empty</li>";

                }
                 if(trim($city) == ''){
                  $error .= "<li class='list-group-item list-group-item-danger'>City code can not be empty</li>";

                }
                 if(trim($country) == ''){
                  $error .= "<li class='list-group-item list-group-item-danger'>Country code can not be empty</li>";

                }

              }


            if(!empty($error)){
                $msg = "<ul class='list-group col-6'>{$error}</ul>";

                
              } else{


         
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

                  
          $_SESSION['orderIdConfirmation'] = $orderId;             
          header('Location: order-confirmation.php?orderid=<?php echo $orderId; ?>');
          exit;  
      }
}
    
?>

        
      <?php 
      include('layout/header.php');
      



      

      ?>

  
   

  <div class="container-fluid">

    <div class="row">




          <div class="offset-1 col-10 showCart">
            <div class="shoppingCart">
             <h1 id="title">SHOPPINGCART</h1>
           </div>
            
          <?php foreach($_SESSION['cartItems'] as $cartId => $cartItem){ ?>
            <div class="offset-1 col-10">                    
            <div class="row cart-test">                    
              <div class="col-3"><img src="<?=$cartItem['img_url']?>" width="200px"></div>
            <div class="col-6" style="padding:40px;">
              <h4><?=$cartItem['title']?> </h4>
              <br>
              <?=$cartItem['description']?>
              <br> 
              <form class="update-cart-form" action="update-cart-item.php" id="updateCart" method="POST">
                 <input type="hidden" name="cartId" value="<?=$cartId?>">
                 <input type="number" name="quantity" value="<?=$cartItem['quantity']?>" min="0">                     
              </form>
              <br>
              <h5><?=$cartItem['price']?> SEK</h5>
    
            </div>
             <div class="offset-10 col-1 deleteClassSymbol"> 
              <form action="delete-cart-item.php" id="deletsymbol" method="POST"> 
                  <input type="hidden" name="cartId" value="<?=$cartId?>">
                  <button type="submit" class="btn">
                    <svg class="bi bi-trash" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="    currentColor"       xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                    </svg>
                </button>
              </form>
              </div>
              
        
            </div>

            </div>

               <?php };?>

               <div class="offset-1 col-10 totalSum">
                <h3>Total: <?=$cartTotalSum?> $ </h3>
              </div>
           

                 </div>









        <div class="offset-1 col-10">
           <h4 style="text-align: center;"> <a style="color:red;" href="products.php">CONTINUE SHOPPING?</a></h4>

          <h1 id="checkout">CHECK OUT</h1>

       
           <?=$msg?>
           <br><br>

            <form action="" method="POST" style="text-align: left">
 
              <input type="hidden" name="totalPrice" value="<?=$cartTotalSum?>">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputFname">First Name</label>
                  <input type="text" class="form-control" name="firstName" id="inputFname" value="<?=$firstName?>">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputLname">Last Name</label>
                  <input type="text" class="form-control" name="lastName" id="inputLname" value="<?=$lastName?>">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail">Email</label>
                  <input type="text" class="form-control" name="email" id="inputEmail" value="<?=$email?>">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPhone">Phone</label>
                  <input type="text" class="form-control" name="phone" id="inputPhone" value="<?=$phone?>" >
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="password" class="form-control" id="inputPassword" name="password" value="<?=$password?>">
              </div>
               <div class="form-group">
                <label for="inputPassword2">Confirm Password</label>
                <input type="password" class="form-control" id="inputPassword2" name="password2" value="<?=$confirmPassword?>">
              </div>
              <div class="row">
                <div class="form-group col-md-3">
                  <label for="inputCity">City</label>
                  <input type="text" name="city" class="form-control" id="inputCity" value="<?=$city?>">
                </div>
                <div class="form-group col-md-3">
                  <label for="inputState">country</label>
                  <select id="inputState" name="country" class="form-control" value="<?=$country?>">  
                    <option>SWEDEN</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                <label for="inputAddress">Address</label>
                <input type="text" class="form-control" id="inputAddress" name="adress" value="<?=$adress?>">
                </div>
                <div class="form-group col-md-2">
                  <label for="inputZip">Zip</label>
                  <input type="text" name="postal_code" class="form-control" id="inputZip" value="<?=$zip?>">
                </div>
              </div>
              </div>
              <div class="form-group offset-1 col-md-5">
                 <button type="submit" name="createOrderBtn" class="btn btn-dark">CONFIRM ORDER</button>
            </form>
                
              </div>
             
        </div>
        <?php include "layout/footer.php";?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        <script type="text/javascript">

        $('.update-cart-form input[name="quantity"]').on('change', function(){
        

          
               $(this).parent().submit();

          });

   

</script>

