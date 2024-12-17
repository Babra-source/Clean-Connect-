<?php
session_start(); // Start the session to access session variables
include '../db/config.php';

// Retrieve the user's name from session, default to 'Guest' if not set
$userName = isset($_SESSION['fname']) ? $_SESSION['fname'] : 'Guest';
$role = $_SESSION['role'];
$user_id = $_SESSION['userid'];



// Query for total number of customers based on unique user_id
$totalUsersQuery = "SELECT COUNT(userid) FROM cleanusers";
$totalUsersResult = $conn->query($totalUsersQuery);
$totalUsers = $totalUsersResult->fetch_row()[0];


// Total Cleaners Query
$totalCleanersQuery = "SELECT COUNT(userid) FROM cleanusers WHERE role = 'cleaner'";
$totalCleanersResult = $conn->query($totalCleanersQuery);
$totalCleaners = $totalCleanersResult->fetch_row()[0];


$totalBookingsQuery = "SELECT COUNT(*) FROM bookings";
$totalBookingsResult = $conn->query($totalBookingsQuery);
$totalBookings = $totalBookingsResult->fetch_row()[0];

// Query to get cleaners with pending status by joining cleanusers and cleaners tables
$pendingCleanersQuery = "
    SELECT cleanusers.fname, cleanusers.lname, cleaners.bio, cleaners.status, services.servicename, cleaners.cleaner_id,cleaners.experience
    FROM cleanusers 
    JOIN cleaners ON cleanusers.userid = cleaners.userid 
    JOIN services ON cleaners.service = services.serviceid
    WHERE cleaners.status = 'UnderReview'";

$pendingCleanersResult = $conn->query($pendingCleanersQuery);
$pendingCleanersCount = $pendingCleanersResult->num_rows; // Number of pending cleaners





?>


<!DOCTYPE html>
<html lang="en">
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="../assets/css/AdminDashboard.css">
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
                  <li><a href="../view/index.php" class="nav-link">Homepage</a></li>
                  <li><a href="../view/usermanagement.php" class="nav-link">UserManagement</a></li>
                  <li><a href="../view/ServicesPage.php" class="nav-link">Cleaning Services Page</a></li>
                  <li><a href="../view/ManageServices.php" class="nav-link">Service Management</a></li>
                  <li><a href="../actions/logout.php" class="nav-link">Logout</a></li>
                  <li><a href="../view/AboutPage.php" class="nav-link">About Page</a></li>
                  </ul>
              </nav>
      </header>

   <div class="banner" style="position: relative; text-align: center;">
    <img src="../assets/images/homepage1.jpg" alt="Cleaning Services Banner" class="banner-img" style="width: 100%; height: auto;">
    <h1 style="color: black; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 2.5em; background-color: rgba(255, 255, 255, 0.7); padding: 10px; border-radius: 5px;">
        Welcome to Clean Connect, <?php echo $userName; ?>!
    </h1>
    </div>



  <main class="admin-main">
    <!-- Stats Section -->
    <section class="admin-stats">
      <div class="stat-card">
        <i class="fas fa-users"></i>
        <h3>Normal Clients</h3>
        <p><?php echo number_format($totalUsers); ?></p> <!-- Static number for example -->
      </div>
      <div class="stat-card">
        <i class="fas fa-user-tie"></i>
        <h3>Cleaners</h3>
        <p><?php echo number_format($totalCleaners); ?></p> <!-- Static number for example -->
      </div>
      <div class="stat-card">
        <i class="fas fa-calendar-check"></i>
        <h3>Total Bookings</h3>
        <p><?php echo number_format($totalBookings); ?></p> <!-- Static number for example -->
      </div>
    </section>



          <!-- Pending Cleaners Section -->
      <section class="pending-cleaners">
        <div class="stat-card">
          <i class="fas fa-user-clock"></i>
          <h3>Pending Cleaners for Approval</h3>
          <p><?php echo number_format($pendingCleanersCount); ?></p> <!-- Display count of pending cleaners -->
        </div>
        
        <!-- Optionally, you can list the pending cleaners -->
        <div class="cleaner-list">
        <div style="text-align: center;">
          <h4 style="display: inline;">Pending Cleaners</h4> <span style="display: inline;"></span>
      </div>

<table class="table table-bordered table-striped">
    <thead style="background-color: #f8d7da;">
        <tr>
            <th>Name</th>
            <th>Service</th>
            <th>Status</th>
            <th>Experience</th>
            <th>Bio</th>
            <th>Cleaner Status</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($cleaner = $pendingCleanersResult->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $cleaner['fname'] . ' ' . $cleaner['lname']; ?></td>
                <td><?php echo $cleaner['servicename']; ?></td> <!-- Display the service name -->
                <td><?php echo $cleaner['status']; ?></td>
                <td><?php echo $cleaner['experience']; ?> years</td>
                <td><?php echo $cleaner['bio']; ?></td> <!-- Display the bio -->
                <td>
                    <!-- Dropdown for Admin to approve -->
                    <form action="../actions/approve_cleaner.php" method="POST">
                        <!-- Dropdown for selecting cleaner status with Bootstrap styling -->
                        <input type="hidden" name="cleaner_id" value="<?php echo $cleaner['cleaner_id']; ?>">
                        <div class="form-group">
                            <select name="status" class="form-control">
                                <option value="UnderReview" <?php if ($cleaner['status'] == 'UnderReview') echo 'selected'; ?>>Under Review</option>
                                <option value="Approved" <?php if ($cleaner['status'] == 'Approved') echo 'selected'; ?>>Approve</option>
                                <option value="Rejected" <?php if ($cleaner['status'] == 'Rejected') echo 'selected'; ?>>Reject</option>
                            </select>
                        </div>

                        <!-- Submit button with Bootstrap styling -->
                        <button type="submit" class="btn btn-primary mt-2">Update Status</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>



</div>

</section>


    
  </main>
</body>
</html>
