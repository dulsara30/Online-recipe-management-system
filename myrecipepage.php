<?php require('connection.php'); ?>
<?php require('headerL.php'); ?>

<?php

if (!isset($_SESSION['user_id'])) {
    header('Location: homepage.php');
}

$user_id = $_SESSION['user_id'];

$recipe_list = '';
$search = '';

$query = "SELECT recipe_id, recipe_name, recipe_img FROM recipes WHERE user_id = {$user_id}";


if (isset($_GET['search'])) {

    $search = mysqli_real_escape_string($connection, $_GET['search']);
    $query = "SELECT * FROM recipes WHERE (keywords LIKE '%{$search}%' OR recipe_name LIKE '%{$search}%')";
} else {
    $query = "SELECT recipe_id, recipe_name, recipe_img FROM recipes WHERE user_id = {$user_id}";
}

$recipes = mysqli_query($connection, $query);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="recipespage.css">
    <title>
        Online Recipe Management System
    </title>
    <link rel="website icon" type="jpg" href="https://i.pinimg.com/736x/b1/97/da/b197daf5f1cc7abf4948611468b6f745.jpg">
</head>

<body>

    <div class="recipes">
        <h1>
            <center>My Recipes</center>
        </h1>
        <div class="recipesearch">



            <form action="recipespage.php" method="get">
                <p>
                    <input class="input" type="text" name="search" placeholder="Search for Your Recipe..." value="<?php echo $search ?>">
                </p>

            </form>
            <!--<input class="search" type="search" action="recipespage.php" value="Search">-->
        </div>
        <!--  <label class="vegnonveg">
            <input type="radio" name="veg" value="veggie">
            <span class="checkmark"></span>
            Veggie
        </label>
        <label class="vegnonveg">
            <input type="radio" name="veg" value="nonVeggie">
            <span class="checkmark"></span>
            Non-Veggie
        </label>-->



        <div class="recipesfurther">

            <?php

            if ($recipes) {
                while ($recipe = mysqli_fetch_assoc($recipes)) {
                    echo '<div class="div">';
                    echo '<img src=" ' . $recipe["recipe_img"] . '">';
                    echo '<p class="recipename"> ' . $recipe["recipe_name"] . '</p>';
                    echo '<a href ="editrecipe.php?recipe_id=' . $recipe["recipe_id"] . '"><h1 class="viewrecipe">Edit Recipe</h1></a>';
                    echo '</div>';
                }
            } else {
                echo "Database query faild.";
            }

            ?>


        </div>
    </div>
</body>

</html>
<?php require('footer.php'); ?>