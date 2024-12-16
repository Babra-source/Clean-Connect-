<?php
include '../db/config.php'; 
error_reporting(E_ALL);
ini_set('display_errors', 1);


// Check if the service ID is passed in the URL
if (isset($_GET['serviceid'])) {
    $serviceid = $_GET['serviceid'];
    

    // Query to get the service details from the database by serviceid
    $sql = "SELECT image_path, servicename FROM services WHERE serviceid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $serviceid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $service = $result->fetch_assoc();
        
        // Fetch the image path from the database
        $imagePath = $service['image_path'];
        $serviceName = $service['servicename'];
    } else {
        echo "Service not found!";
        exit;
    }



//Fetch available cleaners for this service
// Fetch available cleaners for a specific service
$cleanersSql = "
    SELECT c.cleaner_id, cu.fname, cu.lname, c.bio
    FROM cleaners c
    JOIN cleanusers cu ON c.userid = cu.userid
    JOIN services cs ON c.service = cs.serviceid  
    WHERE cs.serviceid = ?
";


    $cleanersStmt = $conn->prepare($cleanersSql);
    $cleanersStmt->bind_param("i", $serviceid);
    $cleanersStmt->execute();
    $cleanersResult = $cleanersStmt->get_result();
} else {
    echo "Service ID not provided!";
    exit;
}

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
                <li><a href="../view/index.php" class="nav-link">Homepage</a></li>
                <li><a href="../view/logout.php" class="nav-link">Logout</a></li>
                <li><a href="../view/Cleanerterms.php" class="nav-link">Be A Cleaner</a></li>
                <li><a href="../view/login.php" class="nav-link">Sign In</a></li>
                <li><a href="../view/Register.php" class="nav-link">Sign Up</a></li>
                <li><a href="../view/AboutPage.php" class="nav-link">About Page</a></li>
            </ul>
        </nav>
    </header>

    <!-- Service Image and Search Section -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 text-center">
            <img src="../uploads/<?php echo htmlspecialchars($imagePath); ?>" 
                    class="img-fluid mb-4" 
                    alt="<?php echo htmlspecialchars($serviceName); ?>" 
                    style="width: 50%; height: auto;">
                <h2>Search for Cleaners</h2>
                <div class="d-flex justify-content-center">
                    <input type="text" class="form-control w-50" id="searchCleaner" placeholder="Search for a cleaner...">
                </div>
            </div>
        </div>
    </div>

    <!-- Available Cleaners Section -->
    <div class="container mt-5">
        <h1 class="text-center mb-4">Available Cleaners for <?php echo htmlspecialchars($serviceName); ?></h1>

        <div class="row" id="cleanersList">
            <?php 
            if ($cleanersResult->num_rows > 0) {
                while ($cleaner = $cleanersResult->fetch_assoc()) {
                    $cleanerFullName = htmlspecialchars($cleaner['fname'] . ' ' . $cleaner['lname']);
                    $cleanerBio = htmlspecialchars($cleaner['bio']);
                    $cleanerImage = !empty($cleaner['profile_image']) ? '../uploads/' . htmlspecialchars($cleaner['profile_image']) : 'https://via.placeholder.com/300x200';
            ?>
            <div class="col-md-4 cleaner-card" data-cleaner="<?php echo $cleanerFullName; ?>">
                <div class="card">
                    <img src="<?php echo $cleanerImage; ?>" class="card-img-top" alt="<?php echo $cleanerFullName; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $cleanerFullName; ?></h5>
                        <p class="card-text"><?php echo $cleanerBio; ?></p>
                        <button class="btn btn-primary" onclick="showCleanerInfo('<?php echo $cleanerFullName; ?>', '<?php echo $cleanerBio; ?>')">Show Details</button>
                        <button type="button" class="btn btn-success mt-2" 
                            onclick="viewCleanerProfile('<?php echo $cleaner['cleaner_id']; ?>', '<?php echo $serviceid; ?>')">
                            Book <?php echo $cleaner['cleaner_id']; ?>
                        </button>
                    </div>
                </div>
            </div>
            <?php 
                }
            } else {
            ?>
            <div class="col-12 text-center">
                <p>No cleaners available for this service at the moment.</p>
            </div>
            <?php 
            }
            ?>
        </div>

        <!-- Cleaner Info Modal -->
        <div class="modal fade" id="cleanerInfoModal" tabindex="-1" aria-labelledby="cleanerInfoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
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
        document.getElementById('searchCleaner').addEventListener('input', function() {
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
        function showCleanerInfo(cleanerName, cleanerBio) {
            document.getElementById('cleanerInfoContent').innerText = cleanerBio;
            document.getElementById('cleanerInfoModalLabel').textContent = cleanerName;
            var modal = new bootstrap.Modal(document.getElementById('cleanerInfoModal'));
            modal.show();
        }

        // Book Cleaner function (to be implemented)
        function bookCleaner(cleanerId) {
            // Redirect to booking page or open booking modal
            window.location.href = `booking.php?cleanerid=${cleanerId}&serviceid=<?php echo $serviceid; ?>`;
        }

        function viewCleanerProfile(cleanerId, serviceId) {
            // Redirect to the cleaner profile page with cleanerId and serviceId as query parameters
            window.location.href = `bookingpage.php?cleanerid=${cleanerId}&serviceid=${serviceId}`;
        }

    </script>

    
</body>
</html>