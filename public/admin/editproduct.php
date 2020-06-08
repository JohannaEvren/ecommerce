<?php

require('../../src/dbconnect.php');
 
     $title   = "";
     $description = "";
     $price  = "";
     $error   = "";
     $msg     = "";

   if(isset($_POST['saveBlogPost'])){

      $title   = trim($_POST['title']);
      $description = trim($_POST['description']);
      $price  = trim($_POST['price']);
      $id      = $_GET['postid'];


      //VALIDATION FOR BLOGFORM

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
      }

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
                        UPDATE products
                        SET title = :title, description = :description, price = :price 
                        WHERE id = :id;
                      ";
                      $stmt  = $dbconnect->prepare($query);
                      $stmt->bindValue(':title', $title);
                      $stmt->bindValue(':description', $description);
                      $stmt->bindValue(':price', $price);
                      $stmt->bindValue(':id', $_GET['postid']);
                      $stmt->execute();
                       }catch (\PDOexception $e) {
                          throw new \PDOexception($e->getMessage(), (int) $e->getCode());
                    };
                    
                      header('location: adminProduct.php');

                    }
                 };
    };
  




        //SHOW BLOG POST IN EDITOR COMMING FROM ADMIN-PAGE
        if(isset($_GET['postid'])){

            try{
                    $stmt  = $dbconnect->prepare("SELECT * FROM products WHERE id = :id");
                    $stmt->bindValue(':id', $_GET['postid']);
                    $stmt->execute();
                    $product = $stmt->fetch();
                 } catch (\PDOexception $e) {
                   throw new \PDOexception($e->getMessage(), $e->getCode());
                 };

        }


        //CLOSE EDIT AND GO BACK TO THE ADMIN-PAGE / BLOGPOST
       if(isset($_POST['closeEditProducts'])){

    

            
              header('location: adminProduct.php');
                
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
      <div class="offset-3 col-6 newProductBox">
        <?=$msg ?><br>
        <div class="form-group">
          <form id="blogpost" method="POST">
              <p>
                <label for="title">Title</label><br>
                <input type="text" name="title" id="inputTitle" value="<?=$product['title']?>">
              </p>
              <p>
                <label for="description">Write description here</label> <br>
                <textarea rows="6" cols="50" name="description" form="blogpost"><?=$product['description']?></textarea><br>
                <label for="price">Price</label><br>
                <input type="text" name="price" id="inputAuthor" value="<?=$product['price']?>">
              </p>
              <input type="submit" class='btn btn-info' name="saveBlogPost" value="save">
              <input type='hidden' name='postid' value='<?=$product['id']?>'>
              <input type="submit" class='btn btn-info' name="closeEditProducts" value="close & delete your changes">
          </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>