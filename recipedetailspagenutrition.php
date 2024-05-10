<?php require('connection.php'); ?>
<?php require('headerL.php'); ?>

<?php
if (isset($_GET['recipe_id'])) {
    //getting recipe information
    $recipe_id = mysqli_real_escape_string($connection, $_GET['recipe_id']);
    $query = "SELECT * FROM recipes WHERE recipe_id = {$recipe_id} LIMIT 1";

    $result = mysqli_query($connection, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            //recipe found

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
            //recipe not found
            header('Location: recipespage.php?error=recipe_not_found');
        }
    } else {
        header('Location: recipespage.php?error=query_faild');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Recipe Details - Online Recipe Management System</title>
    <link rel="stylesheet" href="recipedetailspage.css">
    <link rel="website icon" type="jpg" href="https://i.pinimg.com/736x/b1/97/da/b197daf5f1cc7abf4948611468b6f745.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

</head>

<body>
    <div class="container">
        <div class="img">
            <div class="transasion">
                <img src="<?php echo $recipe_img ?>" class="recipeimg">
                <p class="recipename"><?php echo $recipe_name ?></p>
            </div>
            <p class="posted by">Posted by: <?php echo $user_id ?> </p>
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
                        <li><?php echo '<a href="recipedetailspage.php?recipe_id=' . $recipe_id . '">Ingredients</a></li>'; ?>
                    </button>
                    <button class="nav1">
                        <li><?php echo '<a href="recipedetailspageprocess.php?recipe_id=' . $recipe_id . '">Process</a></li>'; ?>
                    </button>
                    <button class="nav1">
                        <li><?php echo '<a href="recipedetailspagenutrition.php?recipe_id=' . $recipe_id . '">Nutrition</a></li>'; ?>
                    </button>
                    <button class="nav1">
                        <li><?php echo '<a href="recipedetailspagec.php?recipe_id=' . $recipe_id . '">Comment</a></li>'; ?>
                    </button>
                </ul>
            </nav>
            <div class="content">
                <h1>Nutrition</h1>
                <br>
                <p class="content1" id="content1">
                    <?php echo $nutrition ?>
                </p>

            </div>
        </div>
    </div>
</body>

</html>
<?php require('footer.php'); ?>