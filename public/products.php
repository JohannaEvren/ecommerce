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
  <?php foreach ($products as $key => $text) { ?>
  <div class="row" name="showcard" value="<?=$text['id']?>">
    <div class="col-sm-4 border p-4 d-flex flex-column" >
      <div class="card">
        <div class="card-body" style="margin-top:auto">
        <img class="card-img-top" src="." alt="Card image cap">
          <h5 class="card-title"><?=htmlentities($text['title'])?></h5>
          <p class="card-text"><?=htmlentities($text['description'])?></p>
          <div class="btn btn-primary"><?=htmlentities($text['price'])?></div>
        
          <form action='productpage.php' method="GET">
              <input type="hidden" name="id" value="<?=$text['id']?>">
              <input type="submit" value="read more">
          </form>

  <form action="add-cart-item.php" method="POST">
  <input type="hidden" name="productId" value = "<?=$text['id']?>">
  <input type="number" name="quantity" value ="1" min= "0">
  <input type="submit" name="addToCart" value = "Add To Cart">

  </form>

        </div>
      </div>
    </div>
  </div>


  <?php } ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</div>