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
?>


<!-- Reset Password Page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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

        .form-control::placeholder {
            color: #555;
            opacity: 1;
        }

        .form-control:-ms-input-placeholder {
            color: #555;
        }

        .form-control::-ms-input-placeholder {
            color: #555;
        }

        .form-group input {
             padding: 10px 20px;
        }

        .card {
            backdrop-filter : blur(30px);
            background: rgba(0, 0, 0, 0.2);
        }

        .form-group input {
            border: 1px solid #AAA;
            padding: 10px 20px;
        }

        .form-group input::placeholder {
            color: #AAA;
        }

        .form-group select {
            padding: 10px 20px;
        }

        .form-control:focus {
        color: #FFF;
    }

        .login {
            width: 100%;
            margin: 20px 0;
            padding: 10px 0;
        }

        select option {
            color: #000;
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
    <div class="container">
        <div class="row justify-content-center flex-col">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header fs-2 text-center bg-transparent text-light">Reset Password</div>
                    <div class="card-body mt-4 text-light">
                        <form id="resetForm" method="POST" data-bs-theme="dark">
                            <div class="form-group mb-2">
                                <input type="password" id="new_password" name="new_password" class="form-control bg-transparent" required placeholder="New Password">
                            </div>
                            <center><button type="submit" name="reset" class="btn btn-success login mt-3">Reset password</button></center>
                        </form>
                    </div>           
                </div>
            </div>
        </div>
        <center>
            <button type="button" class="btn btn-light mt-5" style="width: 15rem;"><a class="nav-link" href="login.php">Back to Login</a></button>
        </center>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> 
    <script>
        // Function to get token from URL query string
        function getTokenFromUrl() {
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            return urlParams.get('token');
        }

        // Function to handle form submission via JavaScript
        document.getElementById('resetForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission
            
            const token = getTokenFromUrl();
            const newPassword = document.getElementById('new_password').value;

            if (token && newPassword) {
                // Construct data to send to reset_password.php
                const formData = new FormData();
                formData.append('token', token);
                formData.append('new_password', newPassword);

                // Send POST request to reset_password.php
                fetch('reset_action.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    document.getElementById('message').innerHTML = '<div class="alert alert-success alert-dismissible fade show mt-5" role="alert">' + data + ' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    setTimeout(() => {
                        window.location.href = 'login.php';
                    }, 1500);
                })
                .catch(error => {
                    document.getElementById('message').innerHTML = '<div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">Error: ' + error + ' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                });
            } else {
                // Handle missing token or password
                document.getElementById('message').innerHTML = '<div class="alert alert-warning alert-dismissible fade show mt-5" role="alert">Token or password missing. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }
        });
    </script>
</body>
</html>