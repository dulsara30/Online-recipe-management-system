<?php require('connection.php'); ?>
<?php require('headerL.php'); ?>
<?php

if (!isset($_SESSION['user_id'])) {
    header('Location: homepage.php');
}


$errors = array();
$recipe_id = '';
$recipe_name = '';
$recipe_img = '';
$ingredients = '';
$process = '';
$nutrition = '';
$keywords = '';
$vegetarian = '';
$prep_time = '';
$cook_time = '';
$servings = '';
$user_id = '';


if (isset($_GET['recipe_id'])) {
    //getting recipe information
    $recipe_id = mysqli_real_escape_string($connection, $_GET['recipe_id']);
    $query = "SELECT * FROM recipes WHERE recipe_id = {$recipe_id} LIMIT 1";

    $result = mysqli_query($connection, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            echo 'recipe found';

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
            $keywords = $recipedetails['keywords'];
            $user_id = $recipedetails['user_id'];


            if (isset($_POST['submit'])) {
                echo "<script>alert('Recipe updated successfully!');</script>";

                if (strlen(trim($_POST['recipe_name'])) > 100) {
                    $errors[] = 'recipe_name must be less than 100 characters';
                }

                // If there are no errors so far
                if (empty($errors)) {

                    $recipe_name = mysqli_real_escape_string($connection, $_POST['recipe_name']);
                    $query = "SELECT * FROM recipes WHERE recipe_id = '{$recipe_name}' AND recipe_id != {$recipe_id} LIMIT 1";

                    $result = mysqli_query($connection, $query);

                    if ($result) {
                        echo '222';
                        if (mysqli_num_rows($result) > 0) {
                            $errors[] = 'Recipe name already exists';
                        }
                    }

                    if (empty($errors)) {

                        $recipe_name = mysqli_real_escape_string($connection, $_POST['recipe_name']);
                        $recipe_img = mysqli_real_escape_string($connection, $_POST['recipe_img']);
                        $vegetarian = mysqli_real_escape_string($connection, $_POST['vegetarian']);
                        $prep_time = mysqli_real_escape_string($connection, $_POST['prep_time']);
                        $cook_time = mysqli_real_escape_string($connection, $_POST['cook_time']);
                        $servings = mysqli_real_escape_string($connection, $_POST['servings']);
                        $ingredients = mysqli_real_escape_string($connection, $_POST['ingredients']);
                        $process = mysqli_real_escape_string($connection, $_POST['process']);
                        $nutrition = mysqli_real_escape_string($connection, $_POST['nutrition']);
                        $keywords = mysqli_real_escape_string($connection, $_POST['keywords']);

                        $query = "UPDATE recipes SET 
                recipe_name = '{$recipe_name}', 
                recipe_img = '{$recipe_img}', 
                ingredients = '{$ingredients}', 
                process = '{$process}', 
                nutrition = '{$nutrition}', 
                prep_time = '{$prep_time}', 
                cook_time = '{$cook_time}', 
                servings = '{$servings}', 
                vegetarian = '{$vegetarian}', 
                keywords = '{$keywords}' 
                WHERE recipe_id = '{$recipe_id}'";

                        $result = mysqli_query($connection, $query);

                        if ($result) {

                            echo "<script>alert('Recipe updated successfully!');</script>";
                        } else {
                            echo "Error: " . mysqli_error($connection);
                        }
                    }
                }
            } else {
            }
        }
    }
}


?>

<!DOCTYPE html>
<html>

<head>
    <title> Add Recipe</title>
    <link rel="stylesheet" type="text/css" href="addrecipe.css">
</head>

<body>
    <h2 class="title">
        <center>Edit Recipe</center>
    </h2>

    <!--displaying all errors-->
    <?php
    if (!empty($errors)) {
        echo '<div class="errors" >';
        echo 'There were error(s) on your form. <br>';
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
        echo '</div>';
    }

    ?>

    <form action="editrecipe.php" method="post">
        <input type="hidden" name="recipe_id" value="<?php echo $recipe_id; ?>">

        <div class="container">


            <div class="section1">
                <label for="recipe_name">
                    <h3>Recipe Name:</h3>
                </label><br>
                <input type="text" class="recname" id="recipe_name" name="recipe_name" <?php echo 'value="' . $recipe_name . '"'; ?> required><br><br>
                <!-- <div class="search">
                    <p class="mg">Please search for the recipe name before entering to avoid duplicate entries and potential error messages!</p>
                    <form action="recipespage.php" method="get">
                        <p>
                            <input class="input" type="text" name="search" placeholder="Search Recipe Name..." value="<?php //echo $search 
                                                                                                                        ?>">

                        </p>

                    </form>

                </div>-->

                <label for="recipe_img">
                    <h3>Recipe Image Link:</h3>
                </label><br>
                <input type="url" class="imglink" id="recipe_img" name="recipe_img" <?php echo 'value="' . $recipe_img . '"'; ?> required><br><br>

                <label>
                    <h3>Vegetarian:</h3>
                </label><br>
                <label for="vegetarian_yes" class="vegnonveg"><input type="radio" id="vegetarian_yes" name="vegetarian" value="veg"><span class="checkmark"></span> Yes</label>
                <label for="vegetarian_no" class="vegnonveg"><input type="radio" id="vegetarian_no" name="vegetarian" value="non"><span class="checkmark"></span> No</label><br><br>
                <div class="label">
                    <label>
                        <h3>Categories:</h3>
                    </label><br>
                    <ul>
                        <li><label class="label1" for="appetizers"><input type="checkbox" id="appetizers" name="category[]" value="appetizers">Appetizers</label></li>
                        <li><label class="label1" for="soups_salads"><input type="checkbox" id="soups_salads" name="category[]" value="soups_salads">Soups and Salads</label></li>
                        <li><label class="label1" for="main_dishes"><input type="checkbox" id="main_dishes" name="category[]" value="main_dishes">Main Dishes</label></li>
                        <li><label class="label1" for="side_dishes"><input type="checkbox" id="side_dishes" name="category[]" value="side_dishes">Side Dishes</label></li>
                        <li><label class="label1" for="breakfast"><input type="checkbox" id="breakfast" name="category[]" value="breakfast">Breakfast</label></li>
                        <li><label class="label1" for="brunch"><input type="checkbox" id="brunch" name="category[]" value="brunch">Brunch</label></li>
                        <li><label class="label1" for="lunch"><input type="checkbox" id="lunch" name="category[]" value="lunch">Lunch</label></li>
                        <li><label class="label1" for="dinner"><input type="checkbox" id="dinner" name="category[]" value="dinner">Dinner</label></li>
                        <li><label class="label1" for="desserts"><input type="checkbox" id="desserts" name="category[]" value="desserts">Desserts</label></li>
                        <li><label class="label1" for="beverages"><input type="checkbox" id="beverages" name="category[]" value="beverages">Beverages</label></li>
                        <li><label class="label1" for="snacks"><input type="checkbox" id="snacks" name="category[]" value="snacks">Snacks</label><br><br></li>
                    </ul>
                </div>
                <label for="prep_time">
                    <h3>Prep Time(in minutes):</h3>
                </label><br>
                <input type="number" class="recname" id="prep_time" name="prep_time" min="1" <?php echo 'value="' . $prep_time . '"'; ?> required><br><br>
                <label for="cook_time">
                    <h3>Cook Time(in minutes):</h3>
                </label><br>
                <input type="number" class="recname" id="cook_time" name="cook_time" min="1" <?php echo 'value="' . $cook_time . '"'; ?> required><br><br>
                <label for="servings">
                    <h3>Servings:</h3>
                </label><br>
                <input type="number" class="recname" id="servings" name="servings" min="1" max="50" <?php echo 'value="' . $servings . '"'; ?> required><br><br>
                <label for="recipe_name">

            </div>

            <div class="section2">
                <label for="ingredients">
                    <h3>Ingredients:</h3>
                </label><br>
                <textarea class="txta" id="ingredients" placeholder="Enter each ingredient and its quantity here (one ingredient per line)." name="ingredients" rows="4" required><?php echo $ingredients; ?></textarea><br><br>

                <label for="process">
                    <h3>Process:</h3>
                </label><br>
                <textarea class="txta" id="process" placeholder="Enter each step of the recipe here (one step per line)." name="process" rows="4" required><?php echo $process; ?></textarea><br><br>

                <label for="nutrition">
                    <h3>Nutrition:</h3>
                </label><br>
                <textarea class="txta" placeholder="Enter key nutritional facts for the recipe here,(such as calories, fat, protein, and carbohydrates)." type="text" id="nutrition" name="nutrition" required><?php echo $nutrition; ?></textarea><br><br>

                <label for="keywords">
                    <h3>Keywords:</h3>
                </label><br>
                <textarea type="text" class="keywords" placeholder="Enter relevant keywords or tags that describthe recipe, separated by commas." id="keywords" name="keywords" required><?php echo $keywords; ?></textarea><br><br>

                <input type="submit" name="submit" class="submit" value="Modify">


            </div>
        </div>
    </form>
</body>

</html>
<?php require('footer.php'); ?>