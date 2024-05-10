<?php require('connection.php') ?>

<?php

$errors = array();
$first_name = '';
$last_name = '';
$email = '';
$dob = '';
$gender = '';
$password = '';
$confirmPwd = '';


if (isset($_POST['submit'])) {


  $email = mysqli_real_escape_string($connection, $_POST['email']);
  $query = "SELECT * FROM registered_user WHERE email = '{$email}'";

  $result = mysqli_query($connection, $query);

  if ($result) {
    if (mysqli_num_rows($result) == 1) {
      $errors[] = 'Email aleady exists!';
    }
  }

  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $dob = $_POST['dob'];
  $gender = $_POST['gender'];
  $password = $_POST['password'];
  $confirmPwd = $_POST['confirmPwd'];

  if ($password !== $confirmPwd) {
    $errors[] = 'Invalid  Confirm Password!';
  }




  if (empty($errors)) {


    $sql = "INSERT INTO registered_user(first_name, last_name, email, user_pwd, dob, gender) 
  VALUES ('$first_name','$last_name','$email','$password','$dob','$gender')";


    $result = mysqli_query($connection, $sql);


    if ($result) {
      echo "<script>alert('Registration successfull!'); window.location.href='login.php';</script>";
    } else {
      echo "Eroor: " . mysqli_error($connection);
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width-device-width, initial-scale=1.0">
  <title>Sign up</title>
  <link rel="stylesheet" href="registerstyle.css">
</head>

<body>



  <!--------Navigation bar-------->
  <header>
    <nav class="nav">
      <ul>
        <li><a href="homepage.php">Home</a></li>
        <li><a href="aboutUs.php">About Us</a></li>
        <li><a href="recipespage.php">Recipes</a></li>
        <li><a href="help.php">Help</a></li>
        <li><a href="login.php">Login</a></li>
      </ul>
    </nav>

  </header>

  <!--displaying all errors-->
  <?php
  if (!empty($errors)) {
    echo '<div class="errors" >';
    foreach ($errors as $error) {
      echo $error . '<br>';
    }
    echo '</div>';
  }

  ?>

  <!-----------------------------------------------Form---------------------------------------------------------------->
  <div class="Wrapper">
    <div class="inner">
      <div class="image-holder">
        <img src="https://i.pinimg.com/736x/a9/2e/da/a92edaabf9d119368f7c04e810e6086a.jpg" alt="image">
      </div>

      <form action="" method="post">
        <h2> Sign Up</h2>

        <div class="form-group">
          <input type="text" placeholder="First Name" class="form-control" name='first_name' required>
          <input type="text" placeholder="Last Name" class="form-control" name='last_name' required>
        </div>

        <div class="form-wrapper">
          <input type="email" placeholder="Email Address" class="form-control" name="email" required>
        </div>

        <div class="form-wrapper">
          <input type="date" placeholder="Date of Birth" class="form-control" name="dob" required>
        </div>

        <div class="form-wrapper">
          <label for="Male" class="Gender"><input type="radio" id="male" name="gender" value="male" required><span class="checkmark"></span> Male</label>
          <label for="Female" class="Gender"><input type="radio" id="female" name="gender" value="female" required><span class="checkmark"></span> Female</label>
          <label for="Other" class="Gender"><input type="radio" id="other" name="gender" value="other" required><span class="checkmark"></span> Other</label><br><br>
        </div>

        <div class="form-wrapper">
          <input type="password" placeholder="Password" class="form-control" name="password" required>
        </div>

        <div class="form-wrapper">
          <input type="password" placeholder="Confirm Password" class="form-control" name="confirmPwd" required>
        </div>
        <input type="submit" name="submit" value="Sign Up" class="submit">

      </form>
    </div>
  </div>




</body>

</html>
<?php require('footer.php') ?>