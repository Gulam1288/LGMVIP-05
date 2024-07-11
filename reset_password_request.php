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
<div id="message"></div>
    <div class="container">
        <div class="row justify-content-center flex-col">
            <div class="col-md-6">
                <div class="card shadow pt-3">
                    <div class="card-header fs-2 text-center bg-transparent text-light">Request Reset Password</div>
                    <div class="card-body mt-2 text-light">
                        <form id="resetRequest" method="POST" data-bs-theme="dark">
                            <div class="form-group mb-2">
                                <input class="form-control bg-transparent" type="email" id="email" name="email" placeholder="Email" required>
                            </div>
                            <button class="btn btn-success login mt-3" type="submit">Request Password Reset</button>
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
        function submitForm() {
            var email = document.getElementById('email').value;
            document.getElementById("message").innerHTML = "<div class='alert alert-info alert-dismissible fade show mt-5' role='alert'>Your email is being verified and the reset link is being prepared. Please wait!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";

            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            // Prepare the request
            xhr.open('POST', 'reset_password_request_action.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            // Set up the callback function
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Request was successful
                    var response = xhr.responseText;
                    if (response === 'Password reset link sent to your email.') {
                        document.getElementById("message").innerHTML = "<div class='alert alert-success alert-dismissible fade show mt-5' role='alert'>Password reset link sent to your email. <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                    } else {
                        document.getElementById("message").innerHTML = "<div class='alert alert-danger alert-dismissible fade show mt-5' role='alert'>Error: " + response + " <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                    }
                } else {
                    // Request failed
                    document.getElementById("message").innerHTML = "<div class='alert alert-danger alert-dismissible fade show mt-5' role='alert'>Error: " + xhr.status + " <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                }
            };

            // Send the request
            xhr.send('email=' + email);
        }

        document.getElementById("resetRequest").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent form submission
            submitForm();
        });
    </script>
</body>
</html>
