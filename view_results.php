<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];

$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "student_results";

// Create connection
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$results = array();
$sql = "";

if ($role === 'student') {
    // Query results for student
    $sql = "SELECT r.id, s.name, s.roll_number, r.subject, r.marks 
            FROM results r 
            JOIN students s ON r.student_id = s.id 
            WHERE s.username = ?";
    
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Error preparing statement: ' . $conn->error);
    }
    
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result === false) {
        die('Error executing statement: ' . $stmt->error);
    }
    
    while ($row = $result->fetch_assoc()) {
        $results[] = $row;
    }

    $stmt->close();
} else {
    // Query all results for teacher and admin
    $sql = "SELECT r.id, s.name, s.roll_number, r.subject, r.marks 
            FROM results r 
            JOIN students s ON r.student_id = s.id";

    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>View Results</title>
    <style>
        /* Add your custom CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-image: linear-gradient(90deg, rgb(43, 77, 130),rgb(40, 144, 172));
            background-repeat: no-repeat;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: start;
            align-items: center;
            flex-direction: column;
            color: #fff;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            overflow-x: auto;
        }
        
        @media screen and (max-width: 600px) {
            table {
            display: block;
            white-space: nowrap;
            overflow-x: auto;
            }
        
        }

        th, td {
            padding: 10px;
            padding-left: 20px;
            text-align: left;
            border-bottom: 1px solid #AAA;
        }

        th {
            background-color: #333;
        }

        .back {
            color: #fff;
            text-decoration: none;
            font-size: 20px;
            margin-left: 10px;
            background-color: #007B00;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .back:hover {
            background: #004C00;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
        }

        .h1 {
            margin-top: 80px;
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
    <h1 class="h1">Results</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Roll Number</th>
                <th>Subject</th>
                <th>Marks</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($results)): ?>
                <?php foreach ($results as $result): ?>
                    <tr>
                        <td><?php echo $result['id']; ?></td>
                        <td><?php echo $result['name']; ?></td>
                        <td><?php echo $result['roll_number']; ?></td>
                        <td><?php echo $result['subject']; ?></td>
                        <td><?php echo $result['marks']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No results found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <br>
    <a class="back" href="dashboard.php">Back to Dashboard</a>

</body>
</html>
