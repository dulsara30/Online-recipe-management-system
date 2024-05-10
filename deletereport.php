<?php
require('connection.php'); // Include your database connection file

if (isset($_POST['report_no'])) {
    $report_no = $_POST['report_no'];

    // Perform the deletion operation
    $sql = "DELETE FROM report WHERE report_no = $report_no";

    if ($connection->query($sql) === TRUE) {
        echo "Record deleted successfully";

        // Redirect to the admin page after successful deletion
        header("Location: Admin.php");
        exit(); // Ensure that subsequent code is not executed after redirection
    } else {
        echo "Error deleting record: " . $connection->error;
    }
} else {
    echo "Report number not provided";
}

// Close the database connection
$connection->close();
