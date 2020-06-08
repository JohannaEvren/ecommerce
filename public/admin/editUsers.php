<?php
require('../../src/config.php');
require('../../src/dbconnect.php');

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

   if(isset($_POST['saveEditUser'])){


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
            $id      = $_GET['userid'];


            $users = fetchAllUsers();
            $error = "";
                
        


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

      if(empty($error)){

            $userData = [
                'firstname'  => $first_name,
                'lastname'   => $last_name,
                'email'      => $email,
                'password'   => $password,
                'phone'      => $phone,
                'street'     => $street,
                'postalcode' => $postal_code,
                'city'       => $city,
                'country'    => $country,
                'id'         => $id,
            ];
            
            update($userData);
            header('location: adminUsers.php');
              
    };
}


        if(isset($_GET['postid'])){

          $user = fetchUsersById($_GET['postid']);

        }

       if(isset($_POST['closeEditUser'])){
            
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
        <?=$msg ?><br>
        <div class="form-group">
          <form id="blogpost" method="POST">
              <p>
                <label for="first_name">Fist Name</label><br>
                <input type="text" name="first_name" id="" value="<?=$user['first_name']?>">
              </p>
              <p>
                <label for="last_name">Last Name</label><br>
                <input type="text" name="last_name" id="" value="<?=$user['last_name']?>">
              </p>
              <p>
                <label for="email">Email</label><br>
                <input type="email" name="email" id="" value="<?=$user['email']?>">
              </p>
              <p>
                <label for="phone">phone</label><br>
                <input type="text" name="phone" id="" value="<?=$user['phone']?>">
              </p>
              <p>
                <label for="street">Street</label><br>
                <input type="text" name="street" id="" value="<?=$user['street']?>">
              </p>
                <p>
                <label for="postal_code">Postal code</label><br>
                <input type="text" name="postal_code" id="" value="<?=$user['postal_code']?>">
              </p>
                  <p>
                <label for="city">city</label><br>
                <input type="text" name="city" id="" value="<?=$user['city']?>">
              </p>
                  <p>
                <label for="country">Country</label><br>
                <input type="text" name="country" id="" value="<?=$user['country']?>">
              </p>
               <p>
                <label for="password">Password</label><br>
                <input type="password" name="password" id="" value="">
              </p>
              <p>
                <label for="password">Confirm Password</label><br>
                <input type="password" name="confirmPassword" id="" value="">
              </p>
              
              <input type="submit" class='btn btn-info' name="saveEditUser" value="save">
              <input type='hidden' name='postid' value='<?=$user['id']?>'>
              <input type="submit" class='btn btn-info' name="closeEditUser" value="close & delete your changes">
          </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>