
<?php
session_start();
require_once("../database/config.php");

$conn = new mysqli(host, user, password, db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$selected_day = isset($_POST['selected_day']) ? $_POST['selected_day'] : '';
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

if (empty($selected_day) || empty($username)) {
    echo "Day and username are not set.";
} else {
    $sql = "SELECT exercise
            FROM exercisedetails, usersubscription
            WHERE exercisedetails.packageId = usersubscription.packageId
            AND day = '$selected_day'
            AND username = '$username';";
    
    $result = mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="main.css" />
    <title>Gym To-Do List</title>
</head>
<body>
<div class="form-container">
    <form id="gym-form" action="main.php" method="post">
        <label for="day-select" style="color: #6495ed">Select Day:</label>
        <select id="day-select" name="selected_day"  style="margin-top: 20px; color: #6495ed">
          <option value="Day1">Day1</option>
          <option value="Day2">Day2</option>
          <option value="Day3">Day3</option>
          <option value="Day4">Day4</option>
          <option value="Day5">Day5</option>
          <option value="Day6">Day6</option>
          <option value="Day7">Day7</option>
          <option value="Day8">Day8</option>
          <option value="Day9">Day9</option>
          <option value="Day10">Day10</option>
          <option value="Day11">Day11</option>
          <option value="Day12">Day12</option>
          <option value="Day13">Day13</option>
          <option value="Day14">Day14</option>
          <option value="Day15">Day15</option>
          <option value="Day1">Day16</option>
          <option value="Day2">Day17</option>
          <option value="Day3">Day18</option>
          <option value="Day4">Day19</option>
          <option value="Day5">Day20</option>
          <option value="Day6">Day21</option>
          <option value="Day7">Day22</option>
          <option value="Day8">Day23</option>
          <option value="Day9">Day24</option>
          <option value="Day10">Day25</option>
          <option value="Day11">Day26</option>
          <option value="Day12">Day27</option>
          <option value="Day13">Day28</option>
          <option value="Day14">Day29</option>
          <option value="Day15">Day30</option>
        </select>

        <button
            type="submit"
            id="generate"
            style="color: #ffffff; background-color: #6495ed"
        >
            <b>Generate To-Do List</b>
        </button>
    </form>
</div>

<div class="to-do-list" id="to-do-list">
    <?php
    if (isset($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<label><input type="checkbox" name="exercise" value="' . $row['exercise'] . '"> ' . $row['exercise'] . '</label><br>';
        }
    }
    ?>
</div>

<div class="button-container">
    <button id="logout">
        <a href="../logout/logout.php">Logout</a>
    </button>
    <button id="report">
        <a href="../reportAndReview/report.html">report</a>
    </button>
</div>

<script src="main.js"></script>
</body>
</html>

<?php
if (isset($conn)) {
    $conn->close();
}
?>
