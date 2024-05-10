<?php require('connection.php');
require('headerL.php') ?>
<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: homepage.php');
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>
        ADMIN DASHBOARD
    </title>
    <link rel="stylesheet" href="AdminStyles.css">
    <script src="AdminScript.js"></script>

</head>

<body>


    <div class="container">
        <div class="sidebar">
            <img src="https://i.pinimg.com/564x/78/e6/da/78e6da2f7643589b461a800ab1afee0e.jpg">
            <h2>Admin Dashboard</h2>

            <ul>
                <li><a href="homepageL.php"> <button class="sidebarbtn">Home</button></a></li>
                <li><button class="sidebarbtn">Recipe Management</button></li>
                <li><button class="sidebarbtn">Backup and Restore</button></li>
                <li id="reportItems">
                    <button id="reportButton" name="reportButton" class="sidebarbtn" onclick="toggleReports()">Reports</button>
                </li>
                <li><button class="sidebarbtn">Settings</button></li>
                <li><a href="logout.php"><button class="sidebarbtn">Logout</button></a></li>
            </ul>

            <div class="box">
                <p class="end">version 12.5<br>powered by sigmaZ</p>
            </div>

        </div>
    </div>

    <div class="content" id="dynamicContent">
        <p>Welcome to the admin dashboard.<br><br>As an administrator, you have access to powerful tools and features to manage and oversee various aspects of our system.
            From recipe management to security protocols, this dashboard provides you with the control and insights you need to keep everything running smoothly.Stay informed, stay organized, and make informed
            decisions with the comprehensive tools available at your fingertips. Explore the menu on the left to navigate through different sections and functionalities.
            If you have any questions or need assistance, don't hesitate to reach out to our support team. Thank you for your dedication and commitment to maintaining our system's integrity and efficiency.</p>

        <img src="https://i.pinimg.com/564x/96/dc/b4/96dcb4fbfc478cb6e1759d4f773d978c.jpg">

    </div>

    <div id="reportsContent">
        <h2>WHAT I CREATE</h2>

        <div class="createReport">
            <form action="report.php">
                <button type="submit">Create Report</button>
            </form>
        </div>

        <br><br><br>

        <table id="reportTable">
            <thead>
                <tr>
                    <th>Report NO</th>
                    <th>Report Name</th>
                    <th>Category</th>
                    <th>Conclusion</th>
                    <th>Admin ID</th>
                    <th>Action</th>
                    <th>Action</th>
                </tr>
            </thead>


            <?php

            $sql = "SELECT * FROM report";
            $result = $connection->query($sql);

            // Check if there are any rows returned
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["report_no"] . "</td>";
                    echo "<td>" . $row["report_name"] . "</td>";
                    echo "<td>" . $row["category"] . "</td>";
                    echo "<td>" . $row["conclusion"] . "</td>";
                    echo "<td>" . $row["admin_id"] . "</td>";

                    // Add buttons for Modify and Delete actions

                    echo "<td><form method='get' action='modifyReport.php'>
                    <input type='hidden' name='report_no' value='" . $row["report_no"] . "'>
                    <button type='submit' class='actionbtn'>Modify</button> </form></td>";



                    echo "<td><button class='actionbtn' onclick='confirmDelete(" . $row["report_no"] . ")'>Delete</button></td>";

                    echo "<form id='deleteForm_" . $row["report_no"] . "' method='post' action='deletereport.php' style='display: none;'>
                        <input type='hidden' name='report_no' value='" . $row["report_no"] . "'>
                        
                  </form>";

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No results</td></tr>";
            }
            // Close the database connection
            $connection->close();
            ?>


        </table>
    </div>
</body>

</html>