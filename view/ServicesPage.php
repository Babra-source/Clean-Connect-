<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
        }
        .service-card {
            margin-top: 20px;
        }
        .testimonial-card {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .feature-card {
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">PlatformName</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="services.html">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.html">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.html">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Services Section -->
    <div class="container mt-5">
        <h1 class="text-center mb-4">Our Services</h1>

        <div class="row">
            <!-- Service 1 -->
            <div class="col-md-4">
                <div class="card service-card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Service 1">
                    <div class="card-body">
                        <h5 class="card-title">Service 1</h5>
                        <p class="card-text">Description of Service 1.</p>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>

            <!-- Service 2 -->
            <div class="col-md-4">
                <div class="card service-card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Service 2">
                    <div class="card-body">
                        <h5 class="card-title">Service 2</h5>
                        <p class="card-text">Description of Service 2.</p>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>

            <!-- Service 3 -->
            <div class="col-md-4">
                <div class="card service-card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Service 3">
                    <div class="card-body">
                        <h5 class="card-title">Service 3</h5>
                        <p class="card-text">Description of Service 3.</p>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="row mt-5">
            <div class="col-md-4">
                <div class="feature-card">
                    <h4>Feature 1</h4>
                    <p>Feature 1 description, explaining why it's beneficial to the users.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <h4>Feature 2</h4>
                    <p>Feature 2 description, highlighting the impact it has on users.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <h4>Feature 3</h4>
                    <p>Feature 3 description, showing how it makes the platform stand out.</p>
                </div>
            </div>
        </div>

        <!-- Testimonials Section -->
        <h2 class="text-center mt-5">What Our Users Say</h2>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="testimonial-card">
                    <p>"This platform has helped me connect with incredible artists and showcase my work to a larger audience."</p>
                    <h6>- User 1</h6>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial-card">
                    <p>"I love how easy it is to find unique handcrafted items and support small businesses."</p>
                    <h6>- User 2</h6>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial-card">
                    <p>"The platform has made it easy for me to learn new techniques and improve my craft."</p>
                    <h6>- User 3</h6>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="row mt-5">
            <div class="col-12 text-center">
                <h3>Get In Touch</h3>
                <p>If you have any questions or need further information, feel free to contact us.</p>
                <a href="contact.html" class="btn btn-primary">Contact Us</a>
            </div>
        </div>

    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
