<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: linear-gradient(90deg, rgb(43, 77, 130), rgb(40, 144, 172));
            background-repeat: no-repeat;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .container {
            background-color: #232222;
            padding: 20px;
            width: 80%;
            max-width: 800px;
            text-align: center;
            margin-top: 50px;
        }

        h1 {
            color: #fff;
        }

        h2 {
            color: #fff;
            margin-bottom: 20px;
        }

        p {
            color: #fff;
            margin-bottom: 20px;
        }

        .section {
            padding: 40px 20px;
            margin: 20px 0;
            border-radius: 8px;
            background-color: rgba(0, 0, 0, 0.8);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
        }

        .btn-custom {
            margin: 10px;
            padding: 10px 20px;
            border-radius: 5px;
        }

        @media (max-width: 768px) {
            .container {
            width: 90%;
            }
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark text-light navbar-dark fixed-top" data-bs-theme="dark">
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
    <h1 data-aos="fade-down">Dashboard</h1>
    <div class="section" data-aos="fade-right">
        <?php if ($role == 'admin'): ?>
            <h2>Admin Panel</h2>
            <p>Welcome, Admin. Here you can manage users and view all results.</p>
            <a href="manage_users.php" class="btn btn-primary btn-custom">Manage Users</a>
            <a href="view_results.php" class="btn btn-success btn-custom">View All Results</a>
        <?php elseif ($role == 'teacher'): ?>
            <h2>Teacher Panel</h2>
            <p>Welcome, Teacher. Here you can manage student results.</p>
            <a href="add_or_edit_result.php" class="btn btn-primary btn-custom">Add Results</a>
            <a href="view_results.php" class="btn btn-success btn-custom">View Results</a>
        <?php elseif ($role == 'student'): ?>
            <h2>Student Panel</h2>
            <p>Welcome, Student. Here you can view your results.</p>
            <a href="view_results.php" class="btn btn-success btn-custom">View My Results</a>
        <?php endif; ?>
    </div>
    <div class="section" data-aos="fade-left">
        <h2>Notifications</h2>
        <p>Btech 3-1 results are released check now.</p>
    </div>
    <div class="section" data-aos="fade-up">
        <h2>Profile</h2>
        <p>Update your profile information here.</p>
        <a href="profile.php" class="btn btn-info btn-custom">Update Profile</a>
    </div>
    <a href="logout.php" class="btn btn-danger btn-custom">Logout</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
</body>
</html>
