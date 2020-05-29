<?php
    require('../src/config.php');
    require('../src/dbconnect.php');

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit;

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
            $error .= "<li>Firstname is mandatory</li>";
        }

        if (empty($last_name)) {
            $error .= "<li>Lastname is mandatory</li>";
        }

        if (empty($email)) {
            $error .= "<li>Lastname is mandatory</li>";
        }

        if (empty($phone)) {
            $error .= "<li>Phone is mandatory</li>";
        }

        if (empty($street)) {
            $error .= "<li>Street is mandatory</li>";
        }

        if (empty($postal_code)) {
            $error .= "<li>Postalcode is mandatory</li>";
        }

        if (empty($city)) {
            $error .= "<li>City is mandatory</li>";
        }

        if (empty($country)) {
            $error .= "<li>Country is mandatory</li>";
        }

        if (empty($password) || empty($confirmPassword)) {
            $error .= "<li>Password is mandatory</li>";
        }

        if (!empty($password) && strlen($password) < 6) {
            $error .= "<li>Password is mandatory and need to be at least 6 characters long</li>";
        }

        if ($confirmPassword !== $password) {
            $error .= "<li>Password don´t match</li>";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error .= "<li>Invalid email</li>";
        }

        if ($error) {
            $msg = "<ul class='error_msg'>{$error}</ul>";
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
            
            $result = update($userData);

            if ($result) {
                $msg = '<div class="success_msg">Your account is updated.</div>';
            } else {
                $msg = '<div class="error_msg">Update failed. Please try again later!</div>';
            }
        }     
    }
     // Fetch user by id
     $user = fetchById('id');


// output with JSON
$data = [
  'message' => $msg,
];
echo json_encode($data);

