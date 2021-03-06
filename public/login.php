<?php
    require('../src/config.php');
    require('../src/dbconnect.php');

    $msg = "";

    if (isset($_GET['logout'])) {
        $msg = '<div class="alert alert-success col-12">You been logged out.</div>';
    }

    if (isset($_GET['mustLogin'])) {
        $msg = '<div class="alert alert-danger">You need to login to see this page.</div>';
    }

    if (isset($_POST['doLogin'])) {
        
        $email    = $_POST['email'];
        $password = $_POST['password'];

        $user = fetchUsersByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['id'] = $user['id'];
            redirect('products.php');
            exit;
        } else {
            $msg = '<div class="alert alert-danger">Incorrect login information. Please try again.</div>';
        }
         
    }
    include('layout/header.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Log in</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<div class="container-fluid">
    <div class="row loginbox">
        <form method="POST" action="#">
            <fieldset>
                <legend>Log in</legend>                
                <!-- Visa errormeddelanden -->
                    <?=$msg?>
                        
                <p>
                    <label for="input1">Email:</label> <br>
                    <input type="text" class="logintext" name="email">
                </p>

                <p>
                    <label for="input2">Password:</label> <br>
                    <input type="password" class="logintext" name="password">
                </p>

                <p>
                    <input type="submit" class="login" name="doLogin" value="LOG IN">
                </p>
            </fieldset>
        </form>
    </div>

</div>
<?php include "layout/footer.php"; ?>
</html>