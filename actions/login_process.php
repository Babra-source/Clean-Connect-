<?php
// Include the database configuration file to connect to the database
include '../db/config.php';


error_reporting(E_ALL);
ini_set('display_errors', 1);


session_start();

// Check if the form was submitted using the POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Collect and trim form data to remove unnecessary whitespace
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Check if any required fields are empty
    if (empty($email) || empty($password)) {
        die('Please fill in all required fields.'); // Stop execution if any field is empty
    }

    // Prepare a statement to check if the email exists in the database
    $stmt = $conn->prepare('SELECT `userid`, `fname`, `email`, `password`, `role` FROM  `cleanusers` WHERE `email` = ?');
    $stmt->bind_param('s', $email); // Bind the email parameter to the query
    $stmt->execute(); // Execute the query
    $results = $stmt->get_result(); // Get the result of the query

    // Check if the email exists in the database
    if ($results->num_rows > 0) {
        $user = $results->fetch_assoc();

        // The code to verify the password
        if (password_verify($password, $user['password'])) {
            
            $_SESSION['userid'] = $user['userid'];
            $_SESSION['fname'] = $user['fname'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'Admin') {
                header('Location: ../view/admindashboard.php'); // Redirect to Admin dashboard
            } elseif ($user['role'] === 'Cleaner') {
                header('Location: ../view/CleanerDashboard.php'); // Redirect to cleaner dashboard
            } elseif ($user['role'] === 'Client') {
                header('Location: ../view/Dashboard.php'); // Redirect to default user dashboard
            }
            

        // } else {
        //     echo '<script>alert("Incorrect password. Please try again.");</script>';
        //     echo '<script>window.location.href = "../view/Login.php";</script>';
        // }
    } else {
        header('Location: ../view/Login.php');
    }
    }
    // Close the statement after execution
    $stmt->close();
}

// Close the database connection at the end
$conn->close();
?>

