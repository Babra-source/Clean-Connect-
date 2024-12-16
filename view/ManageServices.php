<?php
include '../db/config.php'; // Include the database connection file

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Redirect user to login page if not logged in
if (!isset($_SESSION['userid'])) {
    header('Location: ../view/login.php');
    exit;
}

// Fetch user details from session
$user_id = $_SESSION['userid'];
$email = $_SESSION['email'];
$role = $_SESSION['role']; // 1 for Super Admin, 2 for regular User


function fetchServices($conn) {
    $stmt = $conn->prepare("SELECT servicename, description, price, createdat, serviceid, image_path FROM services");
    $stmt->execute();
    return $stmt->get_result();
}


//Creation of service 
// Handle service creation
// Handle the file upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_service'])) {
    $service_name = trim($_POST['service_name']);
    $service_description = trim($_POST['service_description']);
    $service_price = trim($_POST['service_price']);
    $service_duration = trim($_POST['service_duration']);

    // Handle the uploaded file
    $service_image = $_FILES['service_image']['name']; // Get the file name
    $target_dir = "../uploads/"; // Directory to store uploaded files
    $target_file = $target_dir . basename($service_image); // Full path for the file

    // Validate the image file (optional: check file type, size, etc.)
    if (!empty($service_name) && !empty($service_description) && !empty($service_price) && !empty($service_duration) && !empty($service_image)) {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['service_image']['tmp_name'], $target_file)) {
            $addQuery = "INSERT INTO services (servicename, description, price, duration, image_path) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($addQuery);
            $stmt->bind_param("ssdss", $service_name, $service_description, $service_price, $service_duration, $target_file); // Store file path
            $stmt->execute();
            header("Location: ../view/ManageServices.php");
            exit;
        } else {
            echo "Image upload failed.";
        }
    } else {
        echo "All fields are required.";
    }
}


// Service Deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteservice'])) {
    $service_id = $_POST['service_id'];

    // Prepare the DELETE query
    $stmt = $conn->prepare("DELETE FROM services WHERE serviceid = ?");
    $stmt->bind_param("i", $service_id);
    $stmt->execute();

    // Redirect to the same page to reflect the changes
    header("Location: ../view/ManageServices.php");
    exit;
}


// Handle service update
// Handle service update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_service'])) {
    $service_id = $_POST['service_id'];
    $service_name = $_POST['service_name'];
    $service_description = $_POST['service_description'];
    $service_price = $_POST['service_price'];
    $service_duration = $_POST['service_duration'];

    // Check if a new image has been uploaded
    $target_file = null;
    if (!empty($_FILES['service_image']['name'])) {
        $target_dir = "../uploads/";
        $service_image = $_FILES['service_image']['name'];
        $target_file = $target_dir . basename($service_image);
        
        // Move the uploaded file
        if (move_uploaded_file($_FILES['service_image']['tmp_name'], $target_file)) {
            // File uploaded successfully
        } else {
            die("Image upload failed.");
        }
    } else {
        // If no new image, use the current image path
        $stmt = $conn->prepare("SELECT image_path FROM services WHERE serviceid = ?");
        $stmt->bind_param("i", $service_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $service = $result->fetch_assoc();
        $target_file = $service['image_path'];
    }

    // Prepare the update query
    if ($target_file) {
        // Update service with new image
        $stmt = $conn->prepare("UPDATE services SET servicename = ?, description = ?, price = ?, duration = ?, image_path = ? WHERE serviceid = ?");
        $stmt->bind_param("ssdssi", $service_name, $service_description, $service_price, $service_duration, $target_file, $service_id);
    } else {
        // Update service without changing image
        $stmt = $conn->prepare("UPDATE services SET servicename = ?, description = ?, price = ?, duration = ? WHERE serviceid = ?");
        $stmt->bind_param("ssdsi", $service_name, $service_description, $service_price, $service_duration, $service_id);
    }

    $stmt->execute();

    // Redirect to the service management page after update
    header("Location: ../view/ManageServices.php");
    exit;
}



// Fetch all services to display
$fetchServicesQuery = "SELECT * FROM services";
$servicesResult = $conn->query($fetchServicesQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Services</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<style>
#banner {
    background: url('../assets/images/homepage1.jpg') no-repeat center center/cover;
    color: #fff;
    text-align: center;
    padding: 100px 20px;
}


</style>
<header>
    <div class="logo">
        <h1>Clean Connect</h1> 
    </div>
    <nav>
        <ul>
            <li><a href="view/" class="nav-link">Homepage</a></li>
            <li><a href="../view/usermanagement.php" class="nav-link">UserManagement</a></li>
            <li><a href="view/About.php" class="nav-link">About Page</a></li>
            <li><a href="../view/ServicesPage.php" class="nav-link">Services Page</a></li>
            <li><a href="../view/ProfilePage.php" class="nav-link">
                <i class="fas fa-user"></i> 
            </a></li>
            <li><a href="../actions/logout.php" class="nav-link">Logout
                <i class="fas fa-sign-out-alt"></i>
            </a></li>
        </ul>
    </nav>
</header>

<div id = "banner" class="banner bg-light p-5 text-center">
    <h2>Welcome to the Service Management Page</h2>
    <p>Add, Update, and Delete Services Below</p>
</div>
<div class="container my-5">
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addServiceModal">Add Service</button>


    <!-- Add Service Modal -->
    <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addServiceModalLabel">Add New Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST"  enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="service_name" class="form-label">Service Name</label>
                            <input type="text" class="form-control" name="service_name" id="service_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="service_description" class="form-label">Service Description</label>
                            <textarea class="form-control" name="service_description" id="service_description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="service_image" class="form-label">Upload Descriptive Image</label>
                            <input type="file" class="form-control" name="service_image" id="service_image" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label for="service_price" class="form-label">Service Price</label>
                            <input type="number" class="form-control" name="service_price" id="service_price" required>
                        </div>

                        <div class="mb-3">
                            <label for="service_duration" class="form-label">Service Duration</label>
                            <input type="text" class="form-control" name="service_duration" id="service_duration" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="add_service" class="btn btn-primary">Add Service</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- Edit Service Modal -->
<div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editServiceModalLabel">Edit Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="service_id" id="edit_service_id">
                    <div class="mb-3">
                        <label for="edit_service_name" class="form-label">Service Name</label>
                        <input type="text" class="form-control" name="service_name" id="edit_service_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_service_description" class="form-label">Service Description</label>
                        <textarea class="form-control" name="service_description" id="edit_service_description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_service_image" class="form-label">Update Service Image (Optional)</label>
                        <input type="file" class="form-control" name="service_image" id="edit_service_image" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="edit_service_price" class="form-label">Service Price</label>
                        <input type="number" class="form-control" name="service_price" id="edit_service_price" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_service_duration" class="form-label">Service Duration</label>
                        <input type="text" class="form-control" name="service_duration" id="edit_service_duration" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="edit_service" class="btn btn-primary">Update Service</button>
                </div>
            </form>
        </div>
    </div>
</div>






<!-- Display Services in Table -->
<h2>Services Management</h2>
<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Service Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Created At</th>
                <th>Descriptive image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

        <?php
            // Fetch services from the database (assuming the function fetchServices($conn) exists)
            $serviceResult = fetchServices($conn);
            if ($serviceResult->num_rows > 0) {
                while ($service = $serviceResult->fetch_assoc()) {
                    echo "<tr>
                            <td>{$service['servicename']}</td>
                            <td>{$service['description']}</td>
                            <td>{$service['price']}</td>
                            <td>{$service['createdat']}</td>
                            <td><img src='{$service['image_path']}' alt='Service Image' style='max-width: 100px; height: auto;'></td> <!-- Display image -->
                            <td>
                                <button type='button' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#editServiceModal' onclick='populateEditModal({$service['serviceid']})'>Edit</button>
                                <button type = 'submit' class='btn btn-danger btn-sm' name = 'deleteservice' onclick='deleteService({$service['serviceid']})'>Delete</button>
                            </td>
                        </tr>";

                }
            } else {
                echo "<tr><td colspan='5'>No services found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</div>
<script src="../assets/js/deleteservice.js"></script>
<script src="../assets/js/editservice.js"></script>
</body>
</html>
