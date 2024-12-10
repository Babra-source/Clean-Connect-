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
            <!-- Service 1 -->
            <div class="col-md-4 service-card" data-service="Service 1">
                <div class="card">
                    <img src="../assets/images/handshake.jpg" class="card-img-top" alt="Service 1">
                    <div class="card-body">
                        <h5 class="card-title">Service 1</h5>
                        <p class="card-text">Description of Service 1. This service includes cleaning of residential properties with a focus on thoroughness and attention to detail.</p>
                        <a href="#" class="btn btn-primary">Book for this service</a>
                    </div>
                </div>
            </div>

            <!-- Service 2 -->
            <div class="col-md-4 service-card" data-service="Service 2">
                <div class="card">
                    <img src="../assets/images/handshake.jpg" class="card-img-top" alt="Service 2">
                    <div class="card-body">
                        <h5 class="card-title">Service 2</h5>
                        <p class="card-text">Description of Service 2. This service specializes in office cleaning, ensuring that your workspace is always pristine and productive.</p>
                        <a href="..view/servicebooking.php" class="btn btn-primary">Book this service</a>
                    </div>
                </div>
            </div>

            <!-- Service 3 -->
            <div class="col-md-4 service-card" data-service="Service 3">
                <div class="card">
                    <img src="../assets/images/handshake.jpg" class="card-img-top" alt="Service 3">
                    <div class="card-body">
                        <h5 class="card-title">Service 3</h5>
                        <p class="card-text">Description of Service 3. This service is designed for post-construction cleaning, making your newly renovated space look spotless.</p>
                        <a href="#" class="btn btn-primary">Book  this service</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 service-card" data-service="Service 2">
                <div class="card">
                    <img src="../assets/images/handshake.jpg" class="card-img-top" alt="Service 2">
                    <div class="card-body">
                        <h5 class="card-title">Service 2</h5>
                        <p class="card-text">Description of Service 2. This service specializes in office cleaning, ensuring that your workspace is always pristine and productive.</p>
                        <a href="#" class="btn btn-primary">Book this service</a>
                    </div>
                </div>
            </div>
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
