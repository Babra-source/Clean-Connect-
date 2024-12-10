<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cleaner's Dashboard</title>
  <link rel="stylesheet" href="../assets/css/dashboard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
        <header>
        <div id="logo">
            <img src="../assets/images/background.jpg" alt="Cleaner Connect Logo" />
        </div>
        <nav>
            <ul>
                <li><a href="view/" class="nav-link">Homepage</a></li>
                <li><a href="../view/BeACleaner.php" class="nav-link">Be A Cleaner</a></li>
                <li><a href="../view/login.php" class="nav-link">Sign In</a></li>
                <li><a href="../view/Register.php" class="nav-link">Sign Up</a></li>
                <li><a href="view/About.php" class="nav-link">About Page</a></li>
            </ul>
        </nav>
    </header>

  <main class="dashboard-main">
    <!-- Stats Section -->
    <section class="dashboard-stats">
      <div class="stat-card">
        <i class="fas fa-calendar-check"></i>
        <h3>Upcoming Bookings</h3>
        <p>5 Bookings</p> <!-- Static number for example -->
      </div>
      <div class="stat-card">
        <i class="fas fa-history"></i>
        <h3>Past Bookings</h3>
        <p>8 Bookings</p> <!-- Static number for example -->
      </div>
    </section>

    <!-- Recent Activities Section -->
    <section class="dashboard-activities">
      <h2>Recent Booking Activities</h2>
      <div class="row">
        <!-- Card 1 -->
        <div class="col-md-4">
          <div class="activity-card">
            <div class="activity-icon">
              <i class="fas fa-calendar-day"></i>
            </div>
            <div class="activity-details">
              <h3>Booking for John Doe</h3>
              <p>Booking Date: 2024-12-01</p>
              <p>Status: Confirmed</p>
            </div>
          </div>
        </div>
        <!-- Card 2 -->
        <div class="col-md-4">
          <div class="activity-card">
            <div class="activity-icon">
              <i class="fas fa-calendar-day"></i>
            </div>
            <div class="activity-details">
              <h3>Booking for Sarah Lee</h3>
              <p>Booking Date: 2024-11-28</p>
              <p>Status: Pending</p>
            </div>
          </div>
        </div>
        <!-- Card 3 -->
        <div class="col-md-4">
          <div class="activity-card">
            <div class="activity-icon">
              <i class="fas fa-calendar-day"></i>
            </div>
            <div class="activity-details">
              <h3>Booking for Mark Smith</h3>
              <p>Booking Date: 2024-11-25</p>
              <p>Status: Completed</p>
            </div>
          </div>

          
        </div>
        <div class="col-md-4">
          <div class="activity-card">
            <div class="activity-icon">
              <i class="fas fa-calendar-day"></i>
            </div>
            <div class="activity-details">
              <h3>Booking for Mark Smith</h3>
              <p>Booking Date: 2024-11-25</p>
              <p>Status: Completed</p>
            </div>
          </div>
      </div>
    </section>
  </main>
</body>
</html>
