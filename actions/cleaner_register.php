<?php

ob_start();
include '../db/config.php';  // Ensure the path is correct

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Collect and trim form data
    $fname = trim($_POST['firstname']);
    $lname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $phone_number = trim($_POST['phone_number']);  // Phone number for cleaners
    $address = trim($_POST['address']);  // Address for cleaners
    $experience = $_POST['experience'];  // Experience for cleaners
    $service =  $_POST['service'];
    $bio = trim($_POST['bio']);  // Bio for cleaners

    // Check if any required fields are empty
    if (empty($fname) || empty($lname) || empty($email) || empty($password) || empty($confirm_password) || empty($phone_number) || empty($address) || empty($experience)  ||empty($service) ) {
        die('Please fill in all required fields.');
    }

    // Check if password and confirm password match
    if ($confirm_password != $password) {
        die('Passwords do not match.');
    }

    // Prepare a statement to check if the email is already registered
    $stmt = $conn->prepare('SELECT email FROM cleanusers WHERE email = ?');
    $stmt->bind_param('s', $email);  // Bind the email parameter
    $stmt->execute();  // Execute the query
    $results = $stmt->get_result();  // Get the result

    // Check if the email already exists in the database
    if ($results->num_rows > 0) {
        echo '<script>alert("User already registered.");</script>';
        echo '<script>window.location.href = "../view/cleanerterms.php";</script>';
    } else {
        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);


        // Insert the user into the `cleanusers` table
        $sql = "INSERT INTO cleanusers (fname, lname, email, password, role, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())";
        $stmt = $conn->prepare($sql);
        $role = 2;  // Assuming 3 is the role for cleaners
        $stmt->bind_param('ssssi', $fname, $lname, $email, $hashed_password, $role);

        // Execute the statement and check if it was successful
        if ($stmt->execute()) {
            // Get the last inserted user_id (the auto-generated ID)
            $user_id = $stmt->insert_id;

            $status = 'underReview'; // You can adjust this based on your application's logic
            // Now insert the cleaner-specific details into the `cleaners` table
            $sql_cleaner = "INSERT INTO cleaners (userid, phone_number, address, experience,service, bio) VALUES (?, ?, ?, ?,?, ?)";
            $stmt_cleaner = $conn->prepare($sql_cleaner);
            $stmt_cleaner->bind_param('isssss', $user_id, $phone_number, $address, $experience,$service, $bio);

            if ($stmt_cleaner->execute()) {
                // Redirect to the login page after successful insertion
                $_SESSION['fname'] = $fname;
                header('Location: ../view/login.php');
            } else {
                // If cleaner insertion failed, redirect to signup page
                echo '<script>alert("Error adding cleaner details.");</script>';
                header('Location: ../view/cleanerterms.php');
            }

            // Close the cleaner statement
            $stmt_cleaner->close();

        } else {
            // If user insertion failed, redirect to signup page
            echo '<script>alert("Error adding user details.");</script>';
            header('Location: ../view/cleanerterms.php');
        }
    }

    // Close the initial statement
    $stmt->close();
}

// Close the database connection
$conn->close();

?>
