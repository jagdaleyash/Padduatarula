<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";    // Replace with your database username
    $password = "";        // Replace with your database password
    $dbname = "work_log_db"; // Replace with your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username_input = $_POST['username'] ?? '';
    $password_input = $_POST['password'] ?? '';

    $username_input = mysqli_real_escape_string($conn, $username_input);
    $password_input = mysqli_real_escape_string($conn, $password_input);

    $sql = "SELECT * FROM users WHERE username = '$username_input' AND password = '$password_input'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username_input;
        header('Location: mood.html');
        exit;
    } else {
        header('Location: login.html?error=1');
        exit;
    }

    $conn->close();
} else {
    http_response_code(405);
    echo "Error 405: Method Not Allowed";
    error_log("Error 405: Method Not Allowed", 0);
    exit;
}

// Add this at the end of the file
if (!empty($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']!= 'POST') {
    http_response_code(405);
    echo "Error 405: Method Not Allowed";
    error_log("Error 405: Method Not Allowed", 0);
    exit;
}
?>
