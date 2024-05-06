<?php require('connection.php'); ?>
<?php require('headerL.php'); ?>
<?php

if (!isset($_SESSION['user_id'])) {
    echo "<script> alert('Login Unsuccessful') </script>";
    header('Location: homepage.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="homepage.css">
</head>




<body>

    <p class="top">Welcome cuisine connoisseurs!!</p>

    <div class="wrapper1">

        <a href="addrecipe.php"><button type="submit" class="bt1"> Add New Recipe</button></a><br><br>
        <a href="savedrecipe.php"><button type="submit" class="bt2">Saved Recipes</button></a><br><br>
        <a href="myrecipepage.php"><button type="submit" class="bt3">My Recipes</button></a>

    </div>





</body>

</html>