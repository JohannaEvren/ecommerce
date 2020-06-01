<?php
    
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

<?php foreach ($products as $key => $text) { ?>
<div class="row" name="showcard" value="<?=$text['id']?>">
  <div class="col-sm-2">
    <div class="card">
      <div class="card-body" style="width: 12rem;">
      <img class="card-img-top" src="." alt="Card image cap">
        <h5 class="card-title"><?=htmlentities($text['title'])?></h5>
        <p class="card-text"><?=htmlentities($text['description'])?></p>
        <div class="btn btn-primary"><?=htmlentities($text['price'])?></div>
       
       
       <!--
       <a href='productpage.php?id=hey' class="btn btn-primary">Read More</a>
       --->
        
        <form action='productpage.php' method="GET">
            <input type="hidden" name="id" value="<?=$text['id']?>">
            <input type="submit" value="read more">
        </form>
      </div>
    </div>
  </div>


<?php } ?>



