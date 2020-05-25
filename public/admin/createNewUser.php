<?php
     require('../../src/dbconnect.php');
 

      try{
            $stmt  = $dbconnect->query("SELECT * FROM users");
            $users = $stmt->fetchALL();
         } catch (\PDOexception $e) {

           throw new \PDOexception($e->getMessage(), $e->getCode());
         };


            $first_name = "";
            $last_name = "";
            $email = "";
            $password = "";
            $phone = "";
            $street = "";
            $postal_code = "";
            $city = "";
            $country = "";
            $msg     = "";
            $error        = "";
            $msg          = "";

    if(isset($_POST['addUser'])){
 
      $first_name = trim($_POST['first_name']);
            $last_name = trim($_POST['last_name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $phone = trim($_POST['phone']);
            $street = trim($_POST['street']);
            $postal_code = trim($_POST['postal_code']);
            $city = trim($_POST['city']);
            $country = trim($_POST['country']);
            

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

           try{
          
              $query = "INSERT INTO users (first_name, last_name, email, password, phone, street, postal_code, city, country) VALUES (:first_name, :last_name, :email, :password, :phone, :street, :postal_code, :city, :country);";
              $stmt = $dbconnect->prepare($query);
               $stmt->bindValue(':first_name', $first_name );
                      $stmt->bindValue(':last_name', $last_name);
                      $stmt->bindValue(':email', $email );
                      $stmt->bindValue(':password', $password );
                      $stmt->bindValue(':phone', $phone );
                      $stmt->bindValue(':street', $street );
                      $stmt->bindValue(':postal_code', $postal_code );
                      $stmt->bindValue(':city', $city );
                      $stmt->bindValue(':country', $country );
                     
              $stmt->execute();
              

              unset($_GET['showform']);
              } catch (\PDOexception $e) {
                 throw new \PDOexception($e->getMessage(), (int) $e->getCode());

          };
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
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
    <body>

  <div class="container-fluid">
    <div class="row">
      <div class="offset-1 col-10">
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
                <label for="password">Password</label><br>
                <input type="password" name="password" id="" value="<?=$password?>">
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
              
              <input type="submit" class='btn btn-info' name="addUser" value="save">
              <input type="submit" class='btn btn-info' name="closeForm" value="close">




            
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>