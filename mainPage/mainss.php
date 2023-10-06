<?php
session_start(); 
require_once("../database/config.php");
$conn = new mysqli(host, user, password, db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$selected_day = $_POST['selected_day'];
$username = $_SESSION['username'];
if (isset($_POST['selected_day']) && isset($_SESSION['username'])) {
    $selected_day = $_POST['selected_day'];
    $username = $_SESSION['username'];
} else {
    echo "not set" ;
}
$sql = "SELECT exercise
        FROM exercisedetails, usersubscription
        WHERE exercisedetails.packageId = usersubscription.packageId
        AND day = '$selected_day'
        AND username = '$username';";

$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) { 
    header(" main.html");
            echo '<label><input type="checkbox" name="exercise" value="' . $row['exercise'] . '"> ' . $row['exercise'] . '</label><br>';
 } 
$conn->close();
?> 

     
   
