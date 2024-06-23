<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.html");
    exit;
}

$servername = "localhost";
$username = "root";  // Change if needed
$password = "";      // Change if needed
$dbname = "work_log_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM logs ORDER BY log_date DESC";
$result = $conn->query($sql);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Logs</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>View Past Logs</h1>
        <a href="index.html">Add New Log</a>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='log'>";
                echo "<h2>" . $row["log_date"] . "</h2>";
                echo "<p><strong>In Time:</strong> " . $row["in_time"] . "</p>";
                echo "<p><strong>Out Time:</strong> " . $row["out_time"] . "</p>";
                echo "<p><strong>Work Log:</strong> " . $row["work_log"] . "</p>";
                echo "<p><strong>Activity:</strong> " . $row["activity"] . "</p>";
                echo "<p><strong>Skill:</strong> " . $row["skill"] . "</p>";
                echo "<p><strong>Level:</strong> " . $row["level"] . "</p>";
                echo "<p><strong>Plan for Next Day:</strong> " . $row["next_day_plan"] . "</p>";
                echo "<p><strong>Plan for Next Week:</strong> " . $row["next_week_plan"] . "</p>";
                echo "<a href='edit_log.php?id=" . $row["id"] . "'>Edit</a>";
                echo "</div>";
            }
        } else {
            echo "No logs found.";
        }
        ?>
    </div>
    <script src="script.js"></script>
</body>
</html>
