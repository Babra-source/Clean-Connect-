<?php

ob_start();
include '../db/config.php';  // Change the backslash to a forward slash



// Enable error reporting to display errors for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Collect and trim form data to remove unnecessary whitespace
    $fname = trim($_POST['firstname']);
    $lname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    

    // Check if any required fields are empty
    if (empty($fname) ||empty($lname)|| empty($email) || empty($password) || empty($confirm_password)) {
        die('Please fill in all required fields.'); // Stop execution if any field is empty
    }

    // Check if password and confirm password match
    if ($confirm_password != $password) {
        die('Passwords do not match.'); // Stop execution if passwords do not match
    }

    // Prepare a statement to check if the email is already registered in the database
    $stmt = $conn->prepare('SELECT email FROM cleanusers WHERE email = ?');
    $stmt->bind_param('s', $email); // Bind the email parameter to the query
    $stmt->execute(); // Execute the query
    $results = $stmt->get_result(); // Get the result of the query

    // Check if the email already exists in the database
    if ($results->num_rows > 0) {
        echo '<script>alert("User already registered.");</script>';

        echo '<script>window.location.href = "../view/signup.php";</script>';

        echo '<script>window.location.href = "signup.php";</script>';

    } else {
        // Hash the password for security before storing it in the database
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Prepare an INSERT statement to add the new user to the database
        $sql = "INSERT INTO cleanusers (fname, lname, email, password, role, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())";
        $stmt = $conn->prepare($sql);
        $role = 3; // Artisans and Viewers
               // Corrected the bind_param variables to match the prepared statement parameters
        $stmt->bind_param('ssssi', $fname, $lname, $email, $hashed_password, $role);

        // Execute the statement and check if it was successful
        if ($stmt->execute()) {
            $_SESSION['fname'] = $firstName;
            header('Location: ../view/login.php'); // Redirect to the login page if successful
        } else {
            header('Location: ../view/signup.php'); 
        }
    }

    // Close the statement after execution
    $stmt->close();
}

// Close the database connection at the end
$conn->close();

?>