<?php require('connection.php'); ?>
<?php require('headerL.php'); ?>

<?php

if (!isset($_SESSION['user_id'])) {
    header('Location: homepage.php');
}
$errors = array();
$first_name = '';
$last_name = '';
$email = '';
$dob = '';
$gender = '';

$user_id = mysqli_real_escape_string($connection, $_SESSION['user_id']); //sanitizing
$query = "SELECT * FROM registered_user WHERE user_id = {$user_id} LIMIT 1"; //store the date to the variable from the query

$result = mysqli_query($connection, $query); //execute the query

if ($result) {
    if (mysqli_num_rows($result) == 1) {
        $user_details = mysqli_fetch_assoc($result);

        $first_name = $user_details['first_name'];
        $last_name = $user_details['last_name'];
        $email = $user_details['email'];
        $dob = $user_details['dob'];
        $gender = $user_details['gender'];
    } else {
        echo "error:" . mysqli_error($connection);
    }
} else {
    echo 'User not found!';
}

if (isset($_POST['update'])) {
    $user_id = mysqli_real_escape_string($connection, $_POST['user_id']);
    $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $dob = mysqli_real_escape_string($connection, $_POST['dob']);
    $gender = mysqli_real_escape_string($connection, $_POST['gender']);

    $query = "UPDATE registered_user SET
    user_id = '{$user_id}',
    first_name = '{$first_name}',
    last_name = '{$last_name}',
    email = '{$email}',
    dob = '{$dob}',
    gender = '{$gender}'
    WHERE user_id = '{$user_id}'";

    $result = mysqli_query($connection, $query);

    if ($result) {
        echo "<script>alert('User detailes updated successfully!');</script>";
    } else {
        echo "An error occured..." . mysqli_error($connection);
    }
}

if (isset($_POST['delete'])) {


    $query = "DELETE FROM registered_user WHERE user_id = {$user_id}";

    echo $user_id;

    $result = mysqli_query($connection, $query);

    if ($result) {
        header('Location: homepage.php');
    } else {
        echo "Error deleting user : " . mysqli_error($connection);
    }
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodingDung | Profile Template</title>
    <link rel="stylesheet" href="useredit.css">

</head>

<body>
    <div class="container">
        <fieldset class="field">
            <legend>
                <h1 class="topic">User Profile</h1>
            </legend>
            <div class="usersearch">

                <div class="content">
                    <div class="image">
                        <img src="https://i.pinimg.com/564x/e8/7a/b0/e87ab0a15b2b65662020e614f7e05ef1.jpg" alt="profile photo" class="img">
                        <br>
                        <button type="button" class="button1">
                            <p>change profile picture: </p><input class="file" type="file" placeholder="change profile picture">
                        </button>
                        <br>
                        <a href="savedRecipe.php"><button type="button" class="button">Saved Recipe</button></a>
                        <br>
                        <a href="addrecipe.php"><button type="button" class="button">Add Recipe</button></a>
                        <br>
                        <a href="myrecipepage.php"><button type="button" class="button">My Recipes</button></a>
                    </div>

                    <div class="details">
                        <form action="" method="post">
                            <fieldset>
                                <p class="de">
                                    <label for=""> User ID: </label>
                                    <input class="data" type="text" placeholder="User ID" name="user_id" value="<?php echo $user_id; ?>">
                                </p>
                                <p class="de">
                                    <label for=""> First Name: </label>
                                    <input class="data" type="text" placeholder="First Name" name="first_name" value="<?php echo $first_name; ?>">
                                </p>
                                <p class="de">
                                    <label for=""> Last Name: </label>
                                    <input class="data" type="text" placeholder="Last Name" name="last_name" value="<?php echo $last_name; ?>">
                                </p>
                                <p class="de">
                                    <label for=""> Email: </label>
                                    <input class="data" type="text" placeholder="Email" name="email" value="<?php echo $email; ?>">
                                </p>
                                <p class="de">
                                    <label for=""> Gender: </label>
                                    <input class="data" type="text" placeholder="Gender" name="gender" value="<?php echo $gender; ?>">
                                </p>
                                <p class="de">
                                    <label for=""> Birthday: </label>
                                    <input class="data" type="date" placeholder="Birthday" name="dob" value="<?php echo $dob; ?>">
                                </p>
                            </fieldset>

                            <div class="details">
                                <form action="" method="post">

                                    <div class="form-actions">
                                        <button type="submit" class="usubmit-btn" name="update">Update</button>
                                        <button type="submit" class="dsubmit-btn" name="delete" onclick="return confirm('Are you sure?');">Delete</button>
                                    </div>
                                </form>
                            </div>


                        </form>





                    </div>
                </div>
        </fieldset>
    </div>
</body>

</html>