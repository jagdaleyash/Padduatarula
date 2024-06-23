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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $in_time = $_POST['in_time'];
    $out_time = $_POST['out_time'];
    $work_log = $_POST['work_log'];
    $activity = $_POST['activity'];
    $skill = $_POST['skill'];
    $level = $_POST['level'];
    $next_day_plan = $_POST['next_day_plan'];
    $next_week_plan = $_POST['next_week_plan'];

    $date = mysqli_real_escape_string($conn, $date);
    $in_time = mysqli_real_escape_string($conn, $in_time);
    $out_time = mysqli_real_escape_string($conn, $out_time);
    $work_log = mysqli_real_escape_string($conn, $work_log);
    $activity = mysqli_real_escape_string($conn, $activity);
    $skill = mysqli_real_escape_string($conn, $skill);
    $level = mysqli_real_escape_string($conn, $level);
    $next_day_plan = mysqli_real_escape_string($conn, $next_day_plan);
    $next_week_plan = mysqli_real_escape_string($conn, $next_week_plan);

    if (isset($_POST['log_id'])) {
        // Update existing log
        $log_id = $_POST['log_id'];
        $sql = "UPDATE logs 
                SET log_date='$date', in_time='$in_time', out_time='$out_time', work_log='$work_log', activity='$activity', skill='$skill', level='$level', next_day_plan='$next_day_plan', next_week_plan='$next_week_plan' 
                WHERE id=$log_id";
    } else {
        // Insert new log
        $sql = "INSERT INTO logs (log_date, in_time, out_time, work_log, activity, skill, level, next_day_plan, next_week_plan) 
                VALUES ('$date', '$in_time', '$out_time', '$work_log', '$activity', '$skill', '$level', '$next_day_plan', '$next_week_plan')";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: view_logs.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request method";
}

$conn->close();
?>
