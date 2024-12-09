<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Cleaner</title>
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

    <!-- Cleaner Profile Section -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Cleaner Profile</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Cleaner Profile Image">
                    <div class="card-body">
                        <h5 class="card-title">Cleaner 1</h5>
                        <p class="card-text"><strong>Experience:</strong> Over 5 years of experience in residential cleaning, specializing in deep cleaning and organization.</p>
                        <p class="card-text"><strong>Skills:</strong> Deep cleaning, organization, sanitation.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <h3 class="mb-4">Book Cleaner 1</h3>
                <form id="bookingForm">
                    <div class="mb-3">
                        <label for="customerName" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="customerName" required>
                    </div>

                    <div class="mb-3">
                        <label for="customerEmail" class="form-label">Your Email</label>
                        <input type="email" class="form-control" id="customerEmail" required>
                    </div>

                    <div class="mb-3">
                        <label for="bookingDate" class="form-label">Booking Date</label>
                        <input type="date" class="form-control" id="bookingDate" required>
                    </div>

                    <div class="mb-3">
                        <label for="bookingTime" class="form-label">Preferred Time</label>
                        <input type="time" class="form-control" id="bookingTime" required>
                    </div>

                    <div class="mb-3">
                        <label for="bookingMessage" class="form-label">Additional Instructions</label>
                        <textarea class="form-control" id="bookingMessage" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Book Cleaner</button>
                </form>
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
        // Booking form submission handler
        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const name = document.getElementById('customerName').value;
            const email = document.getElementById('customerEmail').value;
            const date = document.getElementById('bookingDate').value;
            const time = document.getElementById('bookingTime').value;
            const message = document.getElementById('bookingMessage').value;

            // For now, just log the form data (In a real application, this data would be sent to the server)
            console.log({
                name: name,
                email: email,
                date: date,
                time: time,
                message: message
            });

            alert('Your booking request has been submitted! We will get in touch with you soon.');
        });
    </script>
</body>
</html>
