<?php
session_start();

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
}

if (isset($_SESSION['userid'])) {
    $userId = $_SESSION['userid'];

    include('../db/config.php');

    // Query to count upcoming and past bookings
    $queryUpcoming = "SELECT COUNT(*) AS upcoming_count 
                      FROM bookings 
                      WHERE bookingdate >= CURDATE() AND status = 'Pending' AND clientid = '$userId'";

    $resultUpcoming = mysqli_query($conn, $queryUpcoming);


    $upcomingCount = mysqli_fetch_assoc($resultUpcoming)['upcoming_count'];

    $queryPast = "SELECT COUNT(*) AS past_count 
                  FROM bookings 
                  WHERE bookingdate < CURDATE() AND  status = 'Completed' AND  clientid = '$userId'";
    $resultPast = mysqli_query($conn, $queryPast);
    $pastCount = mysqli_fetch_assoc($resultPast)['past_count'];

    // Query to fetch the recent booking activities including cleaner information
    $queryActivities = "SELECT 
                    b.BookingDate, 
                    b.Status,
                    cu.fname AS cleaner_fname,
                    cu.lname AS cleaner_lname,
                    s.ServiceName AS service
                FROM 
                    bookings b
                LEFT JOIN 
                    cleanusers cu ON b.CleanerID = cu.UserID
                JOIN 
                    services s ON b.ServiceID = s.ServiceID
                WHERE 
                    b.ClientID = '$userId'
                ORDER BY 
                    b.BookingDate"; // Limit to 6 most recent bookings
    $resultActivities = mysqli_query($conn, $queryActivities);
    $recentActivities = mysqli_fetch_all($resultActivities, MYSQLI_ASSOC);
} else {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<header>
    <div class="logo">
        <h1>Clean Connect</h1>
    </div>
    <nav>
        <ul>
            <li><a href="../view/ServicesPage.php" class="nav-link">Services Page</a></li>
            <li><a href="view/About.php" class="nav-link">About Page</a></li>
            <li><a href="../actions/logout.php" class="nav-link">Logout </a></li>
            
        </ul>
    </nav>
</header>

<main class="dashboard-main">
    <!-- Stats Section -->
    <section class="dashboard-stats">
        <div class="stat-card">
            <i class="fas fa-calendar-check"></i>
            <h3>Current Bookings</h3>
            <p><?php echo $upcomingCount; ?> Bookings</p>
        </div>
    </section>

    <!-- Recent Activities Section -->
    <section class="dashboard-activities">
        <h2>Recent Booking Activities</h2>
        <div class="row">
            <?php if (empty($recentActivities)): ?>
                <p>No recent bookings found.</p>
            <?php else: ?>
                <?php foreach ($recentActivities as $activity): ?>
                    <div class="col-md-4">
                        <div class="activity-card">
                            <div class="activity-icon">
                                <i class="fas fa-calendar-day"></i>
                            </div>
                            <div class="activity-details">
                            <h3>
                    <?php 
                    $cleanerName = $activity['cleaner_fname'] . ' ' . $activity['cleaner_lname'];
                    echo 'Cleaner: ' . htmlspecialchars(trim($cleanerName)) . ' <br><br> Service: ' . htmlspecialchars($activity['service']); 
                    ?>
                        </h3>
                        <p>Booking Date: <?php echo htmlspecialchars($activity['BookingDate']); ?></p>
                       
                                    </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
</main>
</body>
</html>
