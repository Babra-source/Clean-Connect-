
<?php

    include '../db/config.php'; 
    session_start(); // Add a semicolon here

    // Assuming you have a database connection established as $conn
    $query = "SELECT serviceid, servicename FROM services";
    $result = mysqli_query($conn, $query);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cleaner Contract - Clean Connect Hub</title>
    <link rel="stylesheet" href="../assets/css/terms.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="logo">
            <h1>Clean Connect Hub</h1>
        </div>
        <nav>
            <ul>
                <li><a href="../view/index.php">Home</a></li>
                <li><a href="#demand">Requirements</a></li>
                <li><a href="#contractForm">Apply</a></li>
                <li><a href="#Wayforward">Process</a></li>
            </ul>
        </nav>
    </header>

    <!-- Banner Section -->
    <section id="banner">
        <div class="banner-content">
            <div class="banner-text">
                <h1>Become a Clean Connect Hub Cleaner</h1>
                <p>Join our mission to create cleaner, safer environments</p>
            </div>
            <div class="banner-image">
                <img src="../assets/images/background1.jpg" alt="Clean Connect Hub Cleaning Professional">
            </div>
        </div>
    </section>

    <div id="Intro" class="col-md-9 col-lg-10 content">
                
                <!-- Want to be a Cleaner Section -->
                <section>
                    <h1>Want to be a Cleaner</h1>
                    <p>The Clean Connect Hub is a social website that helps connect well-equipped and noble cleaners to our 
                        cherished customers. Our mission is to ensure a clean and safe environment for our users. 
                        To be a cleaner in alignment with our mission, you need to fully complete this Terms and Condition page.
                        We will get back to you after a careful review.
                    </p>
                </section>

                <!-- Demands List Section -->
                <section id="demand">
                    <h1>What it takes to be a Cleaner</h1>
                    <ul class="demands-list">
                        <li><i class="bi bi-check-circle check-icon"></i><strong>Attention to Detail:</strong> Cleaners must have a keen eye for detail to ensure that every area is thoroughly cleaned and maintained.</li>
                        <li><i class="bi bi-check-circle check-icon"></i><strong>Physical Stamina:</strong> The job requires physical endurance, as cleaning can be physically demanding, involving long hours of standing, bending, and moving.</li>
                        <li><i class="bi bi-check-circle check-icon"></i><strong>Time Management:</strong> Cleaners must be able to efficiently manage their time and prioritize tasks to meet cleaning deadlines.</li>
                        <li><i class="bi bi-check-circle check-icon"></i><strong>Knowledge of Cleaning Techniques:</strong> Knowledge of different cleaning methods, materials, and equipment is essential for ensuring effective and safe cleaning.</li>
                        <li><i class="bi bi-check-circle check-icon"></i><strong>Dependability and Reliability:</strong> Cleaners must be reliable and show up for work consistently to ensure cleanliness standards are met.</li>
                        <li><i class="bi bi-check-circle check-icon"></i><strong>Health and Safety Awareness:</strong> Understanding and following health and safety guidelines is essential to avoid hazards while cleaning.</li>
                        <li><i class="bi bi-check-circle check-icon"></i><strong>Customer Service Skills:</strong> For cleaners working in customer-facing environments, good communication and customer service skills are important to interact professionally with clients.</li>
                    </ul>
                    <p>By possessing these qualities and skills, a cleaner can contribute to a healthier and more comfortable environment for everyone.</p>
                </section>

                <!-- Contract Form Section -->
                <section id="contractForm" class="mt-5">
                    <h2>Cleaner Contract Form</h2>
        <form class="mt-3" action="../actions/cleaner_register.php" method="post" onsubmit="return validateForm()">
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter your first name" required>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter your last name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter a password" required minlength="8" title="Password must be at least 8 characters long.">
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirm_password" placeholder="Confirm your Password" required minlength="8" title="Password must be at least 8 characters long.">
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="phone_number" name="phone_number" placeholder="Enter your phone number" required pattern="[0-9]{10}" title="Phone number must be 10 digits long">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" required>
            </div>
            <div class="mb-3">
                <label for="experience" class="form-label">Years of Cleaning Experience</label>
                <select class="form-control" id="experience" name="experience" required>
                    <option value="" disabled selected>Select your experience</option>
                    <option value="0-1">0-1 Years</option>
                    <option value="2-3">2-3 Years</option>
                    <option value="4-5">4-5 Years</option>
                    <option value="6+">6+ Years</option>
                </select>
            </div>

                    <div class="mb-3">
            <label for="services" class="form-label">Services You Want to Work In</label>
            <select class="form-control" id="service" name="service">
                <?php
                    // Fetching services from the database and adding them to the select dropdown
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['serviceid'] . "'>" . htmlspecialchars($row['servicename']) . "</option>";
                    }
                ?>
            </select>
        </div>


            <div class="mb-3">
                <label for="bio" class="form-label">Bio</label>
                <textarea class="form-control" id="bio" name="bio" rows="4" placeholder="Please describe your experience in cleaning and why you'd be a good fit" required></textarea>
            </div>
            <div id="passwordError" class="text-danger"></div>
            <div id="successMessage" class="text-success"></div>
            <button type="submit" class="btn btn-primary">Submit Application</button>
</form>
                </section>


                <!-- Way Forward Section -->
                <section id="Wayforward" class="mt-5 text-center">
                    <h2>The Way Forward</h2>
                    <p>
                        Thank you for completing the form and showing interest in becoming a cleaner at The Clean Connect Hub. We are currently reviewing your submission, and our admin team will get back to you shortly with an update on your application.
                    </p>
                    <p>
                        We appreciate your patience and look forward to having you on board!
                    </p>
                </section>

            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 Clean Connect Hub. All rights reserved.</p>
        <a href="#">Privacy Policy</a> | <a href="#">Terms & Conditions</a>
    </footer>

    <!-- Script Section -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function validateForm() {
            const email = document.getElementById("email").value.trim();
            const password = document.getElementById("password").value.trim();
            const confirmPassword = document.getElementById("confirmPassword").value.trim();
            const errorMessages = [];
            const passwordError = document.getElementById("passwordError");
            const successMessage = document.getElementById("successMessage");
        
            // Clear previous messages
            passwordError.innerHTML = "";
            successMessage.textContent = "";
        
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            // Email validation
            if (email === "") {
                errorMessages.push("Email is required!");
            } else if (!emailPattern.test(email)) {
                errorMessages.push("Invalid email format. Please enter a valid email address.");
            }
            // Password validations
            if (password.length < 8) {
                errorMessages.push("Password must be at least 8 characters long!");
            }
            if (!/[A-Z]/.test(password)) {
                errorMessages.push("Password must contain at least one uppercase letter!");
            }
            if ((password.match(/\d/g) || []).length < 3) {
                errorMessages.push("Password must include at least three digits!");
            }
            if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
                errorMessages.push("Password must contain at least one special character!");
            }
        
            // Confirm password match check
            if (password !== confirmPassword) {
                errorMessages.push("Passwords do not match.");
            }
        
            // Show errors or success message
            if (errorMessages.length > 0) {
                passwordError.innerHTML = errorMessages.join("<br>");
                return false; // Prevent form submission if there are errors
            } else {
                successMessage.textContent = "Registered successfully!";
                setTimeout(function () {
                    successMessage.textContent = ""; // Clear success message after 20 seconds
                }, 20000);
        
                return true; // Allow form submission if no errors
            }
        }
    </script>
    
</body>
</html>