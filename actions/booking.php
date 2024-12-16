<?php
include '../db/config.php'; // Make sure this is the correct path

session_start();
// Check if session values exist
$clientID = isset($_SESSION['userid']) ? $_SESSION['userid'] : null;
$cleanerID = isset($_SESSION['cleanerID']) ? $_SESSION['cleanerID'] : null;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customerName = $_POST['customerName'];
    $customerEmail = $_POST['customerEmail'];
    $bookingDate = $_POST['bookingDate'];
    $bookingTime = $_POST['bookingTime'];
    $bookingMessage = $_POST['bookingMessage'];
    
    // Check if serviceid is set in POST or GET
    $serviceId = isset($_POST['serviceid']) ? $_POST['serviceid'] : 
                 (isset($_GET['serviceid']) ? $_GET['serviceid'] : null);

        // Check if serviceid is set in POST or GET
    $clientId = isset($_POST['clientid']) ? $_POST['clientid'] : 
                 (isset($_GET['clientid']) ? $_GET['clientid'] : null);

                 $cleanerID = null;

                 // Check GET, POST, or SESSION for cleanerID
 // Check GET, POST, or SESSION for cleanerID
        $cleanerID = null;

        if ($cleanerID === null && isset($_POST['cleanerid'])) {
            $cleanerID = $_POST['cleanerid'];
        }

        // Detailed debugging
        // echo "Cleaner ID sources:<br>";
        // echo "GET cleanerid: " . (isset($_GET['cleanerid']) ? $_GET['cleanerid'] : 'Not set') . "<br>";
        // echo "POST cleanerid: " . (isset($_POST['cleanerid']) ? $_POST['cleanerid'] : 'Not set') . "<br>";
        // echo "SESSION cleanerID: " . (isset($_SESSION['cleanerID']) ? $_SESSION['cleanerID'] : 'Not set') . "<br>";
        // echo "Final cleanerID: " . ($cleanerID ? $cleanerID : 'Still null') . "<br>";

    // Validate that serviceid is not null
    if ($serviceId === null) {
        die("Error: Service ID is required");
    }

    // Assuming you have a valid database connection $conn
    $sql = "INSERT INTO bookings (clientID, cleanerID, ServiceID, customername, customeremail, bookingdate, bookingtime, bookingmessage)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Error preparing the query: " . $conn->error);
    }

    // Bind the parameters
    // Note: I changed $serviceid to $serviceId to match the variable name
    $stmt->bind_param("iiisssss", $clientID, $cleanerID, $serviceId, $customerName, $customerEmail, $bookingDate, $bookingTime, $bookingMessage);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Booking successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>