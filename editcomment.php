<?php require('connection.php') ?>
<?php require('header.php') ?>

<?php

if (isset($_GET['comment_Id'])) {
    $comment_Id = mysqli_real_escape_string($connection, $_GET['comment_Id']);

    // Fetch the comment from the database
    $query = "SELECT * FROM comments WHERE comment_Id = '{$comment_Id}'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $comment = mysqli_fetch_assoc($result);
        $message = $comment['comment'];
    } else {
        // Comment not found
        echo "Comment not found!";
        exit();
    }
} else {
    // No comment Id provided
    echo "No comment Id provided!";
    exit();
}

// Handle comment update
if (isset($_POST['updateComment'])) {
    $newMessage = mysqli_real_escape_string($connection, $_POST['newMessage']);

    // Update the comment in the database
    $query = "UPDATE comments SET comment = '{$newMessage}' WHERE comment_Id = '{$comment_Id}'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        echo "<script>alert('Comment updated successfully!');</script>";
        // Redirect to the page where the comment was displayed
        header("Location: recipedetailspagec.php?recipe_id={$comment['recipe_id']}");
        exit();
    } else {
        echo "Error updating comment: " . mysqli_error($connection);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Comment</title>
</head>

<body>
    <h2>Edit Comment</h2>
    <form method="post" action="">
        <textarea name="newMessage"><?php echo $message; ?></textarea><br>
        <button type="submit" name="updateComment">Update Comment</button>
    </form>
</body>

</html>
<?php require('footer.php'); ?>