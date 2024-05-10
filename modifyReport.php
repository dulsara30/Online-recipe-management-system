<?php
require('connection.php');

// Retrieve report_no from URL parameter
$report_no = isset($_GET['report_no']) ? $_GET['report_no'] : '';

// Initialize other form fields (optional)
$report_name = '';
$category = '';
$conclusion = '';
$admin_id = '';

// Check if the form is submitted
if (isset($_POST['report_no'])) {
    // Retrieve form data
    $report_no = mysqli_real_escape_string($connection, $_POST['report_no']);
    $report_name = mysqli_real_escape_string($connection, $_POST['report_name']);
    $category = mysqli_real_escape_string($connection, $_POST['category']);
    $conclusion = mysqli_real_escape_string($connection, $_POST['conclusion']);
    $admin_id = mysqli_real_escape_string($connection, $_POST['admin_id']);

    // Update the database
    $query = "UPDATE report SET 
                report_name = '$report_name', 
                category = '$category', 
                conclusion = '$conclusion', 
                admin_id = '$admin_id' 
              WHERE report_no = '$report_no'";

    $result = mysqli_query($connection, $query);

    if ($result) {
        // Display success message using JavaScript
        echo "<script>alert('Report updated successfully!');</script>";

        // Redirect to Admin.php
        echo "<script>window.location.href = 'Admin.php';</script>";
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Modify Report</title>
    <link rel="stylesheet" type="text/css" href="reportformStyles.css">
</head>

<body>
    <div class="body">
        <div class="form-box">
            <form method="post" action="modifyReport.php" id="reportForm">
                <h2>Modify Report</h2>
                <br /><br /><br />
                <label for="report_name">Report Name:</label><br>
                <input type="text" name="report_name" id="report_name" class="inputs" value="<?php echo $report_name; ?>" required>
                <br /><br /><br />
                <label for="category">Category:</label><br>
                <input type="text" name="category" id="category" class="inputs" value="<?php echo $category; ?>" required>
                <br /><br /><br />
                <label for="conclusion">Conclusion:</label><br>
                <textarea id="conclusion" name="conclusion" class="inputarea" required><?php echo $conclusion; ?></textarea>
                <br /><br /><br />
                <label for="admin_id">Admin ID:</label><br>
                <input type="text" name="admin_id" id="admin_id" class="inputs" value="<?php echo $admin_id; ?>" required>
                <br /><br /><br />
                <input type="hidden" name="report_no" value="<?php echo $report_no; ?>">
                <input type="submit" name="modifybtn" class="clear-info" value="Save">
            </form>
        </div>
    </div>
</body>

</html>
<?php require('footer.php') ?>