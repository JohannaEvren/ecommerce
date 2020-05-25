<?php

require('../../src/dbconnect.php');



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

   if(isset($_POST['saveBlogPost'])){


            $first_name = trim($_POST['first_name']);
            $last_name = trim($_POST['last_name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $phone = trim($_POST['phone']);
            $street = trim($_POST['street']);
            $postal_code = trim($_POST['postal_code']);
            $city = trim($_POST['city']);
            $country = trim($_POST['country']);
            $id      = $_GET['postid'];


      //VALIDATION FOR BLOGFORM
/*
      if(empty($_POST['title'])){
          $error .= "<li class='list-group-item list-group-item-danger'>Title can not be empty</li>";
        }

        if(empty($description)){
          $error .= "<li class='list-group-item list-group-item-danger'>Content can not be empty</li>";
        }

        if(empty($price)){
          $error .= "<li class='list-group-item list-group-item-danger'>Author can not be empty</li>";
        }


      if(!empty($error)){
        $msg = "<ul class='list-group offset-4 col-4'>{$error}</ul>";
      }*/

      if(empty($error)){


/*
          //SAVE CHANGES IF COMMING FROM BLOGPOST, AND DIRECT BACK TO THE POST
          if(isset($_GET['id'])){

              try{
                 $query = "
                        UPDATE products 
                        SET title = :title, description = :description, price = :price 
                        WHERE id = :id;
                      ";

                      $stmt  = $dbconnect->prepare($query);
                      $stmt->bindValue(':title', $title);
                      $stmt->bindValue(':description', $description);
                      $stmt->bindValue(':price', $price);
                      $stmt->bindValue(':id', $_GET['id']);
                      $stmt->execute();
                       }catch (\PDOexception $e) {
                          throw new \PDOexception($e->getMessage(), (int) $e->getCode());
                    };

                       //header("location: readmore.php?id={$_POST['postid']}");

                       }
*/

                //SAVE CHANGES IF COMMING FROM ADMINISTRATION-PAGE, AND DIRECT BACK TO ADMIN-PAGE.
          
               if(isset($_GET['postid'])){

                  try{  
                    $query = "
                        UPDATE users
                        SET first_name = :first_name, last_name = :last_name, email = :email, password = :password, phone = :phone,
                        street = :street, postal_code = :postal_code, city = :city, country = :country
                        WHERE id = :id;
                      ";
                      $stmt  = $dbconnect->prepare($query);
                      $stmt->bindValue(':first_name', $first_name );
                      $stmt->bindValue(':last_name', $last_name);
                      $stmt->bindValue(':email', $email );
                      $stmt->bindValue(':password', $password );
                      $stmt->bindValue(':phone', $phone );
                      $stmt->bindValue(':street', $street );
                      $stmt->bindValue(':postal_code', $postal_code );
                      $stmt->bindValue(':city', $city );
                      $stmt->bindValue(':country', $country );
                      $stmt->bindValue(':id', $_GET['postid']);
                      $stmt->execute();
                       }catch (\PDOexception $e) {
                          throw new \PDOexception($e->getMessage(), (int) $e->getCode());
                    };
                    
                      header('location: adminUsers.php');

                    }
                 };
    };
  




        //SHOW BLOG POST IN EDITOR COMMING FROM ADMIN-PAGE
        if(isset($_GET['postid'])){

            try{
                    $stmt  = $dbconnect->prepare("SELECT * FROM users WHERE id = :id");
                    $stmt->bindValue(':id', $_GET['postid']);
                    $stmt->execute();
                    $user = $stmt->fetch();
                 } catch (\PDOexception $e) {
                   throw new \PDOexception($e->getMessage(), $e->getCode());
                 };

        }


        //CLOSE EDIT AND GO BACK TO THE ADMIN-PAGE / BLOGPOST
       if(isset($_POST['closeBlogForm'])){

    

            
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
                <label for="password">Password</label><br>
                <input type="password" name="password" id="" value="<?=$user['password']?>">
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
              
              <input type="submit" class='btn btn-info' name="saveBlogPost" value="save">
              <input type='hidden' name='postid' value='<?=$user['id']?>'>
              <input type="submit" class='btn btn-info' name="closeBlogForm" value="close & delete your post">
          </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>