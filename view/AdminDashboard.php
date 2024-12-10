<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../assets/css/Admindashboard.css">
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


  <main class="admin-main">
    <!-- Stats Section -->
    <section class="admin-stats">
      <div class="stat-card">
        <i class="fas fa-users"></i>
        <h3>Normal Clients</h3>
        <p>150 Clients</p> <!-- Static number for example -->
      </div>
      <div class="stat-card">
        <i class="fas fa-user-tie"></i>
        <h3>Cleaners</h3>
        <p>30 Cleaners</p> <!-- Static number for example -->
      </div>
      <div class="stat-card">
        <i class="fas fa-calendar-check"></i>
        <h3>Total Bookings</h3>
        <p>200 Bookings</p> <!-- Static number for example -->
      </div>
    </section>

    <!-- Top Cleaners Section -->
    <section class="admin-top-cleaners">
      <h2>Top 3 Most Booked Cleaners</h2>
      <div class="row">
        <!-- Card 1 -->
        <div class="col-md-4">
          <div class="activity-card">
            <div class="activity-icon">
              <i class="fas fa-star"></i>
            </div>
            <div class="activity-details">
              <h3>Cleaner: John Doe</h3>
              <p>Bookings: 50</p>
            </div>
          </div>
        </div>
        <!-- Card 2 -->
        <div class="col-md-4">
          <div class="activity-card">
            <div class="activity-icon">
              <i class="fas fa-star"></i>
            </div>
            <div class="activity-details">
              <h3>Cleaner: Sarah Lee</h3>
              <p>Bookings: 45</p>
            </div>
          </div>
        </div>
        <!-- Card 3 -->
        <div class="col-md-4">
          <div class="activity-card">
            <div class="activity-icon">
              <i class="fas fa-star"></i>
            </div>
            <div class="activity-details">
              <h3>Cleaner: Mark Smith</h3>
              <p>Bookings: 40</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Top Team Section -->
    <section class="admin-top-teams">
      <h2>Top Most Booked Team</h2>
      <div class="row">
        <!-- Card for Team -->
        <div class="col-md-12">
          <div class="activity-card">
            <div class="activity-icon">
              <i class="fas fa-users-cog"></i>
            </div>
            <div class="activity-details">
              <h3>Team: Cleaning Experts</h3>
              <p>Bookings: 120</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</body>
</html>
