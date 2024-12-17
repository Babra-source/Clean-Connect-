<?php
include '../db/config.php';
session_start();

// Enhanced error handling
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Validate session
if (!isset($_SESSION['userid'])) {
    error_log('Dashboard access attempted without valid user session');
    header('Location: ..view/login.php');
    exit();
}

$userid = $_SESSION['userid'];
$accountStatus = 'unknown';
$personName = '';

// Query to fetch first name
$userQuery = "
    SELECT fname 
    FROM cleanusers 
    WHERE UserID = ?
";

try {
    // Prepare and execute the user query
    $stmt = $conn->prepare($userQuery);
    if (!$stmt) {
        throw new Exception("Query preparation failed: " . $conn->error);
    }

    $stmt->bind_param("i", $userid);
    if (!$stmt->execute()) {
        throw new Exception("Query execution failed: " . $stmt->error);
    }

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $personName = $user['fname']; // Store the person's name
    } else {
        $personName = 'User'; // Default name if no result is found
    }

    // Query to fetch account status
    $statusQuery = "
        SELECT cleaners.status 
        FROM cleaners 
        INNER JOIN cleanusers ON cleanusers.UserID = cleaners.UserID
        WHERE cleanusers.UserID = ?
    ";

    // Prepare and execute the status query
    $stmt2 = $conn->prepare($statusQuery);
    if (!$stmt2) {
        throw new Exception("Query preparation failed: " . $conn->error);
    }

    $stmt2->bind_param("i", $userid);
    if (!$stmt2->execute()) {
        throw new Exception("Query execution failed: " . $stmt2->error);
    }

    $statusResult = $stmt2->get_result();
    if ($statusResult->num_rows > 0) {
        $status = $statusResult->fetch_assoc();
        $accountStatus = $status['status'];
    } else {
        $accountStatus = 'no_account'; // If no status is found, set it as 'no_account'
    }

} catch (Exception $e) {
    error_log($e->getMessage());
    $accountStatus = 'error'; // Handle errors gracefully
}

// Query to fetch upcoming bookings
$bookingsQuery = "
    SELECT COUNT(*) AS bookingCount, b.BookingID, b.ServiceId, b.BookingDate, b.customerName, s.serviceName,b.bookingMessage,b.customerEmail
    FROM bookings b
    JOIN services s ON b.ServiceId = s.ServiceId
    WHERE b.CleanerID = ?
    GROUP BY b.BookingID, b.ServiceId, s.serviceName
";



$query = "
    SELECT COUNT(*) AS bookingCount, BookingID, ServiceId, BookingDate, customerName 
    FROM bookings 
    WHERE CleanerID = ? 
    GROUP BY BookingID, Serviceid
";




// Fetch upcoming bookings
$bookingsStmt = $conn->prepare($query);
$bookingsStmt->bind_param("i", $userid);
$bookingsStmt->execute();
$bookingsResult = $bookingsStmt->get_result();

// Count the number of upcoming bookings
$upcomingBookingCount = $bookingsResult->num_rows;

// Fetch all rows as an associative array
$upcomingBookings = $bookingsResult->fetch_all(MYSQLI_ASSOC);


$bookingsStmt = $conn->prepare($bookingsQuery);
$bookingsStmt->bind_param("i", $userid);
$bookingsStmt->execute();
$bookingsResult = $bookingsStmt->get_result();

// Fetch all rows as an associative array
$bookingsData = $bookingsResult->fetch_all(MYSQLI_ASSOC);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clean Connect | Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <style>
        .banner-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        
    </style>
</head>
<body>
    <header>
        <div class="logo">
        <h1>Clean Connect</h1>
        </div>
        <nav>
            <ul>
                <li><a href="../view/ServicesPage.php" class="nav-link">Cleaning Services Page</a></li>
                <li><a href="../view/AboutPage.php" class="nav-link">About Page</a></li>
                <li><a href="../actions/logout.php" class="nav-link">Logout</a></li>
            </ul>
        </nav>
    </header>
        <!-- Banner Section -->
        <div class="banner-container">
            <img src="../assets/images/homepage1.jpg" alt="Cleaning Services Banner" class="banner-image">
            <h1>Welcome to Clean Connect, <?php echo $personName; ?>!</h1>
        </div>

    <div class="container mt-5">
        <?php if ($accountStatus === 'UnderReview'): ?>
            <div class="alert alert-warning text-center" role="alert">
                <h2>Application Under Review</h2>
                <p>Your cleaner application is currently being reviewed by our team. We appreciate your patience.</p>
                <p>Our team is carefully evaluating your profile to ensure the best quality of service for our customers.</p>
                <div class="mt-4">
                    <h4>What happens next?</h4>
                    <ul class="list-unstyled">
                        <li>✓ We're checking your credentials</li>
                        <li>✓ Verifying your background information</li>
                        <li>✓ Ensuring you meet our service standards</li>
                    </ul>
                </div>
                <p class="mt-3">
                    <strong>Estimated review time:</strong> 3-5 business days<br>
                    <small>Come back in 24 hours</small>
                </p>
            </div>

    <?php elseif ($accountStatus === 'Approved'): ?>
    <!-- Card to display the number of upcoming bookings -->
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="card-title">Upcoming Bookings</h5>
        </div>
        <div class="card-body">
            <p class="card-text"><?php echo $upcomingBookingCount; ?></strong> upcoming booking.</p>
        </div>
    </div>

    <!-- Table to display the details of upcoming bookings -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Booking Details</h5>
            <?php

    ?>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Service Name</th>
                        <th scope="col">Booking Date</th>
                        <th scope="col">Customer Name</th>
                        <th scope = "col"> Customer Email
                        <th scope="col">Booking Message</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    // Now loop through the data
                    if ($upcomingBookingCount > 0) {
                        foreach ($bookingsData as $booking) {
                            
                            $serviceID = isset($booking['serviceName']) ? htmlspecialchars($booking['serviceName']) : ''; // Correct key name
                            $bookingDate = isset($booking['BookingDate']) ? htmlspecialchars($booking['BookingDate']) : '';
                            $customerName = isset($booking['customerName']) ? htmlspecialchars($booking['customerName']) : '';
                            $customerEmail= isset($booking['customerEmail']) ? htmlspecialchars($booking['customerEmail']) : '';
                            $bookingMessage = isset($booking['bookingMessage']) ? htmlspecialchars($booking['bookingMessage']) : '';

                            echo "<tr>";
                            
                            echo "<td>" . $serviceID . "</td>";
                            echo "<td>" . $bookingDate . "</td>";
                            echo "<td>" . $customerName . "</td>";
                            echo "<td>" . $customerEmail . "</td>";
                            echo "<td>" . $bookingMessage . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='text-center'>No upcoming bookings</td></tr>";
                    }
                    ?>


                </tbody>
            </table>
        </div>
    </div>


         <?php elseif ($accountStatus === 'Rejected'): ?>
            <div class="alert alert-danger text-center" role="alert">
                <h2>Application Rejected</h2>
                <p>We're sorry to inform you that your cleaner application has been rejected.</p>
                <p>We value your interest in our services, but after reviewing your application, we believe it doesn't meet the requirements at this time.</p>
                <p>For more information or to appeal the decision, please contact us at support@cleanconnect.com.</p>
            </div>
        <?php elseif ($accountStatus === 'no_account'): ?>
            <div class="alert alert-danger text-center" role="alert">
                <h2>No Account Found</h2>
                <p>We couldn't find any account associated with your user ID. Please contact support if you believe this is an error.</p>
                <p>Contact: support@cleanconnect.com</p>
            </div>
        <?php else: ?>
            <div class="alert alert-danger text-center" role="alert">
                <h2>Account Issue</h2>
                <p>There seems to be a problem with your account. Please contact our support team.</p>
                <p>Current Status: <?php echo htmlspecialchars($accountStatus); ?></p>
                <p>Contact: support@cleanconnect.com</p>
            </div>
        <?php endif; ?>
    </div>

    <footer class="text-center mt-5 py-4" style="background-color: #333; color: white;">
        <p>&copy; 2024 Cleaner Connect | All Rights Reserved</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>