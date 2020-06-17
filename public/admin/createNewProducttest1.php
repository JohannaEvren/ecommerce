<?php
     require('../../src/dbconnect.php');
 
    $title        = "";
    $description  = "";
    $price        = 0;
    $img_url      = "";
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

        if(!is_numeric($_POST['price'])){
          $error .= "<li class='list-group-item list-group-item-danger'>Price have to be a rounded number</li>";

        }


      if(!empty($error)){
        $msg = "<ul class='list-group offset-4 col-4'>{$error}</ul>";
      }

        else{

           try{
          
              $query = "INSERT INTO products (title, description, price, img_url) VALUES (:title, :description, :price, :img_url);";
              $stmt = $dbconnect->prepare($query);
              $stmt->bindValue(':title', $title);
              $stmt->bindValue(':description', $description);
              $stmt->bindValue(':price', $price);
              $stmt->bindValue(':img_url', $img_url);
              $stmt->execute();
              $title   = "";
              $description = "";
              $price  = "";
              $img_url = "";

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

// NYTT TEST FÖR BILDER

$newPathAndName = "";
$imgUrl = "";
if(isset($_POST['addProduct'])){

  //display $_FILES content
  //echo "<pre>";
  //print_r($_FILES);
  //echo "</pre>";

  // Array
  // (
  //     [uploadedFile] => Array
 //        (
 //            [name] => dummy-profile.png
 //            [type] => image/png
 //            [tmp_name] => /Applications/AMPPS/tmp/phppF9QkG
 //            [error] => 0
 //            [size] => 15076
 //        )
  // )

  // Validation for file upload starts here
  if(is_uploaded_file($_FILES['uploadedFile']['tmp_name'])) {
    //this is the actual name of the file
    $fileName = $_FILES['uploadedFile']['name'];
    //this is the file type
    $fileType = $_FILES['uploadedFile']['type'];
    //this is the temporary name of the file
    $fileTempName = $_FILES['uploadedFile']['tmp_name'];
    //this is the path where you want to save the actual file
    $path = "../uploads/";
    //this is the actual path and actual name of the file
    $newPathAndName = $path . $fileName;

    // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
      // Check MIME Type by yourself.
      $allowedFileTypes = [
          'image/jpeg',
          'image/gif',
          'image/png',
        ];
  //       echo "<pre>";
    // var_dump( (bool) array_search($fileType, $allowedFileTypes, true));
    // echo "</pre>";

      $isFileTypeAllowed = (bool) array_search($fileType, $allowedFileTypes, true);
      if ($isFileTypeAllowed == false) {
        $error = "The file type is invalid. Allowed types are jpeg, png, gif.<br>";
      } else {
      // Will try to upload the file with the function 'move_uploaded_file'
      // Returns true/false depending if it was successful or not
        $isTheFileUploaded = move_uploaded_file($fileTempName, $newPathAndName);
        if ($isTheFileUploaded == false) {
        // Otherwise, if upload unsuccessful, show errormessage
        $error = "Could not upload the file. Please try again<br>";
      }
      }
  }



  // Handle the rest of the form validation and save accordingly in DB

  if (empty($error)) {
    $msg = "Succefully submittet the form";
    // Save the image url in DB here, along with other data
    $imgUrl = $newPathAndName;
  } else {
    $msg = $error;
  }
}

?>

<!DOCTYPE html>
    <html>
    <head>
      <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
      <title>Admin</title>
      <link rel="stylesheet" type="text/css" href="css/style.css"> 
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
    <body>
  <div class="container-fluid">
    <div class="row">
      <div class="offset-3 col-6 newProductBox">
        <?=$msg?>
        <div class="form-group">
          <form id="newProduct" method="POST" enctype="multipart/form-data">
            <p>
              <label for="title">Title</label><br>
              <input type="text" name="title" id="" value="<?=$title?>">
            </p>
            <p>
              <label for="description">Write description here</label> <br>
              <textarea rows="6" cols="50" name="description" form="newProduct"><?=$description?></textarea><br>
              <label for="price">Price</label><br>
              <input type="number" name="price" id="" value="<?=$price?>">
            </p>
            <!-- TEST FÖR BILDER-->
            <h3>File upload</h3>
            <p>
              file: <input type="file" name="image" value=""/>
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