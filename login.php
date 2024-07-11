<?php
// Include database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_results";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// User authentication
session_start();
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!-- Login Page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-image: linear-gradient(90deg, rgb(43, 77, 130),rgb(40, 144, 172));
        background-repeat: no-repeat;
        background-size: cover;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;    
    }

    .card {
        background: rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(30px);
    }

    .container {
        margin-top: 50px;
    }

    .form-group input {
        border: 1px solid #AAA;
        padding: 10px 20px;
        color: #FFF;
    }

    .form-group input::placeholder {
        color: #AAA;
    }

    .login {
        width: 100%;
        margin: 20px 0;
        padding: 10px 0;
    }

    .form-control:focus {
        color: #FFF;
    }

    .alert {
        width: 100%;
        position: fixed;
        border-radius: 0;
        top: 5px;
        left: 0;
    }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark text-white fixed-top" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SRMS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>" href="dashboard.php">Dashboard</a>
                </li>
                <?php if (isset($_SESSION['username'])): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'view_results.php' ? 'active' : ''; ?>" href="view_results.php">Results</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'register.php' ? 'active' : ''; ?>" href="register.php">Register</a>
                </li>
                <?php if (!isset($_SESSION['username'])): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'login.php' ? 'active' : ''; ?>" href="login.php">Login</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php endif; ?>
            </ul>
            </div>
        </div>
    </nav>
    <div id="message">
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header text-light fs-2 text-center bg-transparent">Login</div>
                        <div class="card-body mt-4">
                            <form class="text-light" id="loginForm" method="POST" data-bs-theme="dark">
                                <div class="form-group mb-3">
                                    <input type="text" id="username" name="username" class="form-control bg-transparent" required placeholder="Username">
                                </div>
                                <div class="form-group mb-2 text-light">
                                    <input type="password" id="password" name="password" class="form-control bg-transparent" required placeholder="Password">
                                </div>
                                <button type="submit" name="login" class="btn btn-success login">Log in</button>
                            </form>
                        </div>  
                    </div>         
                </div>
            </div>
            <center> <p class="mt-3 text-center border-bottom border-light pt-3 pb-4" style="width: 80%;"><a href="reset_password_request.php" class="link-light link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">Forgotten password?</a></p>
            <button type="button" class="btn btn-light mt-3 mb-5" style="width: 15rem;"><a class="nav-link" href="register.php">Create account</a></button></center>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> 
    <script>
                        document.getElementById("loginForm").addEventListener("submit", function(event) {
                            event.preventDefault(); // Prevent form submission

                            var username = document.getElementById("username").value;
                            var password = document.getElementById("password").value;

                            // Create a new XMLHttpRequest object
                            var xhr = new XMLHttpRequest();

                            // Configure the request
                            xhr.open("POST", "login_action.php", true);
                            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                            // Handle the response
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState === XMLHttpRequest.DONE) {
                                    if (xhr.status === 200) {
                                        // Request was successful
                                        var response = xhr.responseText;
                                        if (response === "Login successful.") {
                                            // Redirect to the home page
                                            document.getElementById("message").innerHTML = "<div class='alert alert-success alert-dismissible fade show mt-5' role='alert'>Login successful. <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                                            setTimeout(() => {
                                                window.location.href = "dashboard.php";
                                            }, 1000);
                                        } else {
                                            // Display the error message
                                            document.getElementById("message").innerHTML = "<div class='alert alert-danger alert-dismissible fade show mt-5' role='alert'>" + response + "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                                        }
                                    } else {
                                        // Request failed
                                        alert("An error occurred. Please try again.");
                                    }
                                }
                            };

                            // Send the request
                            xhr.send("username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password));
                        });
                    </script>
</body>
</html>