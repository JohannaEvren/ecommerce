<?php
    require('../src/config.php');
    require('../src/dbconnect.php');
    
    $first_name      = '';
    $last_name       = '';
    $email           = '';
    $password        = '';
    $phone           = '';
    $street          = '';
    $postal_code     = '';
    $city            = '';
    $confirmPassword = '';
    $country         = '';
    $error           = '';
    $msg             = '';

     // Fetch user by id
     $user = fetchUsersById($_GET['id']);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Update User</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <div id="content">
            <header>
                <form action="products.php" method="POST">
                  <input type="submit" name="homeBtn" value="Home">
                </form> 
                <form action="logout.php" method="POST">
                  <input type="submit" name="logoutBtn" value="Log out">
                </form> 
            </header>
                <form method="POST" action="#" id="updateform">
                    <fieldset>
                        <legend>Update User</legend>
                            
                        <!-- Visa errormeddelanden -->
                        <div id="message-field"><?=$msg?></div>
                       
                        <p>
                            <label for="input1">Firstname:</label> <br>
                            <input type="text" class="text" name="firstname" value="<?=htmlentities(ucfirst($user['first_name']))?>">
                        </p>

                        <p>
                            <label for="input1">Lastname:</label> <br>
                            <input type="text" class="text" name="lastname" value="<?=htmlentities(ucfirst($user['last_name']))?>">
                        </p>

                        <p>
                            <label for="input1">Email:</label> <br>
                            <input type="text" class="text" name="email" value="<?=htmlentities($user['email'])?>">
                        </p>

                        <p>
                            <label for="input1">Phone:</label> <br>
                            <input type="text" class="text" name="phone" value="<?=htmlentities($user['phone'])?>">
                        </p>

                        <p>
                            <label for="input1">Street:</label> <br>
                            <input type="text" class="text" name="street" value="<?=htmlentities(ucfirst($user['street']))?>">
                        </p>

                        <p>
                            <label for="input1">Postalcode:</label> <br>
                            <input type="text" class="text" name="postalcode" value="<?=htmlentities($user['postal_code'])?>">
                        </p>

                        <p>
                            <label for="input1">City:</label> <br>
                            <input type="text" class="text" name="city" value="<?=htmlentities(ucfirst($user['city']))?>">
                        </p>

                        <p>
                            <label for="input1">Country:</label> <br>
                            <input type="text" class="text" name="country" value="<?=htmlentities(ucfirst($user['country']))?>">
                        </p>

                        <p>
                            <label for="input2">Password:</label> <br>
                            <input type="password" class="text" name="password">
                        </p>

                        <p>
                            <label for="input2">Confirm Password:</label> <br>
                            <input type="password" class="text" name="confirmPassword">
                        </p>

                        <p>
                            <input type="submit" name="register" value="Update" class="update-user-btn">
                        </p>
                    </fieldset>
                </form>
                <hr>
        </div>
        <footer>
        </footer>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        <!-- CUSTOM JavaScript -->
        <script src="js/main.js"></script>
    </body>
</html>