<?php require('connection.php'); ?>
<?php require('header.php'); ?>

<?php





$recipe_list = '';
$search = '';

if (isset($_GET['veg'])) {
    $radio = mysqli_real_escape_string($connection, $_GET['veg']);
    $query = "SELECT * FROM recipes WHERE (vegetarian = 'veg') ";
} else if (isset($_GET['veg'])) {
    $radio = mysqli_real_escape_string($connection, $_GET['veg']);
    $query = "SELECT * FROM recipes WHERE (vegetarian = 'non') ";
} else {
    $query = "SELECT recipe_id, recipe_name, recipe_img FROM recipes";
}

if (isset($_GET['search'])) {

    $search = mysqli_real_escape_string($connection, $_GET['search']);
    $query = "SELECT * FROM recipes WHERE (keywords LIKE '%{$search}%' OR recipe_name LIKE '%{$search}%')";
} else {
    $query = "SELECT recipe_id, recipe_name, recipe_img FROM recipes";
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
    <script src="recipespage.js" type="script"></script>
</head>

<body>
    <div class="recipes">

        <div class="recipesearch">

            <form action="recipespage.php" method="get">
                <p>
                    <input class="input" type="text" name="search" placeholder="Search for Your Recipe..." value="<?php echo $search ?>">
                </p>

            </form>
            <!--<input class="search" type="search" action="recipespage.php" value="Search">-->
        </div>
        <!--<label class="vegnonveg">
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
                    echo '<a href ="login.php">';
                    echo '<h1 class="viewrecipe">View Recipe</h1></a>';
                    echo '</div>';
                }
            } else {
                echo "Database query faild.";
            }

            ?>
            <!-- <div class="div">

                <img src="https://i.pinimg.com/564x/82/05/fd/8205fd00651a6520465f93dd4f488c0b.jpg">
                <p class="recipename"> Spaghetti Carbonara</p>
                <button class="viewrecipe" >View Recipe</button>
                <h1 class="viewrecipe"> View Recipe</h1>
            </div>
            <div class="div">

                <img src="https://i.pinimg.com/564x/5e/67/3a/5e673ac6df94319aed7046ee13aeda10.jpg">
                <p class="recipename"> Milk Rice</p>
                <button class="viewrecipe" >View Recipe</button>
                <h1 class="viewrecipe"> View Recipe</h1>
            </div>
            <div class="div">

                <img src="https://i.pinimg.com/564x/7b/1a/eb/7b1aeb3356b5336215c1e4baedddbb0a.jpg">
                <p class="recipename">Sushi</p>
                <button class="viewrecipe" >View Recipe</button>
                <h1 class="viewrecipe"> View Recipe</h1>
            </div>
            <div class="div">

                <img src="https://i.pinimg.com/564x/20/d3/ad/20d3ad09c151b0e1297b8d0b4c01065c.jpg">
                <p class="recipename">Fish'n Chips</p>
                <button class="viewrecipe" >View Recipe</button>
                <h1 class="viewrecipe"> View Recipe</h1>
            </div>
            <div class="div">

                <img src="https://i.pinimg.com/564x/c6/65/c7/c665c758a0b5d5a6a93db951d11124d1.jpg">
                <p class="recipename">Chicken Tikka Masala</p>
                <button class="viewrecipe" >View Recipe</button>
                <h1 class="viewrecipe"> View Recipe</h1>
            </div>
            <div class="div">

                <img src="https://i.pinimg.com/564x/74/ba/14/74ba14fafefdf61cd6b12d7a9322b12c.jpg">
                <p class="recipename">Tacos</p>
                <button class="viewrecipe" >View Recipe</button>
                <h1 class="viewrecipe"> View Recipe</h1>
            </div>
            <div class="div">

                <img src="https://i.pinimg.com/736x/c6/36/14/c63614e44aa3a73069ca51e6bbe70c12.jpg">
                <p class="recipename">Tom Yum Goong</p>
                <button class="viewrecipe" >View Recipe</button>
                <h1 class="viewrecipe"> View Recipe</h1>
            </div>
            <div class="div">

                <img src="https://i.pinimg.com/564x/79/e6/a5/79e6a5f274d2479eb245415ab910a807.jpg">
                <p class="recipename">Hamburger</p>
                <button class="viewrecipe" >View Recipe</button>
                <h1 class="viewrecipe"> View Recipe</h1>
            </div>
            <div class="div">

                <img src="https://i.pinimg.com/564x/26/1f/c0/261fc0ab7ac8d7d71bbd18656303c734.jpg">
                <p class="recipename">Paella</p>
                <button class="viewrecipe" >View Recipe</button>
                <h1 class="viewrecipe"> View Recipe</h1>
            </div>
            <div class="div">

                <img src="https://i.pinimg.com/564x/41/07/1a/41071aedf02001f545e72401f7e6246e.jpg">
                <p class="recipename">Hummus</p>
                <button class="viewrecipe" >View Recipe</button>
                <h1 class="viewrecipe"> View Recipe</h1>
            </div>
            <div class="div">

                <img src="https://i.pinimg.com/564x/81/c5/cc/81c5cca10c44eb65f1251da5ea8825f4.jpg">
                <p class="recipename">Feijoada</p>
                <button class="viewrecipe" >View Recipe</button>
                <h1 class="viewrecipe"> View Recipe</h1>
            </div>
            <div class="div">

                <img src="https://i.pinimg.com/564x/34/ae/84/34ae84c8cfeb4325b41caf0dce524470.jpg">
                <p class="recipename">Bratwurst</p>
                <button class="viewrecipe" >View Recipe</button>
                <h1 class="viewrecipe"> View Recipe</h1>
            </div>-->

        </div>
    </div>
</body>

</html>
<?php require('footer.php'); ?>