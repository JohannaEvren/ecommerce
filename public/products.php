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
<?php include "cart.php";?>
<div class="container">
  <?php foreach ($products as $key => $products) { ?>
  <div class="row" name="showcard" value="<?=$products['id']?>">
  <div class="col-md-4" style="padding:15px;">
  <div style="display:inline-block; border:solid 1px #808080; padding:15px">
      <div class="card">
        <div class="card-body">
        <img class="card-img-top" src="." alt="Card image cap">
          <h5 class="card-title"><?=htmlentities($products['title'])?></h5>
          <p class="card-text"><?=htmlentities($products['description'])?></p>
          <div class="price-info"><?=htmlentities($products['price'])?></div>
        
          <form action='productpage.php' method="GET">
              <input type="hidden" name="id" value="<?=$products['id']?>">
              <input type="submit" value="read more">
          </form>

  <form action="add-cart-item.php" method="POST">
  <input type="hidden" name="productId" value = "<?=$products['id']?>">
  <input type="number" name="quantity" value ="1" min= "0">
  <input type="submit" name="addToCart" value = "Add To Cart">

  </form>
</div>
        </div>
      </div>
    </div>
  </div>




  <?php } ?>
</div>

