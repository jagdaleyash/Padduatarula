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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM logs WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "Log not found";
        exit;
    }
} else {
    echo "No log ID specified";
    exit;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Log</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Log</h1>
        <form id="workLogForm" action="log.php" method="POST">
            <input type="hidden" name="log_id" value="<?php echo $row['id']; ?>">
            
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" value="<?php echo $row['log_date']; ?>" required><br>
            
            <label for="inTime">In Time:</label>
            <input type="time" id="inTime" name="in_time" value="<?php echo $row['in_time']; ?>" required><br>
            
            <label for="outTime">Out Time:</label>
            <input type="time" id="outTime" name="out_time" value="<?php echo $row['out_time']; ?>" required><br>
            
            <label for="workLog">Work Log:</label>
            <textarea id="workLog" name="work_log" required><?php echo $row['work_log']; ?></textarea><br>

            <label for="activity">Activity:</label>
            <input type="text" id="activity" name="activity" value="<?php echo $row['activity']; ?>" required><br>

            <label for="skill">Skill:</label>
            <input type="text" id="skill" name="skill" value="<?php echo $row['skill']; ?>" required><br>

            <label for="level">Level:</label>
            <select id="level" name="level" required>
                <option value="Beginner" <?php if ($row['level'] == 'Beginner') echo 'selected'; ?>>Beginner</option>
                <option value="Intermediate" <?php if ($row['level'] == 'Intermediate') echo 'selected'; ?>>Intermediate</option>
                <option value="Advanced" <?php if ($row['level'] == 'Advanced') echo 'selected'; ?>>Advanced</option>
                <option value="Mastered" <?php if ($row['level'] == 'Mastered') echo 'selected'; ?>>Mastered</option>
            </select><br>
            
            <label for="nextDayPlan">Plan for Next Day:</label>
            <textarea id="nextDayPlan" name="next_day_plan" required><?php echo $row['next_day_plan']; ?></textarea><br>
            
            <label for="nextWeekPlan">Plan for Next Week:</label>
            <textarea id="nextWeekPlan" name="next_week_plan" required><?php echo $row['next_week_plan']; ?></textarea><br>
            
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
