<?php
// Include the database configuration file
include '../db/config.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session to manage user data
session_start();

// Redirect user to login page if not logged in
if (!isset($_SESSION['userid'])) {
    header('Location: ../view/login.php');
    exit;
}

// Fetch user details from session
$userid = $_SESSION['userid'];
$email = $_SESSION['email'];
$role = $_SESSION['role']; // 1 for Super Admin, 2 for regular User

// Function to fetch all users
function fetchUsers($conn) {
    $stmt = $conn->prepare("SELECT userid, fname, lname, email, role FROM cleanusers");
    $stmt->execute();
    return $stmt->get_result();
}

// Handle user creation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_user'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate inputs
    if (empty($fname) || empty($lname) || empty($email) || empty($password)) {
        die("All fields are required.");
    }

    // Hash password securely
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO cleanusers (fname, lname, email, password, role,created_at) VALUES (?, ?, ?, ?, 2,NOW())");
    $stmt->bind_param("ssss", $fname, $lname, $email, $hashedPassword);
    $stmt->execute();
    header("Location: ../view/usermanagement.php");
    exit;
}

// Handle user deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $userid = $_POST['userid'];

    // First, check the user's role to determine if they are a 'cleaner'
    $stmt = $conn->prepare("SELECT role FROM cleanusers WHERE userid = ?");
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $stmt->bind_result($role);
    $stmt->fetch();
    $stmt->close();

    // If the role is 'cleaner', delete from the cleaners table as well
    if ($role === 'Cleaner') {
        // Begin transaction to ensure both deletions happen together
        $conn->begin_transaction();

        try {
            // Delete from cleaners table
            $stmt = $conn->prepare("DELETE FROM cleaners WHERE userid = ?");
            $stmt->bind_param("i", $userid);
            $stmt->execute();
            $stmt->close();

            // Delete from users table
            $stmt = $conn->prepare("DELETE FROM cleanusers WHERE userid = ?");
            $stmt->bind_param("i", $userid);
            $stmt->execute();
            $stmt->close();

            // Commit the transaction
            $conn->commit();
            header("Location: ../view/usermanagement.php");
            exit;
        } catch (Exception $e) {
            // Rollback if any error occurs
            $conn->rollback();
            die("Error: " . $e->getMessage());
        }
    } else {
        // If the role is not 'cleaner', delete only from the users table
        $stmt = $conn->prepare("DELETE FROM cleanusers WHERE userid = ?");
        $stmt->bind_param("i", $userid);
        $stmt->execute();
        header("Location: ../view/usermanagement.php");
        exit;
    }
}

// Handle user update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])) {
    $userid = $_POST['userid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];

    // Validate inputs
    if (empty($fname) || empty($lname) || empty($email)) {
        die("All fields are required for update.");
    }

    $stmt = $conn->prepare("UPDATE cleanusers SET fname = ?, lname = ?, email = ? WHERE userid = ?");
    $stmt->bind_param("sssi", $fname, $lname, $email, $userid);
    $stmt->execute();
    header("Location: ../view/usermanagement.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="icon" href="../assets/images/art-icon.png">
</head>
<body>

        <style>
            

        .table {
            width: 100%;
            margin: 0 auto;
            font-size: 16px;  /* Larger font size */
        }
        .table th, .table td {
            padding: 15px;  /* Larger padding */
            text-align: center;  /* Center the content */
        }



        </style>
            <div class="container-fluid">
                <div class="row">
                    <!-- Sidebar -->
                    <aside class="sidebar bg-light border-end vh-100 col-md-3" style="width: 200px; height: 100%; position: fixed;">

                        <nav class="nav flex-column">
                            <a class="nav-link text-dark d-flex align-items-center mb-3" href="../view/index.php">
                                <img src="../assets/images/home.png" alt="home" class="me-2" width="24" height=""> Home
                            </a>
                            <hr>
                            <a class="nav-link text-dark d-flex align-items-center mb-3" href="../view/ServicesPage.php">
                                <img src="../assets/images/service.png" alt="Showcase" class="me-2" width="24" height="24"> Service Page
                            </a>
                          
                            <hr>
                            <a class="nav-link text-dark d-flex align-items-center" href="../view/ManageServices.php">
                                <img src="../assets/images/manage.png" alt="reel page" class="me-2" width="24" height="24"> Service Management
                            </a>
                            <hr>
                            <a  class="nav-link text-dark d-flex align-items-center" href="../view/AdminDashboard.php">
                                <img src="../assets/images/dashboard.png" alt="Dashboard page" class="me-2" width="24" height="24">Dashboard
                            </a>
                            <hr>

                            

                        </nav>
                    </aside>

                    <!-- Main Content -->
                    <main class="col-md-9" style="margin-left: 220px;">

                        <header class="bg-primary text-white p-3">
                        <h1 id="Users List">User Management</h1>
                        </header>
                        <div class="container my-4 ">
                        <h2 class="text-center">Manage Users</h2>

        <!-- Form to Add New User -->
        <form method="POST" class="mb-4 p-3 border rounded">
            <h3>Add New User</h3>
            <div class="row g-3">
                <div class="col-md-3">
                    <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                </div>
                <div class="col-md-3">
                    <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                </div>
                
                <div class="col-md-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="col-md-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
            </div>
            <button type="submit" name="create_user" class="btn btn-success mt-3">Add User</button>

        </form>



        <!-- Display Users in Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $userResult = fetchUsers($conn);
                    if ($userResult->num_rows > 0) {
                        while ($user = $userResult->fetch_assoc()) {
                            echo "<tr>
                                <td>{$user['fname']} {$user['lname']}</td>
                                <td>{$user['email']}</td>
                                 <td>{$user['role']}</td>
                                <td>
                                    <form method='POST' class='d-inline'>
                                        <input type='hidden' name='userid' value='{$user['userid']}'>
                                        <button type='submit' name='delete_user' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</button>
                                    </form>
                                    <form method='POST' class='d-inline'>
                                        <input type='hidden' name='userid' value='{$user['userid']}'>
                                        <input type='text' name='fname' value='{$user['fname']}' class='form-control d-inline w-auto' required>
                                        <input type='text' name='lname' value='{$user['lname']}' class='form-control d-inline w-auto' required>
                                        <input type='email' name='email' value='{$user['email']}' class='form-control d-inline w-auto' required>
                                        <button type='submit' name='update_user' class='btn btn-primary btn-sm'>Update</button>
                                        
                                    </form>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No users found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        

        

</div>


        


   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
