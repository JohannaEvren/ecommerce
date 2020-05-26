<?php
require('../src/config.php');
require('../src/dbconnect.php'); 

//You must log in.
if (!isset($_SESSION['first_name'])) {
        redirect('login.php?mustLogin');
        exit;
}else {
  echo '<style>.loginbtns { display:none;}</style>';
}

// Delete User
if (isset($_POST['deleteUserBtn'])) {
    delete($_POST['userId']);

}

//Show user info
if (isset($_SESSION['first_name'])){
    $user = fetchById($_SESSION['id']);
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>My Pages</title>
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
	<header>
        <div class="loginbtns">
            <form action="register.php" method="POST">
                <input type="submit" name="registerBtn" value="Register">
            </form> 
    		<form action="login.php" method="POST">
                <input type="submit" name="loginBtn" value="Log in">
            </form> 
        </div>
        <form action="logout.php" method="POST">
            <input type="submit" name="tologoutBtn" value="Log out">
        </form> 
        <form action="index.php" method="POST">
              <input type="submit" name="tohomeBtn" value="Home">
        </form> 
	</header>
	<section>
        <div class="userinfo">
            <p>User Id:</p><?=$user['id']?>
            <p>Firstname:<?=htmlentities($user['first_name'])?>
            <p>Lastname:</p><?=htmlentities($user['last_name'])?>
            <p>Email:</p><?=htmlentities($user['email'])?>
            <p>Password:</p><?=htmlentities($user['password'])?>
            <p>Phone:</p><?=htmlentities($user['phone'])?>
            <p>Street:</p><?=htmlentities($user['street'])?>
            <p>Postal Code:</p><?=htmlentities($user['postal_code'])?>
            <p>City:</p><?=htmlentities($user['city'])?>
            <p>Country:</p><?=htmlentities($user['country'])?>
            <p>Register Date:</p><?=htmlentities($user['register_date'])?><br>
        </div>
        <form action="update-user.php" method="GET" style="float:left;">
            <input type="hidden" name="id" value="<?=$user['id']?>">
            <input type="submit" value="Update">
        </form>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?=$user['id']?>">
            <input type="submit" name="deleteUserBtn" value="Delete this account">
        </form>
	</section>
    <footer>
    </footer>
</body>
</html>
 