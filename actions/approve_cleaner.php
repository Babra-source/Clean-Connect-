<?php
// Include the database connection file to ensure $conn is available
include '../db/config.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if cleaner_id is set in the POST request
    if (isset($_POST['cleaner_id'])) {
        // Get the selected status from the form
        $status = $_POST['status'];

        // Get the cleaner_id from the hidden input field
        $cleaner_id = $_POST['cleaner_id'];

        // Prepare the SQL query to update the status
        $updateQuery = "UPDATE cleaners SET status = ? WHERE cleaner_id = ?";
        $stmt = $conn->prepare($updateQuery);  // $conn should be defined from config.php
        $stmt->bind_param("si", $status, $cleaner_id);

        // Execute the query
        if ($stmt->execute()) {
            echo "Status updated successfully!";
        } else {
            echo "Error updating status.";
        }
    } else {
        echo "Error: Cleaner ID is missing.";
    }
}
?>
