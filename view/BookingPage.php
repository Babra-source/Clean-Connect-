<?php
// Database connection
include '../db/config.php'; 
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Check if session values exist
$clientID = isset($_SESSION['userID']) ? $_SESSION['userID'] : null;
$cleanerID = isset($_SESSION['cleaner_ID']) ? $_SESSION['cleaner_ID'] : null;
$serviceId = isset($_SESSION['serviceid']) ? $_SESSION['serviceid'] : null;


if ($clientID === null || $cleanerID === null) {
    // echo "Error: clientID or cleanerID is missing.";
    // exit;
}
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['cleanerid']) && isset($_GET['serviceid'])) {
    $cleanerId = $_GET['cleanerid'];
    $serviceId = $_GET['serviceid'];
    $clientId =  $_SESSION['userid'];

    $sqlName = "SELECT cu.fname, cu.lname, cu.email, cu.role, cu.created_at, cu.updated_at,cu.userid, 
    c.experience, c.bio, c.phone_number
    FROM cleanusers cu
    JOIN cleaners c ON cu.UserID = c.userid
    WHERE c.cleaner_id = $cleanerId"; // Assuming cleaner_id is used to filter
    $resultName = $conn->query($sqlName);

    
    // Fetch cleaner details from the database
    // $sql = "SELECT c.cleaner_id, c.userid, c.phone_number, 
    //                 c.address, c.experience, c.bio, 
    //                 c.status, s.serviceid
    //         FROM cleaners c
    //         JOIN services s ON c.service = s.serviceid
    //         WHERE s.serviceid = $serviceId"; // Corrected query with dynamic serviceid
    // $result = $conn->query($sql);

    // Your code for processing the result goes here (e.g., displaying data)
}
?>


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


    <!-- Cleaner Profile Section -->
    <div class="container mt-5">

        <div class="row">
        
        
        <?php
                // Check if the cleaner name exists
                if ($resultName->num_rows > 0) {
                    while ($rowName = $resultName->fetch_assoc()) {
                        $cleanerName = htmlspecialchars($rowName["fname"]) . " " . htmlspecialchars($rowName["lname"]);
                        $experience = htmlspecialchars($rowName["experience"]. " years");
                        $bio = htmlspecialchars($rowName["bio"]);
                        $number = htmlspecialchars($rowName["phone_number"]);


                    }
                } else {
                    $cleanerName = "Cleaner name not found.";
                }

                // Output the cleaner details including name, experience, bio, etc.
                echo '
                <div class="col-md-4">
                    <div class="card">
                        <img src="../assets/images/cleaner.jpg" class="card-img-top" alt="Cleaner Profile Image">
                        <div class="card-body">
                            <p class="card-text"><strong>Name:</strong> ' . $cleanerName . '</p>
                            <p class="card-text"><strong>Experience:</strong> ' . $experience . '</p>
                            <p class="card-text"><strong>Bio:</strong> ' . $bio . '</p>
                            <p class="card-text"><strong>Working Phone Number:</strong> ' . $number . '</p>
                        </div>
                    </div>
                </div>
                ';
    
        // Close connection
        $conn->close();
        ?>

            <div class="col-md-8">
                <h3 class="mb-4">Book Cleaner</h3>
                <form id="bookingForm" method="POST" action="../actions/booking.php">
                <!-- Customer Name -->
                <div class="mb-3">
                    <label for="customerName" class="form-label">Your Name</label>
                    <input type="text" class="form-control" id="customerName" name="customerName" required>
                </div>

                <!-- Customer Email -->
                <div class="mb-3">
                    <label for="customerEmail" class="form-label">Your Email</label>
                    <input type="email" class="form-control" id="customerEmail" name="customerEmail" required>
                </div>

                <!-- Booking Date -->
                <div class="mb-3">
                    <label for="bookingDate" class="form-label">Booking Date</label>
                    <input type="date" class="form-control" id="bookingDate" name="bookingDate" required>
                </div>

                <!-- Booking Time -->
                <div class="mb-3">
                    <label for="bookingTime" class="form-label">Preferred Time</label>
                    <input type="time" class="form-control" id="bookingTime" name="bookingTime" required>
                </div>

                <!-- Additional Instructions -->
                <div class="mb-3">
                    <label for="bookingMessage" class="form-label">Additional Instructions</label>
                    <textarea class="form-control" id="bookingMessage" name="bookingMessage" rows="3"></textarea>
                </div>
                    <input type="hidden" value = "<?php echo $serviceId; ?>" name="serviceid" required>
                    <input type="hidden" value="<?php echo isset($_GET['cleanerid']) ? $_GET['cleanerid'] : $cleanerID; ?>" name="cleanerid" required>

                
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
        document.getElementById('bookingForm').addEventListener('submit', function() {


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
