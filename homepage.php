<?php require('header.php'); ?>
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

    <div class="wrapper">

        <button type="submit" class="btn1" onclick="window.location.href='login.php';">Login</button><br><br>
        <button type="submit" class="btn2" class="btn2" onclick="window.location.href='register.php';"> Sign Up</button>

    </div>

    <script>
        document.querySelector('.btn1').addEventListener('click', function() {
            window.location.href = 'login.php';
        });
        document.querySelector('.btn2').addEventListener('click', function() {
            window.location.href = 'register.php';
        });
    </script>



</body>

</html>