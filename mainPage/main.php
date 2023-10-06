<?php
 
 session_start();
 $username = $_SESSION['username'];
 ?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="main.css" />
  <title>Gym To-Do List</title>
</head>

<body>
  <div class="form-container">
    <form id="gym-form" method="post" action="../logs/log.php">
      <label for="day-select" style="color: #6495ed">Select Day:</label>
      <select id="day-select" name="selected_day" style="margin-top: 20px; color: #6495ed">
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

      <button type="submit" id="generate" style="color: #ffffff; background-color: #6495ed">
        <b>Generate To-Do List</b>
      </button>
      <input type="hidden" id="username" name="username" value="<?php echo $username; ?>">
<input type="hidden" id="selected_day" name="selected_day" value="">
<input type="hidden" id="total_exercise" name="total_exercise" value="">

    </form>
    <!-- Add these hidden input fields to store data -->


  </div>
  <div class="exercise-container"   > 
  <div class="to-do-list" id="to-do-list">
    <?php
    
    require_once("../database/config.php");
    $conn = new mysqli(host, user, password, db);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $selected_day = isset($_POST['selected_day']) ? $_POST['selected_day'] : "";
    $username = $_SESSION['username'];
    if (isset($_POST['selected_day']) && isset($_SESSION['username'])) {
      $selected_day = $_POST['selected_day'];
      $username = $_SESSION['username'];
    }
    $sql = "SELECT exercise
        FROM exercisedetails, usersubscription
        WHERE exercisedetails.packageId = usersubscription.packageId
        AND day = '$selected_day'
        AND username = '$username';";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      header(" main.html");
      echo '<label><input type="checkbox" name="exercise" value="' . $row['exercise'] . '"> ' . $row['exercise'] . '</label><br>  ';
    }}
    $conn->close();
    ?>
  </div>
  <button>done</button>
  </div>
 




  <div class="button-container" style="text-decoration: none;">
    <button id="logout">
      <a href="../logout/logout.php">Logout</a></button>
    <button id="report">
      <a href="../reportAndReview/report.html">report</a>
    </button>
  </div>

  <script src="main.js" />
  <script>
    document.getElementById("done-for-today").addEventListener("click", function() {
      document.getElementById("gym-form").submit();
    });

    function markSelectedDay() {
    const daySelect = document.getElementById("day-select");
    const selectedDay = "<?php echo $selected_day; ?>";
    if (selectedDay) {
      const option = daySelect.querySelector(`option[value='${selectedDay}']`);
      if (option) {
        option.selected = true;
      }
    }
  }

  // Call the function when the page loads
  window.addEventListener("load", markSelectedDay);
  </script>

</body>

</html> 