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
	<section id ="userinfo">
        <div class="userinfo">
            <p>User Id:</p><?=$user['id']?>
            <p>Firstname:</p><?=htmlentities(ucfirst($user['first_name']))?>
            <p>Lastname:</p><?=htmlentities(ucfirst($user['last_name']))?>
            <p>Email:</p><?=htmlentities(ucfirst($user['email']))?>
            <p>Phone:</p><?=htmlentities($user['phone'])?>
            <p>Street:</p><?=htmlentities(ucfirst($user['street']))?>
            <p>Postal Code:</p><?=htmlentities($user['postal_code'])?>
            <p>City:</p><?=htmlentities(ucfirst($user['city']))?>
            <p>Country:</p><?=htmlentities(ucfirst($user['country']))?>
            <p>Register Date:</p><?=htmlentities($user['register_date'])?><br>
        </div>
        <form action="update-user.php" method="GET">
            <input type="hidden" name="id" value="<?=$user['id']?>">
            <input type="submit" value="Update">
        </form>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?=$user['id']?>">
            <input type="submit" name="deleteUserBtn" value="Delete this account" class="delete-user-btn">
        </form>
	</section>
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
 