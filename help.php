<?php require('connection.php'); ?>
<?php require('headerL.php'); ?>
<?php


require_once "HelpController.php";

$helpController = new HelpController($connection);

$question_status = false;

$display_message = "";

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define variables and initialize with empty values
    $name = $email = $message = "";
    $name_err = $email_err = $message_err = "";

    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter your name.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email address.";
    } else {
        $email = trim($_POST["email"]);
        // Check if the email address is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Invalid email address.";
        }
    }

    // Validate message
    if (empty(trim($_POST["message"]))) {
        $message_err = "Please enter your message.";
    } else {
        $message = trim($_POST["message"]);
    }

    // If there are no errors, proceed to process the form data
    if (empty($name_err) && empty($email_err) && empty($message_err)) {

        $isUser = $helpController->IsUser($email);
        if (!$isUser) {
            $helpController->createUser($name, $email);
        }
        $userId = $helpController->getUserId($email);
        $helpController->createQuestion($message, $userId);
        $question_status = true;
        $display_message = "Success.";
        unset($_POST["name"]);
        unset($_POST["email"]);
        unset($_POST["message"]);
    } else {
        $display_message = "Please fill in all the fields.";
    }
}

$faqResult = $helpController->getAllFAQ();

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
    <!-- <header>
        <h1>Food Recipe Management System</h1>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="recipes.html">Recipes</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="contact.html">Contact Us</a></li>
            </ul>
        </nav>
    </header>-->

    <section class="hero">
        <div class="container">
            <a href="./help.php">FAQ</a>&nbsp;&nbsp;&nbsp;
            <a href="./myMessage.php">My Messages</a>
            <h2 style="margin-top: 20px;"><mark>How can we help you?</mark></h2>
            <section class="faq-search">
                <h3>Search FAQs</h3>
                <form id="faq-search-form">
                    <input type="text" id="faq-search-input" placeholder="Search...">
                    <button type="submit">Search</button>
                </form>
            </section>
        </div>
    </section>

    <section class="feedback">
        <div class="container">
            <h3>Share Your Feedback</h3>
            <form action="" method="post">
                <label for="name">Your Name:</label>
                <input type="text" id="name" name="name" required><br><br>

                <label for="email">Your Email:</label>
                <input type="email" id="email" name="email" required><br><br>

                <label for="message">Your Message:</label><br>
                <textarea id="message" name="message" rows="4" required></textarea><br><br>

                <button type="submit">Submit</button>
            </form>
        </div>
    </section>


    <section class="faq">
        <div class="container">
            <h3>Frequently Asked Questions</h3>
            <?php

            $numRows = $faqResult->num_rows;

            $htmlContent = '';

            if ($numRows > 0) {

                for ($i = 0; $i < $numRows; $i++) {
                    $faqItem = $faqResult->fetch_assoc();
                    $htmlContent .= '<div class="faq-item">';
                    $htmlContent .= '<h4>' . $faqItem['question'] . '</h4>';
                    $htmlContent .= '<p>' . $faqItem['answer'] . '</p>';
                    $htmlContent .= '</div>';
                }
            } else {
                $htmlContent = "No FAQs found.";
            }

            echo $htmlContent;
            ?>
        </div>
    </section>
    <div id="messageBox" class="message-box"></div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var messageBox = document.getElementById("messageBox");

            function showMessage(message) {
                messageBox.innerHTML = message;
                messageBox.style.display = "block";

                setTimeout(function() {
                    messageBox.style.display = "none";
                }, 4000);
            }

            <?php
            if (!empty($display_message)) {
                echo "showMessage('$display_message');";
            }
            ?>
        });
    </script>
</body>

</html>