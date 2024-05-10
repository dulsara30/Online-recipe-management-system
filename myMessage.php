<?php require('connection.php'); ?>
<?php require('headerL.php'); ?>
<?php

if (!isset($_SESSION['email']) && !isset($_SESSION['user_id'])) {
    $email = "user@gmail.com";
    $user_id = '4';

    $_SESSION['email'] = $email;
    $_SESSION['user_id'] = $user_id;
}
require_once "HelpController.php";
$helpController = new HelpController($connection);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_button'])) {
    $edited_message = $_POST['edited_message'];
    $message_id = $_POST['message_id'];
    $helpController->updateQuestion($message_id, $edited_message);
    unset($_POST['edit_button']);
    unset($_POST['edited_message']);
    unset($_POST['message_id']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_button'])) {
    $message_id = $_POST['message_id'];
    $helpController->deleteQuestion($message_id);
    unset($_POST['delete_button']);
    unset($_POST['message_id']);
}

$helpController = new HelpController($connection);
$userId = $_SESSION['user_id'];
$myMessageResults = $helpController->getUserMessages($userId);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How We Can Help You?</title>
    <link rel="stylesheet" href="help.css">
</head>

<body>
    <header>
        <h1>Food Recipe Management System</h1>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="recipes.html">Recipes</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="contact.html">Contact Us</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero">
        <div class="container">
            <a href="help.php">FAQ</a>&nbsp;&nbsp;&nbsp;
            <a href="myMessage.php">My Messages</a>
            <h2 style="margin-top: 20px;"><mark>How can we help you?</mark></h2>
            <section class="faq-search">
                <h3>Search FAQs</h3>
                <form id="faq-search-form">
                    <input type="text" id="faq-search-input" placeholder="Search...">
                    <button type="submit">Search</button>
                </form>
            </section>
            <section>
                <?php
                // Assuming $myMessageResults holds the messages for the user
                foreach ($myMessageResults as $message) {
                    echo "<div class='message-item'>";
                    // Edit and delete form
                    echo "<form action='' method='post'>";
                    echo "<textarea class='message-textbox' name='edited_message'>{$message['message']}</textarea>";
                    echo "<input type='hidden' name='message_id' value='{$message['id']}'>";
                    echo "<div class='message-buttons'>";
                    echo "<button class='edit-btn' type='submit' name='edit_button'>Edit</button>";
                    echo "<button class='delete-btn' type='submit' name='delete_button'>Delete</button>";
                    echo "</div>";
                    echo "</form>";
                    echo "</div>";
                }

                ?>

            </section>
        </div>
    </section>



</body>

</html>