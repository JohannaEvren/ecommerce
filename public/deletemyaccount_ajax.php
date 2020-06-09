<?php
require('../src/config.php');
require('../src/dbconnect.php'); 

//echo "<pre>";
//print_r($_POST);
//echo "</pre>";
//exit;

// Delete User
if (isset($_POST['deleteUserBtn'])) {
    deleteMyUser($_POST['id']);
}

unset($_SESSION['first_name']);

// output with JSON
$data = [
  
];
echo json_encode($data);

