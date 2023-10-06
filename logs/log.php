<?php
session_start();
require_once("../database/config.php");
$conn = new mysqli(host, user, password, db);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$selectedDay = $_POST['selected_day'];
$totalExercise = $_POST['total_exercise'];
 

if (isset($_POST['generate'])) {
  // Your code for generating the exercise list...
} elseif (isset($_POST['done'])) {
  // Insert data into the "logs" table, assuming "done" is an existing column in the table
  $sql = "INSERT INTO logbook (username,total, done, day) VALUES ('$username',  '$totalExercise', '$doneExercise', '$selectedDay')";

  if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
?>