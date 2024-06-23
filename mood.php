<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.html");
    exit;
}

// Database credentials
$servername = "localhost";
$username = "root";    // Replace with your database username
$password = "";    // Replace with your database password
$dbname = "work_log_db";        // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch mood logging form data
    $mood = $_POST['mood'] ?? '';
    $happiness = $_POST['happiness'] ?? '';
    $anger = $_POST['anger'] ?? '';
    $sadness = $_POST['sadness'] ?? '';
    $description = $_POST['description'] ?? '';

    // SQL injection prevention: escape variables
    $mood = mysqli_real_escape_string($conn, $mood);
    $happiness = mysqli_real_escape_string($conn, $happiness);
    $anger = mysqli_real_escape_string($conn, $anger);
    $sadness = mysqli_real_escape_string($conn, $sadness);
    $description = mysqli_real_escape_string($conn, $description);

    // Prepare SQL statement to insert mood data into database
    $sql = "INSERT INTO mood_logs (mood, happiness, anger, sadness, description)
            VALUES ('$mood', '$happiness', '$anger', '$sadness', '$description')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.html"); // Redirect after successful submission
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // Invalid request method
    echo "Invalid request method";
}

$conn->close();
?>
