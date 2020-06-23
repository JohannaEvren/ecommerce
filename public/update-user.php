<?php
    require('../src/config.php');
    require('../src/dbconnect.php');
    
    $msg = '';

     // Fetch user by id
     $user = fetchUsersById($_GET['id']);

     include('layout/header.php')
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Update User</title>
        <link rel="stylesheet" type="text/css" href="css/style_updatemyuser.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <div id="content">
            <form method="POST" action="#" id="updateform">
                    <fieldset>
                        <legend>Update User</legend>
                            
                        <!-- Visa errormeddelanden -->
                        <div id="message-field"><?=$msg?></div>
                       
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="input1">Firstname:</label> <br>
                                <input type="text" class="form-control" name="firstname" value="<?=htmlentities(ucfirst($user['first_name']))?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="input1">Lastname:</label> <br>
                                <input type="text" class="form-control" name="lastname" value="<?=htmlentities(ucfirst($user['last_name']))?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="input1">Email:</label> <br>
                                <input type="text" class="form-control" name="email" value="<?=htmlentities($user['email'])?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="input1">Phone:</label> <br>
                                <input type="text" class="form-control" name="phone" value="<?=htmlentities($user['phone'])?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="input1">Street:</label> <br>
                                <input type="text" class="form-control" name="street" value="<?=htmlentities(ucfirst($user['street']))?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="input1">Postalcode:</label> <br>
                                <input type="text" class="form-control" name="postalcode" value="<?=htmlentities($user['postal_code'])?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="input1">City:</label> <br>
                                <input type="text" class="form-control" name="city" value="<?=htmlentities(ucfirst($user['city']))?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="input1">Country:</label> <br>
                                <input type="text" class="form-control" name="country" value="<?=htmlentities(ucfirst($user['country']))?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="input2">Password:</label> <br>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="input2">Confirm Password:</label> <br>
                                <input type="password" class="form-control" name="confirmPassword">
                            </div>
                        </div>
                        <p>
                            <input type="submit" name="register" value="Update" class="update-user-btn">
                        </p>
                    </fieldset>
                </form>
        </div>
        <?php include('layout/footer.php'); ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        <!-- CUSTOM JavaScript -->
        <script src="js/main.js"></script>
    </body>
</html>