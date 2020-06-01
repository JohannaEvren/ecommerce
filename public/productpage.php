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
   
 echo "<pre>";
print_r($_GET);
echo "</pre>";
?>


<div class="row" name="showcard" value="<?=$products['id']?>">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body" style="width: 16rem;">
      <img class="card-img-top" src="..." alt="Card image cap">
        <h5 class="card-title"><?=htmlentities($products['title'])?></h5>
        <p class="card-text"><?=htmlentities($products['description'])?></p>
        <span><?=htmlentities($products['price'])?></span>
        <a href="#" class="cart-btn">Add to cart</a>
      </div>
      </div>
    </div>
  </div>


