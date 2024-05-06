<?php session_start(); ?>
<?php require('connection.php'); ?>
<?php

//if (!isset($_SESSION['user_id'])) {
//  echo "<script> alert('Login Unsuccessful') </script>";
//header('Location: homepage.php');
//}
// check for form submission
if (isset($_POST['login'])) {

    $errors = array();

    // check if the username and password has been entered
    if (!isset($_POST['email']) || strlen(trim($_POST['email'])) < 1) {
        $errors[] = 'Username is Missing / Invalid';
    }

    if (!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1) {
        $errors[] = 'Password is Missing / Invalid';
    }

    // check if there are any errors in the form
    if (empty($errors)) {
        // save username and password into variables
        $email         = mysqli_real_escape_string($connection, $_POST['email']);
        $password     = mysqli_real_escape_string($connection, $_POST['password']);
        //$hashed_password = sha1($password);

        // prepare database query
        $query = "SELECT * FROM registered_user 
						WHERE email = '{$email}' 
						AND user_pwd = '{$password}' 
						LIMIT 1";

        $result_set = mysqli_query($connection, $query);

        if ($result_set) {
            // query succesfful

            if (mysqli_num_rows($result_set) == 1) {

                $user = mysqli_fetch_assoc($result_set);
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['first_name'] = $user['first_name'];
                $_SESSION['email'] = $user['email'];

                if (strpos($_SESSION['email'], '@orms.admin') !== false) {
                    header('Location: Admin.php');
                    exit;
                } else {
                    header('Location: homepageL.php');
                }
                // valid user found
                // redirect to users.php

            } else {
                // user name and password invalid
                $errors[] = 'Invalid Username / Password';
            }
        } else {
            $errors[] = 'Database query failed';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="login.css">
</head>




<body>

    <?php
    if (!empty($errors)) {
        echo '<div class="errors" >';
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
        echo '</div>';
    }

    ?>
    <!--------Navigation bar-------->
    <header>
        <nav class="nav">
            <ul>
                <li><a href="homepage.php">Home</a></li>
                <li><a href="">About Us</a></li>
                <li><a href="recipespage.php">Recipes</a></li>
                <li><a href="help.php">Help</a></li>
                <li><a href="register.php">Sign up</a></li>
            </ul>
        </nav>

    </header>
    <div class="wrapper">
        <form action="" method="post">

            <h1>Login</h1>
            <div class="input-box">
                <input type="text" name="email" placeholder="Email" required>
            </div>

            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <input type="submit" name="login" value="Login">

            <div class="register-link">
                <p>Don't have an account?<a href="register.php">Sign up</a></p>

        </form>
    </div>



</body>

</html>