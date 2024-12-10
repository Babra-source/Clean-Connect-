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

    <!-- Service Image and Search Section -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <img src="https://via.placeholder.com/1200x400" class="img-fluid mb-4" alt="Service Image">
                <h2>Search for Services</h2>
                <div class="d-flex justify-content-center">
                    <input type="text" class="form-control w-50" id="searchService" placeholder="Search for a service...">
                </div>
            </div>
        </div>
    </div>

    <!-- Available Cleaners Section -->
    <div class="container mt-5">
        <h1 class="text-center mb-4">Available Cleaners</h1>

        <div class="row" id="cleanersList">
            <!-- Cleaner 1 -->
            <div class="col-md-4 cleaner-card" data-cleaner="Cleaner 1">
                <div class="card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Cleaner 1">
                    <div class="card-body">
                        <h5 class="card-title">Cleaner 1</h5>
                        <p class="card-text">Expert in residential cleaning with years of experience.</p>
                        <button class="btn btn-primary" onclick="showCleanerInfo('Cleaner 1')">Show Details</button>
                        <button class="btn btn-success mt-2">Book</button> <!-- Book button -->
                    </div>
                </div>
            </div>

            <!-- Cleaner 2 -->
            <div class="col-md-4 cleaner-card" data-cleaner="Cleaner 2">
                <div class="card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Cleaner 2">
                    <div class="card-body">
                        <h5 class="card-title">Cleaner 2</h5>
                        <p class="card-text">Specializes in office cleaning and sanitation.</p>
                        <button class="btn btn-primary" onclick="showCleanerInfo('Cleaner 2')">Show Details</button>
                        <button class="btn btn-success mt-2">Book</button> <!-- Book button -->
                    </div>
                </div>
            </div>

            <!-- Cleaner 3 -->
            <div class="col-md-4 cleaner-card" data-cleaner="Cleaner 3">
                <div class="card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Cleaner 3">
                    <div class="card-body">
                        <h5 class="card-title">Cleaner 3</h5>
                        <p class="card-text">Experienced in post-construction cleaning, ensuring your space is spotless.</p>
                        <button class="btn btn-primary" onclick="showCleanerInfo('Cleaner 3')">Show Details</button>
                        <button class="btn btn-success mt-2">Book</button> <!-- Book button -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Cleaner Info Modal -->
        <div class="modal fade" id="cleanerInfoModal" tabindex="-1" aria-labelledby="cleanerInfoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered"> <!-- Centered modal -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cleanerInfoModalLabel">Cleaner Info</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="cleanerInfoContent">
                        <!-- Cleaner details will appear here -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Cleaner Team Section -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Our Cleaning Team</h2>
        <div class="row">
            <div class="col-md-3">
                <div class="team-member">
                    <img src="https://via.placeholder.com/150" class="img-fluid mb-3" alt="Team Member">
                    <h5>Team Member 1</h5>
                    <p>Specialized in residential and commercial cleaning.</p>
                    <button class="btn btn-success mt-2">Book</button> <!-- Book button for team member -->
                </div>
            </div>
            <div class="col-md-3">
                <div class="team-member">
                    <img src="https://via.placeholder.com/150" class="img-fluid mb-3" alt="Team Member">
                    <h5>Team Member 2</h5>
                    <p>Expert in eco-friendly cleaning techniques.</p>
                    <button class="btn btn-success mt-2">Book</button> <!-- Book button for team member -->
                </div>
            </div>
            <div class="col-md-3">
                <div class="team-member">
                    <img src="https://via.placeholder.com/150" class="img-fluid mb-3" alt="Team Member">
                    <h5>Team Member 3</h5>
                    <p>Highly skilled in post-renovation cleaning.</p>
                    <button class="btn btn-success mt-2">Book</button> <!-- Book button for team member -->
                </div>
            </div>
            <div class="col-md-3">
                <div class="team-member">
                    <img src="https://via.placeholder.com/150" class="img-fluid mb-3" alt="Team Member">
                    <h5>Team Member 4</h5>
                    <p>Experienced in all aspects of residential cleaning.</p>
                    <button class="btn btn-success mt-2">Book</button> <!-- Book button for team member -->
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
        // Search functionality for cleaners
        document.getElementById('searchService').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const cleanerCards = document.querySelectorAll('.cleaner-card');

            cleanerCards.forEach(function(card) {
                const cleanerTitle = card.querySelector('.card-title').textContent.toLowerCase();
                if (cleanerTitle.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Display Cleaner Info on Click
        function showCleanerInfo(cleanerName) {
            const cleanerInfo = {
                'Cleaner 1': 'Cleaner 1 has over 5 years of experience in residential cleaning and specializes in deep cleaning and organization.',
                'Cleaner 2': 'Cleaner 2 has 3 years of experience specializing in office spaces and ensures high sanitation standards.',
                'Cleaner 3': 'Cleaner 3 is experienced in post-construction cleaning, making sure the space is ready for use after renovation.'
            };

            document.getElementById('cleanerInfoContent').innerText = cleanerInfo[cleanerName];
            var modal = new bootstrap.Modal(document.getElementById('cleanerInfoModal'));
            modal.show();
        }
    </script>
</body>
</html>
