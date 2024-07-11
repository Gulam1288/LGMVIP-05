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
    if (isset($_POST['token'])) {
        $token = $_POST['token'];
        $new_password = $_POST['new_password'];

        // Sanitize inputs (if needed)
        $token = mysqli_real_escape_string($conn, $token);
        $new_password = mysqli_real_escape_string($conn, $new_password);

        // Verify token and get user ID
        $current_datetime = date("Y-m-d H:i:s");
        $sql = "SELECT id, token_expiry FROM users WHERE reset_token = '$token' AND token_expiry > '$current_datetime'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row['id'];

            // Update password (hashing the password)
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $sql_update = "UPDATE users SET password = '$hashed_password', reset_token = NULL, token_expiry = NULL WHERE id = $user_id";
            if ($conn->query($sql_update) === TRUE) {
                echo "Password has been reset!";
            } else {
                echo "Error updating password: " . $conn->error;
            }
        } else {
            echo "Invalid or expired token.";
        }
    } else {
        echo "Token is missing.";
    }
}

$conn->close();
?>
