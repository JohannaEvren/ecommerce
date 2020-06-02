<?php
      require('../src/config.php');
      require('../src/dbconnect.php');

      try{
            $stmt  = $dbconnect->query("SELECT * FROM products");
            $products = $stmt->fetchALL();
         } catch (\PDOexception $e) {

           throw new \PDOexception($e->getMessage(), $e->getCode());
         };


         /*
         try {
            $query = "SELECT * FROM users";
            $stmt = $dbconnect->query($query);
              $users = $stmt->fetchAll();
            } catch (\PDOException $e) {
              throw new \PDOException($e->getMessage(), (int) $e->getCode());
            }
        */
     include "layout/header.php";


    $title    = "";
    $description  = "";
    $price   = "";


?>



      <a href="admin/adminProduct.php">ADMIN PRODUCTS</a>
      <a href="admin/adminUsers.php">ADMIN USERS</a>
      <a href="mypages.php">MY PAGES</a>


<?php foreach ($products as $key => $text) { ?>
<div class="row" value="<?=$text['id']?>">
  <div class="col-6">
    <div class="card">
      <div class="card-body">
      <img class="card-img-top" src="." alt="Card image cap">
        <h5 class="card-title"><?=htmlentities($text['title'])?></h5>
        <p class="card-text"><?=htmlentities($text['description'])?></p>
        <a href="#" class="btn btn-primary"><?=htmlentities($text['price'])?></a>
      </div>
    </div>
  </div>


<?php } ?>



