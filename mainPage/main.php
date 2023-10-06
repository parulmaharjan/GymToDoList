<?php
session_start();
$username = $_SESSION['username'];
$sql = "";
    require_once("../database/config.php");
    $conn = new mysqli(host, user, password , db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    if (isset($_POST['selected_day']) && isset($_POST['total_exercise'])) {
      $selectedDay = $_POST['selected_day'];
      $totalExercise = $_POST['total_exercise'];
      $sql = "INSERT INTO logs (username, selected_day, total) VALUES ('$username', '$selectedDay', '$totalExercise')";
    
      if ($conn->query($sql) === TRUE) {
          echo '<script language="javascript">';
          echo'alert(" your entry recorded, you can logout for today now")'
         
          ;
          echo'</script>';
         
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }  } 
  $conn->close();

      
   
    ?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="main.css" />
    <title>Gym To-Do List</title>
</head>
<body>
    <div class="form-container">
        <form id="gym-form" method="post" action="">
            <label for="day-select" style="color: #6495ed">Select Day:</label>
            <select id="day-select" name="selected_day" style="margin-top: 20px; color: #6495ed">
                <!-- Options here --> <option value="Day1">Day1</option>
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

            <button type="button" id="generate" style="color: #ffffff; background-color: #6495ed">
                <b>Generate To-Do List</b>
            </button>
            <input type="hidden" id="username" name="username" value="<?php echo $username; ?>">
            <input type="hidden" id="total_exercise" name="total_exercise" value="">
        </form>
    </div>

    <div class="exercise-container" style="display: none;">
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
            if (!$result) {
              die("Query failed: " . mysqli_error($conn));
          }
          // else{
          //   echo'query executed sucessfully';
          // }
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<label><input type="checkbox" name="exercise" value="' . $row['exercise'] . '"> ' . $row['exercise'] . '</label><br>  ';
                }
            }
            
            $conn->close();
            ?>
        </div>
        <button type="submit" name="done" id="done-for-today">Done</button>
    </div>

    <div class="button-container"   ">
        <button id="logout"  ">
            <a href="../logout/logout.php" style="text-decoration: none;">Logout</a>
        </button>
        <button id="report">
            <a href="../reportAndReview/report.html"  style="text-decoration: none;">report</a>
        </button>
    </div>

    <script src="main.js"></script>
    <script>
        document.getElementById("generate").addEventListener("click", function () {
            // Show the exercise container when the "Generate" button is clicked
            document.querySelector(".exercise-container").style.display = "block";
            // Generate exercise checkboxes here (you may use AJAX for this)
        });

        document.getElementById("done-for-today").addEventListener("click", function () {
            // Get data from the checkboxes
            const checkboxes = document.querySelectorAll('input[name="exercise"]:checked');
            const totalExercise = checkboxes.length;
            const selectedDay = document.getElementById("day-select").value;

            // Set the values of the hidden input fields
            document.getElementById("total_exercise").value = totalExercise;

            // Submit the form
            document.getElementById("gym-form").submit();
        });
    </script>
</body>
</html>
