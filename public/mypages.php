<?php
require('../src/config.php');
require('../src/dbconnect.php'); 

//You must log in.
if (!isset($_SESSION['first_name'])) {
        redirect('login.php?mustLogin');
        exit;
}

//Show user info
if (isset($_SESSION['first_name'])){
    $user = fetchUsersById($_SESSION['id']);
}

include('layout/header.php');

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>My Pages</title>
    <link rel="stylesheet" type="text/css" href="css/style_mypages.css">
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
	<section id ="userinfo">
        <h2>MY ACCOUNT</h2>
        <div class="row">
            <ul class="list-group list-group-flush col-sm-6">
                <li class="list-group-item"><b>User Id: </b><?=$user['id']?></li>
                <li class="list-group-item"><b>Firstname: </b><?=htmlentities(ucfirst($user['first_name']))?></li>
                <li class="list-group-item"><b>Lastname: </b><?=htmlentities(ucfirst($user['last_name']))?></li>
                <li class="list-group-item"><b>Email: </b><?=htmlentities(ucfirst($user['email']))?></li>
                <li class="list-group-item"><b>Phone: </b><?=htmlentities($user['phone'])?></li>
                <li class="list-group-item"><b>Street: </b><?=htmlentities(ucfirst($user['street']))?></li>
                <li class="list-group-item"><b>Postal Code: </b><?=htmlentities($user['postal_code'])?></li>
                <li class="list-group-item"><b>City: </b><?=htmlentities(ucfirst($user['city']))?></li>
                <li class="list-group-item"><b>Country: </b><?=htmlentities(ucfirst($user['country']))?></li>
                <li class="list-group-item"><b>Register Date: </b><?=htmlentities($user['register_date'])?></li>
            </ul>
        </div>
        <div class="submitBtns">
            <form action="update-user.php" method="GET">
                <input type="hidden" name="id" value="<?=$user['id']?>">
                <input type="submit" value="UPDATE">
            </form>
            <form action="" method="POST">
                <input type="hidden" name="id" value="<?=$user['id']?>">
                <input type="submit" name="deleteUserBtn" value="DELETE THIS ACCOUNT" class="delete-user-btn">
            </form>
        </div>
	</section>
    <?php include "layout/footer.php";?>
     <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        <!-- CUSTOM JavaScript -->
        <script src="js/main.js"></script>
</body>
</html>
 