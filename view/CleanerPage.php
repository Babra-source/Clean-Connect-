<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clean Conect|Service Providers</title>
    <link rel="stylesheet" href="../assets/css/Cleanerpage.css">
</head>
<body>

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



<div class="cards-container">
    <div class="card">
        <div class="card-header">
            <img src="../assets/images/mission1.jpeg" alt="Service Icon" class="card-icon">
        </div>
        <h3 class="card-title">Home Services </h3>
            <p class="card-description">
                A brief overview of the service offered. Highlight key features or benefits that make this service stand out.
            </p>
    </div>
</div>

<!-- Available Cleaners Section -->
<div class="container mt-5">
    <h2 class="text-center mb-4">Available Cleaners</h2>
    <div class="row g-4"> <!-- Use g-4 for grid gap -->
        <!-- Cleaner Card 1 -->
        <div class="col-md-6"> <!-- Updated to col-md-6 for 2 cards per row -->
            <div class="card h-100 cleaner-card" onclick="window.location.href='cleanerprofile.php';" style="cursor: pointer;">
                <img src="../assets/images/cleaner1.jpeg" class="card-img-top" alt="Cleaner 1">
                <div class="card-body">
                    <h5 class="card-title">Cleaner 1</h5>
                    <p class="card-text">Expert in home cleaning and maintenance with over 5 years of experience.</p>
                </div>
            </div>
        </div>
        <!-- Cleaner Card 2 -->
        <div class="col-md-6"> <!-- Updated to col-md-6 for 2 cards per row -->
            <div class="card h-100 cleaner-card" onclick="window.location.href='cleaner2-page.html';" style="cursor: pointer;">
                <img src="../assets/images/cleaner2.jpeg" class="card-img-top" alt="Cleaner 2">
                <div class="card-body">
                    <h5 class="card-title">Cleaner 2</h5>
                    <p class="card-text">Specialist in deep cleaning and sanitization services for households.</p>
                </div>
            </div>
        </div>
        <!-- Cleaner Card 3 -->
        <div class="col-md-6"> <!-- Updated to col-md-6 for 2 cards per row -->
            <div class="card h-100 cleaner-card" onclick="window.location.href='cleaner3-page.html';" style="cursor: pointer;">
                <img src="../assets/images/cleaner3.jpeg" class="card-img-top" alt="Cleaner 3">
                <div class="card-body">
                    <h5 class="card-title">Cleaner 3</h5>
                    <p class="card-text">Providing eco-friendly cleaning solutions tailored to your needs.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6"> <!-- Updated to col-md-6 for 2 cards per row -->
            <div class="card h-100 cleaner-card" onclick="window.location.href='cleaner2-page.html';" style="cursor: pointer;">
                <img src="../assets/images/cleaner2.jpeg" class="card-img-top" alt="Cleaner 2">
                <div class="card-body">
                    <h5 class="card-title">Cleaner 2</h5>
                    <p class="card-text">Specialist in deep cleaning and sanitization services for households.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6"> <!-- Updated to col-md-6 for 2 cards per row -->
            <div class="card h-100 cleaner-card" onclick="window.location.href='cleanerProfile.html';" style="cursor: pointer;">
                <img src="../assets/images/cleaner2.jpeg" class="card-img-top" alt="Cleaner 2">
                <div class="card-body">
                    <h5 class="card-title">Cleaner 2</h5>
                    <p class="card-text">Specialist in deep cleaning and sanitization services for households.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6"> <!-- Updated to col-md-6 for 2 cards per row -->
            <div class="card h-100 cleaner-card" onclick="window.location.href='cleaner2-page.html';" style="cursor: pointer;">
                <img src="../assets/images/cleaner2.jpeg" class="card-img-top" alt="Cleaner 2">
                <div class="card-body">
                    <h5 class="card-title">Cleaner 2</h5>
                    <p class="card-text">Specialist in deep cleaning and sanitization services for households.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6"> <!-- Updated to col-md-6 for 2 cards per row -->
            <div class="card h-100 cleaner-card" onclick="window.location.href='cleaner2-page.html';" style="cursor: pointer;">
                <img src="../assets/images/cleaner2.jpeg" class="card-img-top" alt="Cleaner 2">
                <div class="card-body">
                    <h5 class="card-title">Cleaner 2</h5>
                    <p class="card-text">Specialist in deep cleaning and sanitization services for households.</p>
                </div>
            </div>
        </div>

    </div>




</div>


<!-- Comment Section -->
<div class="container mt-5">
    <h3 class="text-center mb-4">Leave a Comment</h3>
    <form action="#" method="post" class="comment-form">
        <div class="form-group">
            <label for="comment-name">Name</label>
            <input type="text" id="comment-name" name="name" class="form-control" required placeholder="Enter your name">
        </div>
        <div class="form-group">
            <label for="comment-email">Email</label>
            <input type="email" id="comment-email" name="email" class="form-control" required placeholder="Enter your email">
        </div>
        <div class="form-group">
            <label for="comment-text">Your Comment</label>
            <textarea id="comment-text" name="comment" class="form-control" rows="4" required placeholder="Write your comment here"></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Submit Comment</button>
    </form>
</div>


    
</body>
</html>