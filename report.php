<?php
require('connection.php');

// Initialize form fields
$report_name = isset($_POST['report_name']) ? $_POST['report_name'] : '';
$category = isset($_POST['category']) ? $_POST['category'] : '';
$conclusion = isset($_POST['conclusion']) ? $_POST['conclusion'] : '';
$admin_id = isset($_POST['admin_id']) ? $_POST['admin_id'] : '';

// Check if the form is submitted
if (isset($_POST['save'])) {
    // Construct the SQL insert statement
    $sql = "INSERT INTO report (report_name, category, conclusion, admin_id) 
            VALUES ('$report_name','$category','$conclusion','$admin_id')";

    // Execute the query
    $result = mysqli_query($connection, $sql);

    if ($result) {
        // Display success message using JavaScript
        echo "<script>alert('Report successfully saved!');</script>";

        // Reset form fields
        $report_name = '';
        $category = '';
        $conclusion = '';
        $admin_id = '';

        // Redirect to admin.php after successful insertion
        header("Location: admin.php");
        exit(); // Ensure that subsequent code is not executed after redirection
    } else {
        // Display error message using JavaScript
        echo "<script>alert('Error saving report!');</script>";
    }
}
?>




<!DOCTYPE html>
<html>

<head>
    <title>Create Report</title>
    <link rel="stylesheet" type="text/css" href="reportformStyles.css">
</head>

<body>
    <div class="body">
        <div class="form-box">

            <br /><br />
            <div>
                <br /><br />
                <h2>Create Report</h2><br /><br />

                <form action="report.php" method="post">

                    Report Name<br />
                    <input type="text" class="inputs" name="report_name" id="r_name" placeholder="Report Name" required>
                    <br /><br /><br />
                    Category<br />
                    <input type="text" class="inputs" name="category" id="category" placeholder="Category" required>
                    <br /><br /><br />
                    Conclusion<br />
                    <textarea id="conclusion" class="inputarea" name="conclusion" placeholder="what is your opinion" row="3" cols="30" required></textarea>
                    <br /><br /><br />
                    Admin ID<br />
                    <input type="text" class="inputs" name="admin_id" id="admin_id" placeholder="Enter your Id" required>
                    <br /><br /><br />

                    <input type="reset" class="clear-info" value="Clear">
                    <button class="clear-info" id="savebtn" name="save">Save</button>

                </form>
            </div>

        </div>
    </div>

</body>

</html>
<?php require('footer.php') ?>