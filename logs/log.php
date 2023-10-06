<?php
session_start();
require_once("../database/config.php");
$conn = new mysqli(host, user, password, db);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get data from the form
$username = $_POST['username'];
$selectedDay = $_POST['selected_day'];
$totalExercise = $_POST['total_exercise'];

// Insert data into the "logs" table
$sql = "INSERT INTO logs (username, selected_day, total ) VALUES ('$username', '$selectedDay', '$totalExercise')";

if ($conn->query($sql) === TRUE) {
  echo "Data inserted successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
