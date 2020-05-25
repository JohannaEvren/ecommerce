 <?php 

  require('../../src/dbconnect.php');
 

  if(isset($_POST['delete'])){
    try{
        $query = "DELETE FROM users WHERE id = :id;";
        $stmt  = $dbconnect->prepare($query);
        $stmt->bindValue(':id', $_POST['postid']);
        $stmt->execute();
        } catch (\PDOexception $e) {
          throw new \PDOexception($e->getMessage(), (int) $e->getCode());
      };
    };


//GET BLOGPOST


     try{
        $stmt  = $dbconnect->query("SELECT * FROM users");
        $users = $stmt->fetchALL();
      } catch (\PDOexception $e) {
          throw new \PDOexception($e->getMessage(), $e->getCode());
      };


    //SUCSESS MESSAGE FOR EDIT AND NEW POST
      if(isset($_GET['sucsessUpdate'])){
        $sucsess = "<div class='alert alert-success offset-4 col-4'>User was uppdated sucessfully</div>";
      }

      if(isset($_GET['sucsessNew'])){
        $sucsess = "<div class='alert alert-success offset-4 col-4'>User was created sucessfully</div>";
      }

/*
      echo "<pre>";
      print_r($users);
      echo"</pre>";

*/
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
          </ul>
      </nav>


         <div class="container-fluid">
          
          <h3>Manage users here</h3>
          <div class="row">
          <div class="offset-2 col-8 adminField">

          <div class="row">
        <div class="offset-4 col-8"> 
            <?=$msg ?>

            <!---
           <form action="createNewUser.php" method="GET"> 
              <input type="submit" class='btn btn-info' name="showform" value="CREATE NEW USER"/> 
           </form> !--->
          <div class="inNav">
           <a href="createNewUser.php">Create new</a>
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
                          <th>FIRST NAME</th>
                          <th>LAST NAME</th>
                          
                        </tr>

            <?php 
  
               foreach(array_reverse($users) as $user){ ?>
                    

                        <tr>
                        
                        <td><?=$user['first_name']?></td>
                        

                        <td><?=$user['last_name']?></td>
                        
                      

                        <form action="editusers.php" method='GET'>
                        <td><input type='submit' class='btn btn-info' name='edit' value='EDIT'></td> 
                        <input type='hidden' name='postid' value='<?=$user['id']?>'>
                        </form>
                        <form method="POST">
                        <td><input type='submit' class='btn btn-info' name='delete' value='DELETE'></td>
                        <input type='hidden' name='postid' value='<?=$user['id']?>'>
                        </form>
                      
                        </tr> 

               <?php }; ?>




          </table>
        </div>
      </div>
    </div>
    </div>
    </div>
</body>
</html>
        