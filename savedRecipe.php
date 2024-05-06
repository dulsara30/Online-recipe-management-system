<?php require('connection.php'); ?>
<?php
require('headerL.php');
?>
<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: homepage.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>
        Saved Recipes
    </title>
    <link rel="stylesheet" href="savedRecipe.css">
</head>

<body>
    <p class="topic">SAVED RECIPES</p>
    <p class="description">Welcome to your saved recipes! Here, you can easily
        browse through all the recipes you've saved. Whether it's your go-to comfort food,
        a special dish for celebrations, or something you're eager to try next, your saved recipes are
        all conveniently located here for quick access whenever you need them.</p>
    <div class="container">
        <div class="scrollable">
            <h2>HEALTHY CHOICES</h2>
            <img src="https://i.pinimg.com/564x/17/4a/86/174a861e5d217e86a7dace4757d510e7.jpg">
            <img src="https://i.pinimg.com/564x/f2/16/f0/f216f08940e8370d07f2295285a952df.jpg">
            <img src="https://i.pinimg.com/564x/74/18/7c/74187ca93d84f03250ad41ad91151bcd.jpg">
            <img src="https://i.pinimg.com/564x/21/d0/6e/21d06e739f90d39e88ce848050f4d8dc.jpg">
        </div>
        <div class="scrollable">
            <h2>DESERTS</h2>
            <img src="https://i.pinimg.com/564x/26/d5/62/26d5621af627b3c59a7d78a236300f60.jpg">
            <img src="https://i.pinimg.com/564x/e9/6b/00/e96b00848e08852b9ef59a400bdfaac3.jpg">
            <img src="https://i.pinimg.com/564x/36/28/64/362864c76b8a92db81f7fa50ca37485a.jpg">
            <img src="https://i.pinimg.com/564x/f9/22/69/f922695f0fa750623b39848a43e21832.jpg">
            <img src="https://i.pinimg.com/564x/17/25/fb/1725fbd45b2aba1a0f4fe3893350d082.jpg">
        </div>
        <div class="scrollable">
            <h2>BRUNCH OPTIONS</h2>
            <img src="https://i.pinimg.com/564x/64/34/f6/6434f68f275d27c7b44697dc1c1ff813.jpg">
            <img src="https://i.pinimg.com/564x/3d/d9/66/3dd96608725712b19471d3f60eb3a823.jpg">
            <img src="https://i.pinimg.com/564x/4f/c8/e0/4fc8e054d4323e8670bf75636878c614.jpg">
            <img src="https://i.pinimg.com/564x/ce/54/22/ce54228bbb932c0cdf0203fafb2a3d6a.jpg">
            <img src="https://i.pinimg.com/564x/e0/c5/b5/e0c5b5ee8e4c56894a8550da6c789d73.jpg">
        </div>
        <div class="scrollable">
            <h2>INDIAN SNACKS</h2>
            <img src="https://i.pinimg.com/736x/ca/ff/3a/caff3ac071141bdfd64b84e6e96950d4.jpg">
            <img src="https://i.pinimg.com/564x/eb/4f/39/eb4f39f9dd0d81f2b1f2525b30c1ce78.jpg">
            <img src="https://i.pinimg.com/236x/47/89/7f/47897f8a800f5ad65fe82b93514c35fd.jpg">
            <img src="https://i.pinimg.com/564x/cf/2d/4e/cf2d4ee672dc154d019dfda53691be34.jpg">

        </div>
    </div>

</body>

</html>
<?php
require('footer.php')
?>