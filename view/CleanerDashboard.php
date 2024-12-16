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
    header('Location: ../login.php');
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
    SELECT b.BookingID, b.BookingDate, b.ServiceID, b.customerName as CustomerName
    FROM bookings b
    JOIN cleanusers c 
    ON b.CleanerID = c.UserID
    WHERE b.CleanerID = ? AND b.Status = 'Scheduled'
    ORDER BY b.BookingDate ASC
    LIMIT 3
";

$bookingsStmt = $conn->prepare($bookingsQuery);
$bookingsStmt->bind_param("i", $userid);
$bookingsStmt->execute();
$bookingsResult = $bookingsStmt->get_result();
$upcomingBookings = $bookingsResult->fetch_all(MYSQLI_ASSOC);
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
                <li><a href="../view/index.php" class="nav-link">Homepage</a></li>
                <li><a href="../view/servicespage.php" class="nav-link">Cleaning Services Page</a></li>
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
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Upcoming Bookings</h5>
                    <?php if (!empty($upcomingBookings)): ?>
                        <ul class="list-unstyled">
                            <?php foreach ($upcomingBookings as $booking): ?>
                                <li class="mb-2">
                                    <strong><?php echo htmlspecialchars($booking['ServiceType']); ?></strong><br>
                                    Date: <?php echo htmlspecialchars(date('M d, Y', strtotime($booking['BookingDate']))); ?><br>
                                    Customer: <?php echo htmlspecialchars($booking['CustomerName']); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="card-text">No upcoming bookings at the moment.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card mb-5">
                <div class="card-body">
                    <h5 class="card-title">Service Stats</h5>
                    <ul class="list-unstyled">
                        <li>Total Services Completed: 
                            <?php echo isset($serviceStats['TotalServicesCompleted']) ? 
                                htmlspecialchars($serviceStats['TotalServicesCompleted']) : '0'; ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Table for Upcoming Booking Details -->
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Upcoming Booking Details</h5>
                    <?php if (!empty($upcomingBookings)): ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Service Type</th>
                                    <th>Booking Date</th>
                                    <th>Customer Name</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($upcomingBookings as $booking): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($booking['ServiceType']); ?></td>
                                        <td><?php echo htmlspecialchars(date('M d, Y', strtotime($booking['BookingDate']))); ?></td>
                                        <td><?php echo htmlspecialchars($booking['CustomerName']); ?></td>
                                        <td><?php echo htmlspecialchars($booking['Status']); ?></td>
                                        <td>
                                            <!-- Confirm Button -->
                                            <form action="booking_action.php" method="POST" class="d-inline-block">
                                                <input type="hidden" name="booking_id" value="<?php echo $booking['BookingID']; ?>">
                                                <button type="submit" name="action" value="confirm" class="btn btn-success btn-sm">Confirm</button>
                                            </form>
                                            <!-- Cancel Button -->
                                            <form action="booking_action.php" method="POST" class="d-inline-block">
                                                <input type="hidden" name="booking_id" value="<?php echo $booking['BookingID']; ?>">
                                                <button type="submit" name="action" value="cancel" class="btn btn-danger btn-sm">Cancel</button>
                                            </form>
                                            <!-- Finish Button -->
                                            <form action="booking_action.php" method="POST" class="d-inline-block">
                                                <input type="hidden" name="booking_id" value="<?php echo $booking['BookingID']; ?>">
                                                <button type="submit" name="action" value="finish" class="btn btn-primary btn-sm">Finish</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="card-text">No upcoming bookings at the moment.</p>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

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