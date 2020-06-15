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
            $error .= "<li class='list-group-item list-group-item-danger'>Firstname is mandatory</li>";
        }

        if (empty($last_name)) {
            $error .= "<li class='list-group-item list-group-item-danger'>Lastname is mandatory</li>";
        }

        if (empty($email)) {
            $error .= "<li class='list-group-item list-group-item-danger'>Email is mandatory</li>";
        }

        foreach ($users as $user) {
            if ($_POST['email'] == $user['email']) {
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
                $msg = '<div class="alert alert-success col-4 success_msg">Your account is created.</div>';
            } else {
                $msg = '<div class="<li class="list-group-item list-group-item-danger">Register failed. Please try again later!</li>"></div>';
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
        <link rel="stylesheet" type="text/css" href="css/style_register.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <div id="content">
            <form method="POST" action="#">
                <fieldset>
                    <legend>SIGN UP</legend>
                        
                    <!-- Visa errormeddelanden -->
                    <?=$msg?>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="input1">Firstname:</label> <br>
                            <input type="text" class="form-control" name="firstname" value="<?=htmlentities($first_name)?>">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="input1">Lastname:</label> <br>
                            <input type="text" class="form-control" name="lastname" value="<?=htmlentities($last_name)?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="input1">Email:</label> <br>
                            <input type="text" class="form-control" name="email" value="<?=htmlentities($email)?>">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="input1">Phone:</label> <br>
                            <input type="text" class="form-control" name="phone" value="<?=htmlentities($phone)?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="input1">Street:</label> <br>
                            <input type="text" class="form-control" name="street" value="<?=htmlentities($street)?>">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="input1">Postalcode:</label> <br>
                            <input type="text" class="form-control" name="postalcode" value="<?=htmlentities($postal_code)?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="input1">City:</label> <br>
                            <input type="text" class="form-control" name="city" value="<?=htmlentities($city)?>">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="input1">Country:</label> <br>
                            <input type="text" class="form-control" name="country" value="<?=htmlentities($country)?>">
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
                        <input type="submit" name="register" value="REGISTER">
                    </p>
                </fieldset>
            </form>
    </div>
    <?php include "layout/footer.php";?>
</html>