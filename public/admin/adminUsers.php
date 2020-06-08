 <?php 

  require('../../src/config.php');
  require('../../src/dbconnect.php');
  
 
  $msg ="";
  $sucsess = "";


  /*
  if(isset($_POST['delete'])){
    deleteUser($_POST['postid']);
    };
*/

    $users = fetchAllUsers();
    $sucsess = '';
  

    //SUCSESS MESSAGE FOR EDIT AND NEW POST
      if(isset($_GET['sucsessUpdate'])){
        $sucsess = "<div class='alert alert-success col-4'>User was uppdated sucessfully</div>";
      }

      if(isset($_GET['sucsessNew'])){
        $sucsess = "<div class='alert alert-success sucsessMessage col-4'>User was created sucessfully</div>";
      }
      include"layout/adminheader.php";
  ?>

 

         <div class="container-fluid">

        
          <div class="row">
          <div class="offset-2 col-8 adminField">

                <div class="row">
             
                <div class="inNav">
                 <h3>Manage users here</h3>
                <a href="createNewUser.php" style="color:white;"><button class="btn btn-info">Create new</button></a>
                </div>
                  <br><br>
                  
                 <?=$sucsess?> 
                 
                 </div> 
            <div class="row">
              <div class=" col-12">
                <table class="table table-dark" style="width:100%">
                   <tr>
                      <th>FIRST NAME</th>
                      <th>LAST NAME</th>
                      <th>MEMBER SINCE</th>
                      <th>MEMBER ID</th>
                    </tr>
              <tbody id="userList">

                  <?php 
        
                     foreach(array_reverse($users) as $user){ 

                        $registerDate = substr($user['register_date'], 0, 11)
                      ?>
                          
                              <tr>   
                              <td><?=$user['first_name']?></td>
                              <td><?=$user['last_name']?></td>
                              <td><?=$registerDate?></td>
                              <td><?=$user['id']?></td>

                              <form action="editusers.php" method='GET'>
                              <td><input type='submit' class='btn btn-info' name='edit' value='EDIT'></td> 
                              <input type='hidden' name='postid' value='<?=$user['id']?>'>
                              </form>
                              <form method="POST">
                              <td><input type='submit' class='btn btn-info delete-user-btn' name='delete' value='DELETE'></td>
                              <input type='hidden' name='postid' value='<?=$user['id']?>'>
                              </form>
                            
                              </tr> 

                     <?php }; ?>
                </tbody>
                </table>
        </div>
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
        
