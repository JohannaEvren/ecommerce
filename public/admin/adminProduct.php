
  <?php 

  require('../../src/config.php');
  require('../../src/dbconnect.php');
 

  if(isset($_POST['delete'])){
    try{
        $query = "DELETE FROM products WHERE id = :id;";
        $stmt  = $dbconnect->prepare($query);
        $stmt->bindValue(':id', $_POST['postid']);
        $stmt->execute();
        } catch (\PDOexception $e) {
          throw new \PDOexception($e->getMessage(), (int) $e->getCode());
      };
    };


//GET BLOGPOST

     try{
        $stmt  = $dbconnect->query("SELECT * FROM products");
        $products = $stmt->fetchALL();
      } catch (\PDOexception $e) {
          throw new \PDOexception($e->getMessage(), $e->getCode());
      };

/*
      if(isset($_POST['delete'])){
        deleteProduct($_POST['postid']);
      }*/

      $products = fetchAllProducts();
      $sucsess = '';
      
  
      if(isset($_GET['sucsessUpdate'])){
        $sucsess = "<div class='alert alert-success offset-4 col-4'>Product was uppdated sucessfully</div>";
      }

      if(isset($_GET['sucsessNew'])){
        $sucsess = "<div class='alert alert-success offset-4 col-4'>product was created sucessfully</div>";
      }

  ?>


  <!DOCTYPE html>
		<html>
		<head>
			<title>Admin</title>
       <link rel="stylesheet" type="text/css" href="css/style.css"> 
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		</head>
		<body>
		<nav>
          <ul>
            <li><a href="adminUsers.php">USER ADMINISTRATION</a></li>
            <li><a href="adminProduct.php">PRODUCT ADMINISTRATION</a></li>
            <li><a href="../index.php">BACK TO SHOP</a></li>
            <li><a href="checkout.php">CheckOut</a></li>
          </ul>
      </nav>


         <div class="container-fluid">
          
          <h3>Manage users here</h3>
          <div class="row">
          <div class="offset-2 col-8 adminField">

          <div class="row">
        <div class="offset-4 col-8"> 

          <div class="inNav">
           <a href="createNewProduct.php">Create new</a>
           <a href="See all products">Se all products</a>
          </div>
            <br><br>
           <?=$sucsess?> 
        </div> 
      </div> 
      <div class="row">

        <div class="col-12">
          <table class="table table-dark" style="width:100%">
             <tr>
                          <th>TITLE</th>
                          <th>DESCRIPTION</th>
                          <th>PRICE</th>
                        </tr>
                      <tbody id="ProdList">
                          <?php 
                
                             foreach(array_reverse($products) as $product){ ?>
                                  

                                      <tr>
                                      
                                      <td><?=$product['title']?></td>
                                      

                                      <td><?=$product['description']?></td>
                                      <td><?=$product['price']?> SEK</td>
                                     
                                    

                                      <form action="editproduct.php" method='GET'>
                                      <td><input type='submit' class='btn btn-info' name='edit' value='EDIT'></td> 
                                      <input type='hidden' name='postid' value='<?=$product['id']?>'>
                                      </form>
                                      <form method="POST">
                                      <td><input type='submit' class='btn btn-info delete-btn' id="delete-btn" name='delete' value='DELETE'></td>
                                      <input type='hidden' name='postid' value='<?=$product['id']?>'>
                                      </form>
                                    
                                      </tr> 

                             <?php }; ?>

               </tbody>


          </table>
        </div>





    
    </div>

      </div>
    </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!-- CUSTOM JavaScript -->
    <!---  <script src="../../src/main.js"></script>!--->
  <!--- <script src="../../src/test.js"></script>  !--->
    <script src="../../src/main.js"></script> 

</body>
</html>
        

