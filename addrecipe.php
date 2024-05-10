<?php require('connection.php'); ?>
<?php require('headerL.php'); ?>
<?php

require_once "connection.php";


//$category = array('Appetizers', 'Soups and Salads', 'Main Dishes', 'Side Dishes', 'Breakfast', 'Brunch', 'Lunch', 'Dinner', 'Desserts', 'Beverages', 'Snacks');
$categories = array();
$errors = array();
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

if (isset($_POST['submit'])) {

    //checking whether the fields are empty
    $reqfield = array('recipe_name', 'recipe_img', 'vegetarian', 'prep_time', 'cook_time', 'servings', 'ingredients', 'process', 'nutrition', 'keywords');

    foreach ($reqfield as $field) {
        if (empty(trim($_POST[$field]))) {

            $errors[] = $field . ' is required';
        }
    }

    //recipe name length checking
    if (strlen(trim($_POST['recipe_name'])) > 100) {

        $errors[] = 'recipe_name must be less than 100 charactors';
    }

    //if recipe name already exist
    $recipe_name = mysqli_real_escape_string($connection, $_POST['recipe_name']);
    $query = "SELECT * FROM recipes WHERE recipe_name = '{$recipe_name}' LIMIT 1";

    $result = mysqli_query($connection, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $errors[] = 'Recipe name already exists';
        }
    }



    $recipe_name = $_POST['recipe_name'];
    $recipe_img = $_POST['recipe_img'];
    $vegetarian = $_POST['vegetarian'];
    $prep_time = $_POST['prep_time'];
    $cook_time = $_POST['cook_time'];
    $servings = $_POST['servings'];
    $ingredients = $_POST['ingredients'];
    $process = $_POST['process'];
    $nutrition = $_POST['nutrition'];
    $keywords = $_POST['keywords'];



    $category = $_POST["category"];
    $categories = array();
    foreach ($category as $row) {
        $categories[] = $row;
    }


    if (empty($errors)) {

        $serialized_categories = serialize($categories);

        $user_id = $_SESSION['user_id'];

        // Construct the SQL INSERT statement
        $sql = "INSERT INTO recipes (recipe_name, recipe_img, vegetarian, categories, prep_time, cook_time, servings, ingredients, process, nutrition, keywords, user_id)
        VALUES ('$recipe_name', '$recipe_img', '$vegetarian', '$serialized_categories', '$prep_time', '$cook_time', '$servings', '$ingredients', '$process', '$nutrition', '$keywords', '$user_id')";


        //mysqli_query($connection, $sql);
        $result = mysqli_query($connection, $sql);

        if ($result) {
            echo "<script>alert('Recipe added successfully!');</script>";
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
        } else {
            echo "Eroor: " . mysqli_error($connection);
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
        <center>Add a New Recipe</center>
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

    <form action="addrecipe.php" method="post">
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
                <label for="vegetarian_yes" class="vegnonveg"><input type="radio" id="vegetarian_yes" name="vegetarian" value="veg" required><span class="checkmark"></span> Yes</label>
                <label for="vegetarian_no" class="vegnonveg"><input type="radio" id="vegetarian_no" name="vegetarian" value="non" required><span class="checkmark"></span> No</label><br><br>
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

                <input type="submit" name="submit" class="submit" value="Submit">


            </div>
        </div>
    </form>
</body>

</html>
<?php require('footer.php'); ?>