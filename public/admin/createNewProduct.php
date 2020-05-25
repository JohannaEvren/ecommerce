<?php
     require('../../src/dbconnect.php');
 

      try{
            $stmt  = $dbconnect->query("SELECT * FROM products");
            $posts = $stmt->fetchALL();
         } catch (\PDOexception $e) {

           throw new \PDOexception($e->getMessage(), $e->getCode());
         };



    $title        = "";
    $description  = "";
    $price        = "";
    $error        = "";
    $msg          = "";

    if(isset($_POST['addProduct'])){
 
      $title   = $_POST['title'];
      $description = $_POST['description'];
      $price  = $_POST['price'];


      if(trim($_POST['title']) == ''){
          $error .= "<li class='list-group-item list-group-item-danger'>Title can not be empty</li>";

        }

        if(trim($_POST['description']) == ''){
          $error .= "<li class='list-group-item list-group-item-danger'>Description can not be empty</li>";

        }

        if(trim($_POST['price']) == ''){
          $error .= "<li class='list-group-item list-group-item-danger'>Price can not be empty</li>";

        }


      if(!empty($error)){
        $msg = "<ul class='list-group offset-4 col-4'>{$error}</ul>";
      }

        else{

           try{
          
              $query = "INSERT INTO products (title, description, price) VALUES (:title, :description, :price);";
              $stmt = $dbconnect->prepare($query);
              $stmt->bindValue(':title', $title);
              $stmt->bindValue(':description', $description);
              $stmt->bindValue(':price', $price);
              $stmt->execute();
              $title   = "";
              $description = "";
              $price  = "";

              unset($_GET['showform']);
              } catch (\PDOexception $e) {
                 throw new \PDOexception($e->getMessage(), (int) $e->getCode());

          };
                      header('Location: adminProduct.php?sucsessNew=yes');
        }
    };


    if(isset($_POST['closeForm'])){
          header('location: adminProduct.php');
        }


echo json_encode($posts);


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
          <form id="newProduct" method="POST">
            <p>
              <label for="title">Title</label><br>
              <input type="text" name="title" id="" value="<?=$title?>">
            </p>
            <p>
              <label for="description">Write description here</label> <br>
              <textarea rows="6" cols="50" name="description" form="newProduct"><?=$description?></textarea><br>
              <label for="price">Price</label><br>
              <input type="text" name="price" id="" value="<?=$price?>">
            </p>
            <input type="submit" class='btn btn-info' name="addProduct" value="save">
            <input type="submit" class='btn btn-info' name="closeForm" value="close">
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>