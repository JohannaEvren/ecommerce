<?php
      require('../src/config.php');
      require('../src/dbconnect.php');

      try{
        $stmt  = $dbconnect->query("SELECT * FROM products");
            $products = $stmt->fetchALL();
         } catch (\PDOexception $e) {

           throw new \PDOexception($e->getMessage(), $e->getCode());
         };

    include "layout/header.php";
    
     



    $title    = "";
    $description  = "";
    $price   = "";

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Product</title>
    <link rel="stylesheet" type="text/css" href="css/style_product.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>

<body>  
<?php include "cart.php";?>
<div class="container-fluid">
    <div class="page-header">
        <h3>WELCOME TO INREDNING</h3>
        <p>HOME OF ALL YOUR FURNISHINGS</p>
    </div>
  <?php foreach ($products as $key => $products) { ?>


<div class="row-fluid" <?=$products['id']?>>
<div class="span12">
        
    <div class="carousel slide" id="myCarousel">
        <div class="carousel-inner">
            <div class="item active">
                    <ul class="thumbnails">
                        <li class="span3">
                            <div class="thumbnail">
                                <a href=""><img src="<?=htmlentities($products['img_url'])?>" width="200" height="200" alt=""></a>
                            </div>
                            <div class="caption">
                                <h4><?=htmlentities($products['title'])?></h4>
                        <p><?=htmlentities($products['description'])?></p>
                        <div class="pricing"><?=htmlentities($products['price'])?>kr</div>
                        <form action='productpage.php' method="GET">
                          <input type="hidden" name="id" value="<?=$products['id']?>">
                          <input type="submit" class='read-btn' value="Read more">
                        </form>
                        <form action="add-cart-item.php" method="POST">
                          <input type="hidden" name="productId" value = "<?=$products['id']?>">
                          <input type="number" name="quantity" value ="1" min= "0">
                          <input type="submit" class='add-btn' name="addToCart" value = "Add To Cart">
                        </form>
                            </div>
                        </li>
                    
                    </ul>
              </div> 
</div>         
</div>
</div>
<?php } ?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

<?php  include "layout/footer.php" ?>
