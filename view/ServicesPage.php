<?php
include '../db/config.php'; // Include the database connection file

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Redirect user to login page if not logged in
if (!isset($_SESSION['userid'])) {
    header('Location: ../view/login.php');
    exit;
}


$sql = "SELECT servicename, description, price, createdat, serviceid, image_path FROM services";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/service.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation Bar -->
    <header>
        <div class="logo">
            <h1>Clean Connect</h1> 
        </div>
        
        <nav>
            <ul>
            <li><a href="javascript:history.back()" class="nav-link">Go Back</a></li>
                <li><a href="../actions/logout.php" class="nav-link">Logout</a></li>
                <li><a href="../view/AboutPage.php" class="nav-link">About Page</a></li>
            </ul>
        </nav>
    </header>

    <!-- Search Section -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Search for Services</h2>
                <input type="text" class="form-control w-50 mx-auto" id="searchService" placeholder="Search for a service...">
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <div class="container mt-5">
        <h1 class="text-center mb-4">Our Services</h1>

        <div class="row" id="servicesList">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '
                    <div class="col-md-4 service-card" data-service="'.$row['servicename'].'">
                        <div class="card">
                            <img src="../uploads/'.$row['image_path'].'" class="card-img-top" alt="'.$row['servicename'].'">
                            <div class="card-body">
                                <h5 class="card-title">'.$row['servicename'].'</h5>
                                <p class="card-text">'.$row['description'].'</p>
                                <a href="../view/Servicebooking.php?serviceid='.$row['serviceid'].'" class="btn btn-primary">Book this service</a>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo "<p>No services found.</p>";
            }
            $conn->close();
            ?>
        </div>
    </div>

    <!-- Features Section -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Why Choose Us?</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="feature-card">
                    <h4>Reliable Professionals</h4>
                    <p>Our cleaners are thoroughly vetted and trained to deliver top-quality service with a focus on professionalism.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <h4>Affordable Pricing</h4>
                    <p>We offer competitive pricing while maintaining high standards of service, making cleaning affordable for everyone.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <h4>Flexible Scheduling</h4>
                    <p>Whether it's a one-time deep clean or regular service, we work around your schedule to meet your needs.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="text-center mt-5 py-4" style="background-color: #333; color: white;">
        <p>&copy; 2024 Cleaner Connect | All Rights Reserved</p>
        <p><a href="privacy-policy.html" style="color: white;">Privacy Policy</a> | <a href="terms-of-service.html" style="color: white;">Terms of Service</a></p>
    </footer>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script>
        // Search functionality for services
        document.getElementById('searchService').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const serviceCards = document.querySelectorAll('.service-card');

            serviceCards.forEach(function(card) {
                const serviceTitle = card.querySelector('.card-title').textContent.toLowerCase();
                if (serviceTitle.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
