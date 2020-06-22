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

    if (isset($_POST['register'])) {
        $first_name      = trim($_POST['first_name']);
        $last_name       = trim($_POST['last_name']);
        $email           = trim($_POST['email']);
        $phone           = trim($_POST['phone']);
        $street          = trim($_POST['street']);
        $postal_code     = trim($_POST['postal_code']);
        $city            = trim($_POST['city']);
        $country         = trim($_POST['country']);
        $password        = trim($_POST['password']);
        $confirmPassword = trim($_POST['confirmPassword']);

        if (empty($first_name)) {
            $error .= "<li class='list-group-item list-group-item-danger'>Firstname is mandatory</li>";
        }

        if (empty($last_name)) {
            $error .= "<li class='list-group-item list-group-item-danger'>Lastname is mandatory</li>";
        }

        if (empty($email)) {
            $error .= "<li class='list-group-item list-group-item-danger'>Email is mandatory</li>";
        }

        $users = fetchAllUsers();
        $userById = fetchUsersById($_SESSION['id']);

        foreach ($users as $user) {
            if ($_POST['email'] == $user['email'] && $_POST['email'] != $userById['email']) {
                $error .= "<li class='list-group-item list-group-item-danger'>This Email already exist!</li>";
            }
        }

        if (empty($phone)) {
            $error .= "<li class='list-group-item list-group-item-danger'>Phone is mandatory</li>";
        }

        if (empty($street)) {
            $error .= "<li class='list-group-item list-group-item-danger'>Street is mandatory</li>";
        }

        if (empty($postal_code)) {
            $error .= "<li class='list-group-item list-group-item-danger'>Postalcode is mandatory</li>";
        }

        if (empty($city)) {
            $error .= "<li class='list-group-item list-group-item-danger'>City is mandatory</li>";
        }

        if (empty($country)) {
            $error .= "<li class='list-group-item list-group-item-danger'>Country is mandatory</li>";
        }

        if (empty($password) || empty($confirmPassword)) {
            $error .= "<li class='list-group-item list-group-item-danger'>Password is mandatory</li>";
        }

        if (!empty($password) && strlen($password) < 6) {
            $error .= "<li class='list-group-item list-group-item-danger'>Password is mandatory and need to be at least 6 characters long</li>";
        }

        if ($confirmPassword !== $password) {
            $error .= "<li class='list-group-item list-group-item-danger'>Password don´t match</li>";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error .= "<li class='list-group-item list-group-item-danger'>Invalid email</li>";
        }

        if ($error) {
            $msg = "<ul class='list-group col-8'>{$error}</ul>";
        }

        if (empty($error)) {
            $userData = [
                'firstname'  => $first_name,
                'lastname'   => $last_name,
                'email'      => $email,
                'password'   => $password,
                'phone'      => $phone,
                'street'     => $street,
                'postalcode' => $postal_code,
                'city'       => $city,
                'country'    => $country,
                'id'         => $_SESSION['id'],
            ];
            
            $result = updateUser($userData);

            if ($result) {
                $msg = '<div class="alert alert-success col-8">Your account is updated.</div>';
            } else {
                $msg = '<div class="alert alert-danger>Update failed. Please try again later!</div>';
            }
        }     
    }


// output with JSON
$data = [
  'message' => $msg,
];
echo json_encode($data);

