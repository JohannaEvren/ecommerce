<?php
    
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
        
        <form action="layout/add-cart-item.php" method="POST">
<input type="hidden" name="productId" value = "<?=$text['id']?>">
<input type="number" name="quantity" value ="1" min= "0">
<input type="submit" name="addToCart" value = "Add To Cart">

</form>
      </div>
      </div>
    </div>
  </div>


