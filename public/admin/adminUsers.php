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
                <a href="createNewUser.php" style="color:white;"><button class="btn btn-dark">Create new</button></a>
                </div>
                  <br><br>
                  
                 <?=$sucsess?> 
                 
                 </div> 
            <div class="row">
              <div class=" col-12">
                <table class="table table-bordered">
                 
                 <thead class="thead-dark">
                   <tr>
                      <th>FIRST NAME</th>
                      <th>LAST NAME</th>
                      <th>MEMBER SINCE</th>
                      <th>MEMBER ID</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                
              <tbody id="userList">

                  <?php 
        
                     foreach($users as $user){ 

                        $registerDate = substr($user['register_date'], 0, 11)
                      ?>
                          
                              <tr>   
                              <td><?=htmlentities($user['first_name'])?></td>
                              <td><?=htmlentities($user['last_name'])?></td>
                              <td><?=htmlentities($registerDate)?></td>
                              <td><?=htmlentities($user['id'])?></td>

                              <div class="btn-cell">
                                <td>
                                  <form action="editusers.php" method='GET'>
                                    <input type='submit' class='btn btn-dark ' name='edit' value='EDIT'> 
                                    <input type='hidden' name='postid' value='<?=htmlentities($user['id'])?>'>
                                  </form>
                                </td>
                                <td >
                                  <form method="POST">
                                    <input type='submit' class='btn btn-dark delete-user-btn' name='delete' value='DELETE'>
                                    <input type='hidden' name='postid' value='<?=htmlentities($user['id'])?>'>
                                  </form>
                                </td>
                                </tr> 
                            </div>

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
        
