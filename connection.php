<?php

$connection = mysqli_connect('localhost', 'root', '', 'orms');

if (mysqli_connect_errno()) {
    die('Database connection faild' . mysqli_connect_error());
} else {
    //echo "Database connection successful.";
}
