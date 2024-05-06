
    //when click on report button visible the data and table
    function toggleReports() {
        var dynamicContent = document.getElementById("dynamicContent");
        var reportsContent = document.getElementById("reportsContent");
        
        if (dynamicContent.style.display === "none") {
            dynamicContent.style.display = "block";
            reportsContent.style.display = "none";
        } else {
            dynamicContent.style.display = "none";
            reportsContent.style.display = "block";
        }
    }

    function confirmDelete(report_no) {
        if (confirm("Are you sure you want to delete this report?")) {
            // Show and submit the delete form
            var formId = 'deleteForm_' + report_no;
            document.getElementById(formId).submit();
        }
    }

    function openModifyForm(reportNo) {
        // Create a form element
        var form = document.createElement('form');
        form.method = 'post';
        form.action = 'modifyReport.php';
    
        // Create an input field to store the report number
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'report_no';
        input.value = reportNo;
    
        // Append the input field to the form
        form.appendChild(input);
    
        // Append the form to the body
        document.body.appendChild(form);
    
        // Submit the form
        form.submit();
    }
    
    //footer change
    /*document.addEventListener("DOMContentLoaded", function() {
        // Get a reference to the report button
        var reportButton = document.getElementById("reportButton");
        
        // Initialize a flag variable to track the state of the button
        var isReportButtonClicked = false;
    
        // Add click event listener to the report button
        reportButton.addEventListener("click", function() {
            // Get a reference to the footer
            var footer = document.getElementById("footer");
    
            // Check the state of the button
            if (!isReportButtonClicked) {
                // Change the margin-top of the footer
                footer.style.marginTop = "40%"; // Adjust this value as needed
                
                // Update the flag variable to true
                isReportButtonClicked = true;
            } else {
                // Reset the margin-top of the footer to its original value
                footer.style.marginTop = ""; // Reset to default
                
                // Update the flag variable to false
                isReportButtonClicked = false;
            }
        });
    });*/

