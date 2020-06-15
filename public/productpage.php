<?php

      require('../src/config.php');  
      require('../src/dbconnect.php');
      
      
      if(isset($_GET['id'])){
        try{
          $stmt  = $dbconnect->prepare("SELECT * FROM products WHERE id = :id");
            $stmt->bindValue(':id', $_GET['id']);
            $stmt->execute();
            $products = $stmt->fetch();
         } catch (\PDOexception $e) {
          throw new \PDOexception($e->getMessage(), (int) $e->getCode());
         };
  }



     include "layout/header.php";

     include "cart.php";

    

    $title            = "";
    $description     = "";
    $price           = "";


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Product</title>
    <link rel="stylesheet" type="text/css" href="css/style_productpage.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>

<body>

<div class="container-fluid">
   
   <!-- My new section -->
   <div class="section-30">
      <div class="container">
         <div class="row" value="<?=$products['id']?>">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <!-- Thumbnail -->
               <div class="row thumbnail">
                  
                  <!-- Image -->
                  <div class="col-lg-8 col-lg-push-4 col-md-8 col-md-push-4 remove-paddings-and-margins">
                  <a href="#"><img class="card-img-top" src="img/lampa.png" width="auto" height="auto" alt=""></a>
                  </div>
                  
                  <!-- Copy -->
                  <div class="col-lg-4 col-lg-pull-8 col-md-4 col-md-pull-8 remove-paddings-and-margins">
                     
                     <div class="top product-title">
                     <?=htmlentities($products['title'])?>
                     </div>
                     
                     <div class="middle">
                        <ul class="product-description">
                        <?=htmlentities($products['description'])?>
                           <li class="quality-product">
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                           </li>
                        </ul>
                     </div>
                        <div class="bottom shop-buttons">
                          <p class="pricing"><?=htmlentities($products['price'])?>kr</p>
                        <form action="add-cart-item.php" method="POST">
                          <input type="hidden" name="productId" value = "<?=$products['id']?>">
                          <input type="number" name="quantity" value ="1" min= "0">
                          <input type="submit" class='add-btn' name="addToCart" value = "Add To Cart">
                        </form>
                     </div>
                     
                  </div>

                  
               </div>
            </div>
         </div>
      </div>
   </div>
   
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

<?php  include "layout/footer.php" ?>


