<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clean Connect | Homepage</title>
    <link rel="stylesheet" href="../assets/css/homepage.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body >

<header>
    <nav>
        <ul>
            <li><a href="view/" class="nav-link">Homepage</a></li>
            <li><a href="../view/BeACleaner.php" class="nav-link">Be A Cleaner</a></li>
            <li><a href="../view/login.php" class="nav-link">Sign In</a></li>
            <li><a href="../view/Register.php" class="nav-link">Sign Up</a></li>
            <li><a href="view/About.php" class="nav-link">About Page</a></li>
        </ul>
    </nav>
    <hr class="full-width-line">
</header>


<img src="../assets/images/homepage.jpg" alt="Background image">
<div id="Homepage-container">
    <p id="welcome-message">Clean Connect</p>
    <p id="welcome-message">Professional Cleaning for your households.</p>
    <p id="welcome-message">We clean, you relax .</p>

    <a href="Register.php">
    <button id="Get-started">Get Started</button>
</a>
</div>




<!-- <h2 >What we Offer</h2> Added heading here -->
<h2 id ="offer">What we offer</h2>
<div class="cards-container">
    <div class="card">
        <h3><i class="fas fa-calendar-check " style="font-size: 30px;"></i> Easy Booking</h3>
        <p>Schedule cleaning at your convenience. Our easy booking system lets you select the date and time that works best for you.</p>
    </div>
    <div class="card">
        <h3><i class="fas fa-shield-alt" style="font-size: 30px;"></i> Trusted Cleaners</h3>
        <p>We vet all of our cleaners to ensure they are professional, reliable, and trustworthy.</p>
    </div>
    <div class="card">
        <h3><i class="fas fa-tag" style="font-size: 30px;"></i>  Affordable Rates</h3>
        <p>We offer competitive pricing without compromising on quality. Enjoy clean homes without breaking the bank.</p>
    </div>
</div>

<h2>Our Top 3 Missions</h2> <!-- Heading added -->

<div class="missions-list">
    <ul>
        <li><i class="fas fa-check-circle"></i> To provide reliable and professional cleaning services to homes, ensuring customer satisfaction.</li>
        <li><i class="fas fa-check-circle"></i> To foster a cleaner, healthier living environment by using eco-friendly and sustainable cleaning products.</li>
        <li><i class="fas fa-check-circle"></i> To create flexible and accessible booking options for customers, making it easier to schedule cleaning services at their convenience.</li>
    </ul>
</div>

<div class="container about-us">
    <div class="row">
        <!-- About Image (Left Column) -->
        <div class="image-column">
            <img src="../assets/images/mission1.jpeg" alt="About Us Image" class="about-image">
        </div>
        <!-- About Text (Right Column) -->
        <div class="text-column">
            <h2>About Us</h2>
            <p>We are dedicated to providing reliable and professional cleaning services that prioritize customer satisfaction. Our mission is to offer eco-friendly cleaning solutions while maintaining a commitment to quality and sustainability.</p>
        </div>
    </div>
</div>


<!-- Testimonials Section -->
<section class="testimonials">
    <div class="container">
        <h2>What Our Clients Say</h2>
        <div class="testimonial-grid">
            <div class="testimonial-card">
                <blockquote>
                    "Incredible service! They transformed my home and did it with such professionalism. I couldn't be happier!"
                </blockquote>
                <div class="client-info">
                    <span class="client-name">Sarah Johnson</span>
                    <span class="client-location">New York, NY</span>
                </div>
            </div>
            <div class="testimonial-card">
                <blockquote>
                    "Reliable, thorough, and eco-friendly. These guys are the real deal. Highly recommend their cleaning services!"
                </blockquote>
                <div class="client-info">
                    <span class="client-name">Michael Rodriguez</span>
                    <span class="client-location">Chicago, IL</span>
                </div>
            </div>
            <div class="testimonial-card">
                <blockquote>
                    "Professional and meticulous. They pay attention to every detail and always leave my office sparkling clean."
                </blockquote>
                <div class="client-info">
                    <span class="client-name">Emily Chen</span>
                    <span class="client-location">San Francisco, CA</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer Section -->
<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-about">
                <h3>Clean & Green Services</h3>
                <p>Providing top-quality, eco-friendly cleaning solutions for homes and businesses.</p>
            </div>
            <div class="footer-contact">
                <h4>Contact Us</h4>
                <ul>
            <li><i class="fas fa-phone"></i> (555) 123-4567</li>
            <li><i class="fas fa-envelope"></i> info@cleanandgreenservices.com</li>
            <li><i class="fas fa-map-marker-alt"></i> 123 Clean Street, Cityville, ST 12345</li>
        </ul>
            </div>
            <div class="footer-services">
                <h4>Our Services</h4>
                <ul>
                    <li>Residential Cleaning</li>
                    <li>Commercial Cleaning</li>
                    <li>Deep Cleaning</li>
                    <li>Eco-Friendly Solutions</li>
                </ul>
            </div>
            <div class="footer-social">
                <h4>Follow Us</h4>
                <div class="social-icons">
                    <a href="#" class="social-link">Facebook</a>
                    <a href="#" class="social-link">Instagram</a>
                    <a href="#" class="social-link">Twitter</a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Clean & Green Services. All Rights Reserved.</p>
        </div>
    </div>
</footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>





</body>
</html>