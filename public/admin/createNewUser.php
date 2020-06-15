<?php
     require('../../src/config.php');
     require('../../src/dbconnect.php');

 

      $users = fetchAllUsers();


            $first_name = "";
            $last_name = "";
            $email = "";
            $phone = "";
            $street = "";
            $postal_code = "";
            $city = "";
            $country = "";
            $password = "";
            $confirmPassword = "";
            $msg     = "";
            $error        = "";
            $msg          = "";

    if(isset($_POST['addUser'])){
 
      $first_name = trim($_POST['first_name']);
            $last_name = trim($_POST['last_name']);
            $email = trim($_POST['email']);
            $phone = trim($_POST['phone']);
            $street = trim($_POST['street']);
            $postal_code = trim($_POST['postal_code']);
            $city = trim($_POST['city']);
            $country = trim($_POST['country']);
            $password = trim($_POST['password']);
            $confirmPassword = trim($_POST['confirmPassword']);
            


  foreach ($users as $user) {

      if($_POST['email'] == $user['email']){
        $error .= "<li class='list-group-item list-group-item-danger'>Email already exists</li>";
      }
  }


       if($password != $confirmPassword){
        $error .= "<li class='list-group-item list-group-item-danger'>the confirmed password does not match</li>";

       } 

      if(trim($_POST['first_name']) == ''){
          $error .= "<li class='list-group-item list-group-item-danger'>First name can not be empty</li>";

        }

        if(trim($_POST['last_name']) == ''){
          $error .= "<li class='list-group-item list-group-item-danger'>Last name can not be empty</li>";

        }

        if(trim($_POST['email']) == ''){
          $error .= "<li class='list-group-item list-group-item-danger'>Email can not be empty</li>";

        }
         if(trim($_POST['password']) == ''){
          $error .= "<li class='list-group-item list-group-item-danger'>Password can not be empty</li>";

        }
          if(trim($_POST['phone']) == ''){
          $error .= "<li class='list-group-item list-group-item-danger'>phone can not be empty</li>";

        }
        if(trim($_POST['street']) == ''){
          $error .= "<li class='list-group-item list-group-item-danger'>Street can not be empty</li>";

        }
        if(trim($_POST['postal_code']) == ''){
          $error .= "<li class='list-group-item list-group-item-danger'>Postal code can not be empty</li>";

        }
         if(trim($_POST['city']) == ''){
          $error .= "<li class='list-group-item list-group-item-danger'>City code can not be empty</li>";

        }
         if(trim($_POST['country']) == ''){
          $error .= "<li class='list-group-item list-group-item-danger'>Country code can not be empty</li>";

        }


      if(!empty($error)){
        $msg = "<ul class='list-group offset-4 col-4'>{$error}</ul>";
      }

        else{

           $userData = [
                'firstname' => $first_name,
                'lastname' => $last_name,
                'email' => $email,
                'password' => $password,
                'phone' => $phone,
                'street' => $street,
                'postalcode' => $postal_code,
                'city' => $city,
                'country' => $country,
                ];


              registerUser($userData);
               //MÅSTE BYTA NAMN PÅ FUNKTIONENE!!!!!!
  
               header('Location: adminUsers.php?sucsessNew=yes');
        }
    };


    if(isset($_POST['closeForm'])){
          header('location: adminUsers.php');
        }

?>

<!DOCTYPE html>
    <html>
    <head>
      <title>Admin</title>
       <link rel="stylesheet" type="text/css" href="css/style.css"> 
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
    <body>

  <div class="container-fluid">
    <div class="row">
      <div class="offset-3 col-6 newUserBox">
        <?=$msg?>
        <div class="form-group">
          <form id="" method="POST">
              <p>
                <label for="first_name">Fist Name</label><br>
                <input type="text" name="first_name" id="" value="<?=$first_name?>">
              </p>
              <p>
                <label for="last_name">Last Name</label><br>
                <input type="text" name="last_name" id="" value="<?=$last_name?>">
              </p>
              <p>
                <label for="email">Email</label><br>
                <input type="email" name="email" id="" value="<?=$email?>">
              </p>
              <p>
                <label for="phone">phone</label><br>
                <input type="text" name="phone" id="" value="<?=$phone?>">
              </p>
              <p>
                <label for="street">Street</label><br>
                <input type="text" name="street" id="" value="<?=$street?>">
              </p>
                <p>
                <label for="postal_code">Postal code</label><br>
                <input type="text" name="postal_code" id="" value="<?=$postal_code?>">
              </p>
                  <p>
                <label for="city">city</label><br>
                <input type="text" name="city" id="" value="<?=$city?>">
              </p>
                  <p>
                <label for="country">Country</label><br>
                <input type="text" name="country" id="" value="<?=$country?>">
              </p>
              <p>
                <label for="password">Password</label><br>
                <input type="password" name="password" id="" value="<?=$password?>">
              </p>
              <p>
                <label for="password">Confirm Password</label><br>
                <input type="password" name="confirmPassword" id="" value="<?=$confirmPassword?>">
              </p>
              
              <input type="submit" class='btn btn-dark' name="addUser" value="save">
              <input type="submit" class='btn btn-dark' name="closeForm" value="close">




            
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>