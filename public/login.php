<?php
    require('../src/config.php');
    require('../src/dbconnect.php');

    $msg = "";

    if (isset($_GET['logout'])) {
        $msg = '<div class="success_msg">You been logged out.</div>';
    }

    if (isset($_GET['mustLogin'])) {
        $msg = '<div class="error_msg">You need to login to see this page.</div>';
    }

    if (isset($_POST['doLogin'])) {
        
        $email    = $_POST['email'];
        $password = $_POST['password'];

        $user = fetchUsersByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['id'] = $user['id'];
            redirect('mypages.php');
            exit;
        } else {
            $msg = '<div class="error_msg">Incorrect login information. Please try again.</div>';
        }
         
    }
    
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Log in</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<div class="container-fluid">
    <div class="row">
        <header>
            <form action="register.php" method="POST">
              <input type="submit" name="registerBtn" value="Register">
            </form> 
            <form action="index.php" method="POST">
              <input type="submit" name="tohomeBtn" value="Home">
            </form> 
        </header>
            <form method="POST" action="#">
                <fieldset>
                    <legend>Logga in</legend>
                        
                        <!-- Visa errormeddelanden -->
                    <?=$msg?>
                        
                    <p>
                        <label for="input1">Email:</label> <br>
                        <input type="text" class="text" name="email">
                    </p>

                    <p>
                        <label for="input2">Password:</label> <br>
                        <input type="password" class="text" name="password">
                    </p>

                    <p>
                        <input type="submit" name="doLogin" value="Log in">
                    </p>
                </fieldset>
            </form>
            
            <hr>
    </div>

</div>
<?php include "layout/footer.php"; ?>
</html>