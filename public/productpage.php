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


<div class="row" name="showcard" value="<?=$products['id']?>">

  <div class="col-sm-4" style="width: 6rem; height: 6rem;">
    <div class="card">
      <div class="card-body">
      <img class="card-img-top" src="..." alt="Card image cap">
        <h5 class="card-title"><?=htmlentities($products['title'])?></h5>
        <p class="card-text"><?=htmlentities($products['description'])?></p>

        <span><?=htmlentities($products['price'])?></span>
        
        <form action="add-cart-item.php" method="POST">
<input type="hidden" name="productId" value="<?=$products['id']?>">
<input type="number" name="quantity" value ="1" min= "0">
<input type="submit" name="addToCart" value = "Add To Cart">
</form>
      </div>
      </div>
    </div>
  </div>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>



