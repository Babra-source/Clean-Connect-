<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Example</title>
    <link rel="stylesheet" href="../assets/css/terms.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> <!-- Bootstrap Icons -->
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar Section -->
            <div class="col-md-3 col-lg-2 sidebar">
                <h4 class="text-center">Cleaner Contract Content</h4>
                <a href="#">Want to be a cleaner</a>
                <a href="#demand">What it takes</a>
                <a href="#contractForm">Contract</a>
                <a href="#Wayforward">Way Forward</a>
            </div>

            <!-- Main Content Section -->
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
                        <li><i class="bi bi-check-circle check-icon"></i><strong>   Attention to Detail:</strong> Cleaners must have a keen eye for detail to ensure that every area is thoroughly cleaned and maintained.</li>
                        <li><i class="bi bi-check-circle check-icon"></i><strong>   Physical Stamina:</strong> The job requires physical endurance, as cleaning can be physically demanding, involving long hours of standing, bending, and moving.</li>
                        <li><i class="bi bi-check-circle check-icon"></i><strong>   Time Management:</strong> Cleaners must be able to efficiently manage their time and prioritize tasks to meet cleaning deadlines.</li>
                        <li><i class="bi bi-check-circle check-icon"></i><strong>   Knowledge of Cleaning Techniques:</strong> Knowledge of different cleaning methods, materials, and equipment is essential for ensuring effective and safe cleaning.</li>
                        <li><i class="bi bi-check-circle check-icon"></i><strong>   Dependability and Reliability:</strong> Cleaners must be reliable and show up for work consistently to ensure cleanliness standards are met.</li>
                        <li><i class="bi bi-check-circle check-icon"></i><strong>   Health and Safety Awareness:</strong> Understanding and following health and safety guidelines is essential to avoid hazards while cleaning.</li>
                        <li><i class="bi bi-check-circle check-icon"></i><strong>   Customer Service Skills:</strong> For cleaners working in customer-facing environments, good communication and customer service skills are important to interact professionally with clients.</li>
                    </ul>
                    <p>By possessing these qualities and skills, a cleaner can contribute to a healthier and more comfortable environment for everyone.</p>
                </section>

                <!-- Contract Form Section -->
                <section id="contractForm" class="mt-5">
                    <h2>Cleaner Contract Form</h2>
                    <form class="mt-3">
                        <div class="mb-3">
                            <label for="cleanerName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="cleanerName" placeholder="Enter your full name" required>
                        </div>
                        <div class="mb-3">
                            <label for="cleanerEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="cleanerEmail" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="cleanerPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="cleanerPassword" placeholder="Enter a password" required>
                        </div>
                        <div class="mb-3">
                            <label for="cleanerPhone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="cleanerPhone" placeholder="Enter your phone number" required>
                        </div>
                        <div class="mb-3">
                            <label for="cleanerAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="cleanerAddress" placeholder="Enter your address" required>
                        </div>
                        <div class="mb-3">
                            <label for="cleanerExperience" class="form-label">Years of Experience</label>
                            <select class="form-control" id="cleanerExperience" required>
                                <option value="" disabled selected>Select your experience</option>
                                <option value="0-1">0-1 Years</option>
                                <option value="2-3">2-3 Years</option>
                                <option value="4-5">4-5 Years</option>
                                <option value="6+">6+ Years</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="cleanerBio" class="form-label">Bio</label>
                            <textarea class="form-control" id="cleanerBio" rows="4" placeholder="Tell us about yourself" required></textarea>
                        </div>
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
</body>

</html>
