<?php require('connection.php') ?>
<?php require('headerL.php') ?>

<?php

if (!isset($_SESSION['user_id'])) {
    header('Location: homepage.php');
}
// Initialize variables
$comment_Id = '';
$message = '';
$recipe_id = '';
$user_Id = '';
$date = '';


if (isset($_GET['recipe_id'])) {
    $recipe_id = mysqli_real_escape_string($connection, $_GET['recipe_id']);

    $query = "SELECT * FROM recipes WHERE recipe_id = {$recipe_id} LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $recipedetails = mysqli_fetch_assoc($result);
        $recipe_id = $recipedetails['recipe_id'];
        $recipe_name = $recipedetails['recipe_name'];
        $recipe_img = $recipedetails['recipe_img'];
        $prep_time = $recipedetails['prep_time'];
        $cook_time = $recipedetails['cook_time'];
        $servings = $recipedetails['servings'];
        $ingredients = $recipedetails['ingredients'];
        $process = $recipedetails['process'];
        $nutrition = $recipedetails['nutrition'];
        $user_id = $recipedetails['user_id'];



        $sql = "SELECT first_name FROM registered_user WHERE user_id = {$user_id} LIMIT 1";

        $result_set = mysqli_query($connection, $sql);

        if ($result_set) {
            $posted_by = mysqli_fetch_assoc($result_set);
            $user_id = $posted_by['first_name'];
        } else {
            echo 'no no no !';
        }
    } else {
        header('Location: recipespage.php?error=recipe_not_found');
        exit();
    }

    // comment submission
    if (isset($_POST['commentSubmit'])) {
        $message = mysqli_real_escape_string($connection, $_POST['message']);
        $first_name = $_SESSION['first_name'];
        $date = mysqli_real_escape_string($connection, $_POST['date']);

        $sql = "INSERT INTO comments (comment, recipe_id, first_name, date) VALUES ('$message', '$recipe_id', '$first_name', '$date')";
        $result = mysqli_query($connection, $sql);
    }

    // Handle comment deletion
    if (isset($_POST['deleteComment'])) {
        $comment_Id = mysqli_real_escape_string($connection, $_POST['comment_Id']);
        $sql = "DELETE FROM comments WHERE comment_Id = '$comment_Id'";
        $result = mysqli_query($connection, $sql);
        if (!$result) {
            echo "Error deleting comment: " . mysqli_error($connection);
        } else {
            header("Location: recipedetailspagec.php?recipe_id=$recipe_id");
            exit();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Details - Online Recipe Management System</title>
    <link rel="stylesheet" href="recipedetailspage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="icon" type="image/jpg" href="https://i.pinimg.com/736x/b1/97/da/b197daf5f1cc7abf4948611468b6f745.jpg">
</head>

<body>
    <div class="container">
        <div class="img">
            <div class="transasion">
                <img src="<?php echo $recipe_img ?>" class="recipeimg">
                <p class="recipename"><?php echo $recipe_name ?></p>
            </div>
            <p class="posted by">Posted by:<?php echo $user_id ?> </p>
            <!--<p class="ratings"><i class="fas fa-star"></i> Rating: 4.8</p>-->
            <div class="icons">
                <article class="art">
                    <i class="fas fa-clock"></i>
                    <h5>prep time</h5>
                    <p><?php echo $prep_time ?> minutes</p>
                </article>
                <article class="art">
                    <i class="far fa-clock"></i>
                    <h5>cook time</h5>
                    <p><?php echo $cook_time ?> minutes</p>
                </article>
                <article class="art">
                    <i class="fas fa-user-friends"></i>
                    <h5>serving</h5>
                    <p><?php echo $servings ?> </p>
                </article>
            </div>
            <button class="saverecipe">Save Recipe for Later</button>
        </div>
        <div class="details">
            <nav>
                <ul>
                    <button class="nav1">
                        <li><a href="recipedetailspage.php?recipe_id=<?php echo $recipe_id ?>">Ingredients</a></li>
                    </button>
                    <button class="nav1">
                        <li><a href="recipedetailspageprocess.php?recipe_id=<?php echo $recipe_id ?>">Process</a></li>
                    </button>
                    <button class="nav1">
                        <li><a href="recipedetailspagenutrition.php?recipe_id=<?php echo $recipe_id ?>">Nutrition</a></li>
                    </button>
                    <button class="nav1">
                        <li><a href="recipedetailspagec&r.php?recipe_id=<?php echo $recipe_id ?>">Comments</a></li>
                    </button>
                </ul>
            </nav>
            <div class="content">
                <h1>Comments</h1>
                <form method="post" action="">
                    <textarea name="message"></textarea><br>
                    <input type="hidden" name="user_Id" value="Anonymous">
                    <input type="hidden" name="date" value="<?php echo date('Y-m-d H:i:s'); ?>">
                    <button type="submit" name="commentSubmit">Comment</button>
                </form>

                <?php
                // Display comments
                $sql = "SELECT * FROM comments WHERE recipe_id = {$recipe_id}";
                $result = mysqli_query($connection, $sql);
                if ($result) {
                    /*$commentsDetails = mysqli_fetch_assoc($result);
                    $comment_Id = $commentsDetails['comment_Id'];
                    $message = $commentsDetails['comment'];
                    $recipe_id = $commentsDetails['recipe_id'];
                    $user_Id = $commentsDetails["user_Id"];
                    $date = $commentsDetails['date'];*/

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='comment-box'><p>";
                        echo $row['first_name'] . "<br>";
                        echo ($row['comment']);
                        echo "</p>
                    <form class='delete-form' method='POST' action=''>
                        <input type='hidden' name='comment_Id' value='" . $row['comment_Id'] . "'>
                        <button type='submit' name='deleteComment'>Delete</button>
                    </form>
                    <form class='edit-btn' method='GET' action='editcomment.php'>
                        <input type='hidden' name='comment_Id' value='" . $row['comment_Id'] . "'>
                        <input type='hidden' name='user_Id' value='" . $row['first_name'] . "'>
                        <input type='hidden' name='comment' value='" . $row['comment'] . "'>
                        <button>Edit</button>
                    </form>
                    </div>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>
<?php require('footer.php'); ?>