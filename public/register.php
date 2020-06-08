<?php
    require('../src/config.php');
    require('../src/dbconnect.php');

    $users = fetchAllUsers();

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
        $first_name      = trim($_POST['firstname']);
        $last_name       = trim($_POST['lastname']);
        $email           = trim($_POST['email']);
        $phone           = trim($_POST['phone']);
        $street          = trim($_POST['street']);
        $postal_code     = trim($_POST['postalcode']);
        $city            = trim($_POST['confirmPassword']);
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
            $error .= "<li>Email is mandatory</li>";
        }

        foreach ($users as $user) {
            if ($_POST['email'] == $user['email']) {
                $error .= "<li>This Email already exist!</li>";
            }
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
                'firstname' => $first_name,
                'lastname' => $last_name,
                'email' => $email,
                'password' => $password,
                'phone' => $phone,
                'street' => $street,
                'postalcode' => $postal_code,
                'city' => $city,
                'country' => $country,
                ];

            $result = registerUser($userData);
            if ($result) {
                $msg = '<div class="success_msg">Your account is created.</div>';
            } else {
                $msg = '<div class="error_msg">Register failed. Please try again later!</div>';
            }
        }
    }
    include('layout/header.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Register</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <div id="content">
            <form method="POST" action="#">
                <fieldset>
                    <legend>Register here</legend>
                        
                    <!-- Visa errormeddelanden -->
                    <?=$msg?>
                        
                     <p>
                        <label for="input1">Firstname:</label> <br>
                        <input type="text" class="text" name="firstname" value="<?=htmlentities($first_name)?>">
                    </p>

                    <p>
                        <label for="input1">Lastname:</label> <br>
                        <input type="text" class="text" name="lastname" value="<?=htmlentities($last_name)?>">
                    </p>

                    <p>
                        <label for="input1">Email:</label> <br>
                        <input type="text" class="text" name="email" value="<?=htmlentities($email)?>">
                    </p>

                    <p>
                        <label for="input1">Phone:</label> <br>
                        <input type="text" class="text" name="phone" value="<?=htmlentities($phone)?>">
                    </p>

                    <p>
                        <label for="input1">Street:</label> <br>
                        <input type="text" class="text" name="street" value="<?=htmlentities($street)?>">
                    </p>

                    <p>
                        <label for="input1">Postalcode:</label> <br>
                        <input type="text" class="text" name="postalcode" value="<?=htmlentities($postal_code)?>">
                    </p>

                    <p>
                        <label for="input1">City:</label> <br>
                        <input type="text" class="text" name="city" value="<?=htmlentities($city)?>">
                    </p>

                    <p>
                        <label for="input1">Country:</label> <br>
                        <input type="text" class="text" name="country" value="<?=htmlentities($country)?>">
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
                        <input type="submit" name="register" value="Register">
                    </p>
                </fieldset>
            </form>
    </div>
</html>