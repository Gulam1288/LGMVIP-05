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

<!-- Registration Page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
            border: 1px solid #AAA;
            padding: 10px 20px;
        }

        .card {
            backdrop-filter : blur(30px);
            background: rgba(0, 0, 0, 0.2);
        }

        .form-group input::placeholder {
            color: #AAA;
        }

        .form-group select {
            border: 1px solid #AAA;
            padding: 10px 20px;
        }

        .form-control:focus {
        color: #FFF;
    }

        .reg {
            width: 100%;
            margin: 20px 0;
            padding: 10px 0;
        }

        select option {
            color: #000;
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
                    <div class="card-header text-light fs-2 text-center bg-transparent">Register</div>
                <div class="card-body">
                    <form class="text-light" method="post" id="registrationForm" data-bs-theme="dark">
                        <div class="form-group mb-3">
                            <input class="form-control bg-transparent" type="text" id="username" name="username" placeholder="Username" required>
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" name="password" class="form-control bg-transparent" required maxlength="15" placeholder="Enter password">
                        </div>
                        <div class="form-group mb-3">
                            <input class="form-control bg-transparent" type="email" id="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="form-group mb-3">
                            <select class="form-select bg-transparent" id="role" name="role" onchange="showStudentFields()">
                                <option value="" selected>Select Role</option>
                                <option value="student">Student</option>
                                <option value="teacher">Teacher</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div id="studentFields" style="display:none;">
                            <div class="form-group mb-3">
                                <input class="form-control bg-transparent" type="text" id="fullname" name="fullname" placeholder="Full Name">
                            </div>
                            <div class="form-group mb-3">
                                <input class="form-control bg-transparent" type="text" id="rollnumber" name="rollnumber" placeholder="Roll Number">
                            </div>
                        </div>
                        <button type="submit" name="register" id="registerButton" class="btn reg btn-success">Register</button>
                    </form>
                </div>
            </div>
        </div>
        <p class="mt-3 text-center pt-3 text-light" style="width: 80%;">Already have an account? <a href="login.php" class="link-light link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">Login</a></p>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    function showStudentFields() {
        var role = document.getElementById("role").value;
        var studentFields = document.getElementById("studentFields");
        if (role === "student") {
            studentFields.style.display = "block";
        } else {
            studentFields.style.display = "none";
        }
    }

    function sendFormData() {
        var form = document.getElementById("registrationForm");
        var formData = new FormData(form);
        var role = document.getElementById("role").value;
        
        if (role === "") {
            document.getElementById("message").innerHTML = "<div class='alert alert-warning alert-dismissible fade show mt-5' role='alert'>Please select a role. <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "register_action.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = xhr.responseText;
                    if (response === "Registration successful!") {
                        document.getElementById("message").innerHTML = "<div class='alert alert-success alert-dismissible fade show mt-5' role='alert'>Registration successful. <a href='login.php' class='link-underline link-success link-offset-3'>Click to Login</a> <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                        setTimeout(() => {
                            window.location.href = "login.php";
                        }, 1500);
                    } else {
                        document.getElementById("message").innerHTML = "<div class='alert alert-danger alert-dismissible fade show mt-5' role='alert'>" + response + "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                    }
                } else {
                    document.getElementById("message").innerHTML = "<div class='alert alert-danger alert-dismissible fade show mt-5' role='alert'>An error occurred. Please try again. <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                }
            }
        };
        xhr.send(formData);
    }

    document.getElementById("registrationForm").addEventListener("submit", function(event) {
        event.preventDefault();
        sendFormData();
    });
</script>
</body>
</html>
