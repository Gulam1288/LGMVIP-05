<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_results";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Check if username already exists
    $checkUsernameQuery = "SELECT * FROM users WHERE username = '$username'";
    $checkUsernameResult = $conn->query($checkUsernameQuery);
    if ($checkUsernameResult->num_rows > 0) {
        echo "Username already exists!";
        exit;
    }

    // Check if email already exists
    $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
    $checkEmailResult = $conn->query($checkEmailQuery);
    if ($checkEmailResult->num_rows > 0) {
        echo "Email already exists!";
        exit;
    }

    if($role == 'student'){
        $rollnumber = $_POST['rollnumber'];
        $checkRollNumberQuery = "SELECT * FROM students WHERE roll_number = '$rollnumber'";
        $checkRollNumberResult = $conn->query($checkRollNumberQuery);
        if ($checkRollNumberResult->num_rows > 0) {
            echo "Roll number already exists!";
            exit;
        }
    }
    $newstmt = $conn->prepare("INSERT INTO students (username, name, roll_number) VALUES (?, ?, ?)");

    $newstmt->bind_param("sss",$username, $fullname, $rollnumber);
    if($role == 'student'){
        $fullname = $_POST['fullname'];
        $rollnumber = $_POST['rollnumber'];
        $newstmt->execute();
    }
    $stmt = $conn->prepare("INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $password, $email, $role);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
