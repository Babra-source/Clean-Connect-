<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clean Connect | Login</title>
    <link rel="stylesheet" href="../assets/css/register.css"> 
</head>



<body style = "background-image: url('../assets/images/background.jpg')">

    

    <div class="form-container">
        <h1><b>The Clean Connect Hub</b></h1>
        <p><b>Login</b></p>
        <form action="../actions/login_user.php" method = "post" onsubmit= "return formvalidate()" >
            <input type="email" id="email" placeholder="Enter Email"  name = "email"  required><br>
            <input type="password" id="password" placeholder="Enter Password" name = "password" required><br>
            <span id="passwordError" style="color:rgb(255, 3, 3);"></span><br><br>

            <!-- Error Message Container -->
            <div id="loginError" style="color: red;"></div>
            <div id="loginSuccess" style="color: green;"></div>

            <button type=submit onsubmit= "return formvalidate() "><b>Login</b></button><br><br>
            <p>Don't have an account? <a href="../view/Register.php"><b>Sign up</b></a></p>
            <p>Don't have an account? <a href="../view/BeACleaner.php"><b>Be A Cleaner</b></a></p>
        </form>
    </div>

    <script>
           function formvalidate() {
           
           var email = document.getElementById("email").value;
           var password = document.getElementById("password").value;
           var errorMessages = [];
           var passwordError = document.getElementById("passwordError");

           passwordError.textContent = "";

           
           var emailPattern = ^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$;
           if (email === "") {
               errorMessages.push("Email is required!");
           } else if (!emailPattern.test(email)) {
               errorMessages.push("Invalid email format");
           }

           
           if (password.length < 8) {
               errorMessages.push("Password must be at least 8 characters!");
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

         
           if (errorMessages.length > 0) {
               passwordError.innerHTML = errorMessages.join("<br>");
           } else {
               
               document.getElementById("loginForm").submit();
               document.getElementById("email").value = "";
               document.getElementById("password").value = "";
           }
       }
       </script>

</body>
</html>
