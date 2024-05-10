<?php session_start(); ?>
<?php require('connection.php'); ?>
<header>
    <link rel="stylesheet" href="headerStyles.css">
    <div class="all">
        <div class=upperHeader>
            <img src="https://i.pinimg.com/736x/b1/97/da/b197daf5f1cc7abf4948611468b6f745.jpg">
            <h1>FOODICTED</h1>
        </div>
        <nav class="nav">
            <ul>
                <li><a href="homepageL.php">Home</a></li>
                <?php
                if (strpos($_SESSION['email'], '@orms.admin') !== false) {
                    echo "<li><a href='Admin.php'>Admin Dashboard</a></li>";
                }
                ?>
                <li><a href="aboutUsL.php">About Us</a></li>
                <li><a href="recipespageL.php">Recipes</a></li>
                <li><a href="help.php">Help</a></li>
                <li><a href="userpage.php">Welcome <?php echo $_SESSION['first_name']; ?>! </a></li>
                <li><a href="logout.php">Log out</a></li>
            </ul>
        </nav>
    </div>
</header>