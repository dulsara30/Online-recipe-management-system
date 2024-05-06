<?php session_start(); ?>
<?php require('connection.php'); ?>
<?php

if (isset($_GET['recipe_id'])) {
    $recipe_id = mysqli_real_escape_string($connection, $_GET['user_id']);

    $query = "UPDATE recipe SET is_deleted = 1 WHERE recipe_id = {recipe_id} LIMIT 1";

    $result = mysqli_query($connection, $query);

    if ($result) {
        echo "<script> alert('Recipe Deleted'); </scrip>";
        header('Location: myrecipepage.php');
    }
}

?>