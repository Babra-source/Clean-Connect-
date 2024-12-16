<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clean Connect Hub | Sign Up</title>
    <link rel="stylesheet" href="../assets/css/register.css">
</head>

<body style="background-image: url('../assets/images/background.jpg')">

    <!-- Header Section -->
    <header>
        <div class="header-container">
            <h1><b>The Clean Connect Hub</b></h1>
        </div>
    </header>

    <!-- Banner Section -->
    <section class="banner">
        <h2><b>Welcome to Clean Connect Hub</b></h2>
        <p>Your platform for cleaners and customers to connect.</p>
    </section>

    <!-- Terms Section -->
    <section class="terms">
        <h3><b>Terms & Conditions</b></h3>
        <p>By signing up, you agree to the Clean Connect Hub Terms of Service and Privacy Policy.</p>
    </section>

    <!-- Sign-Up Section -->
    <section class="sign-up">
        <h2><b>Sign up As A Cleaner</b></h2>
        <form action="../actions/register_process.php" method="post" onsubmit="return validateForm()">
            <input type="text" id="firstName" name="firstname" placeholder="Enter First Name"><br>
            <input type="text" id="lastName" name="lastname" placeholder="Enter Last Name"><br>
            <input type="email" id="email" name="email" placeholder="Enter Email"><br>
            <select id="role" name="role" required style="display: none;">
                <option value="cleaner" selected>Cleaner</option>
                <option value="customer">Customer</option>
            </select>
            <input type="password" id="password" name="password" placeholder="New Password"><br>
            <input type="password" id="confirmPassword" name="confirm_password" placeholder="Confirm Password"><br>
            <button type="submit"><b>Sign up</b></button><br><br>
            <p>Already have an account? <a href="../view/login.php"><b>Sign in</b></a></p>
            <div id="passwordError" style="color: red;"></div>
            <div id="successMessage" style="color: green;"></div>
        </form>
    </section>

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
