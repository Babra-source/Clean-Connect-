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

try {
    $statusQuery = "
        SELECT cleaners.status 
        FROM cleaners 
        INNER JOIN cleanusers ON cleanusers.UserID = cleaners.cleaner_id 
        WHERE cleanusers.UserID = ? 
    ";

    $stmt = $conn->prepare($statusQuery);
    if (!$stmt) {
        throw new Exception("Query preparation failed: " . $conn->error);
    }

    $stmt->bind_param("i", $userid);
    if (!$stmt->execute()) {
        throw new Exception("Query execution failed: " . $stmt->error);
    }

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $cleaner = $result->fetch_assoc();
        $accountStatus = $cleaner['status'];
    } else {
        $accountStatus = 'no_account';
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    $accountStatus = 'error';
}

$bookingsQuery = "
    SELECT b.BookingID, b.BookingDate, b.ServiceID, b.customerName as CustomerName, s.ServiceName 
    FROM bookings b
    JOIN cleanusers c 
    ON b.CleanerID = ? 
    JOIN services s ON b.ServiceID = s.ServiceID
    WHERE b.Status = 'Scheduled'
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
        .card-container {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .booking-card {
            width: 18rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .booking-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            display: flex;
            flex-direction: column;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .card-text {
            font-size: 1rem;
        }

        .booking-details {
            margin-top: 10px;
            font-size: 0.9rem;
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
            </ul>
        </nav>
    </header>

    <!-- Banner Image -->
    <div class="banner-container">
        <img src="../assets/images/background.jpg" alt="Cleaning Services Banner" class="banner-image">
    </div>

    <div class="container mt-5">
        <?php if ($accountStatus === 'UnderReview'): ?>
            <div class="alert alert-warning text-center" role="alert">
                <h2>Application Under Review</h2>
                <p>Your cleaner application is currently being reviewed by our team. We appreciate your patience.</p>
            </div>
        <?php elseif ($accountStatus === 'Approved'): ?>
            <div class="card-container">
                <?php if (!empty($upcomingBookings)): ?>
                    <?php foreach ($upcomingBookings as $booking): ?>
                        <div class="card booking-card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($booking['ServiceName']); ?></h5>
                                <p class="card-text">
                                    <strong>Client: </strong> <?php echo htmlspecialchars($booking['CustomerName']); ?>
                                </p>
                                <p class="card-text">
                                    <strong>Time: </strong> <?php echo htmlspecialchars(date('M d, Y h:i A', strtotime($booking['BookingDate']))); ?>
                                </p>
                                <div class="booking-details">
                                    <strong>Service Details:</strong>
                                    <ul>
                                        <li>Service: <?php echo htmlspecialchars($booking['ServiceName']); ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No upcoming bookings at the moment.</p>
                <?php endif; ?>
            </div>
        <?php elseif ($accountStatus === 'no_account'): ?>
            <div class="alert alert-danger text-center" role="alert">
                <h2>No Account Found</h2>
                <p>We couldn't find any account associated with your user ID. Please contact support if you believe this is an error.</p>
            </div>
        <?php else: ?>
            <div class="alert alert-danger text-center" role="alert">
                <h2>Account Issue</h2>
                <p>There seems to be a problem with your account. Please contact our support team.</p>
            </div>
        <?php endif; ?>
    </div>

    <footer class="text-center mt-5 py-4" style="background-color: #333; color: white;">
        <p>&copy; 2024 Cleaner Connect | All Rights Reserved</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
