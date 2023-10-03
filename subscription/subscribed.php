<?php
session_start();

// Connect to the MySQL database
require_once("../database/config.php");
$conn = new mysqli(host, user, password, db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the HTML form
if (isset($_POST['packageId'])) {
    $packageId = $_POST['packageId'];
} else {
    echo "Error: packageId not defined";
    exit;
}

$username = $_SESSION['username']; // Make sure the user is logged in and you have the session variable

// Insert data into the database
$sql = "INSERT INTO usersubscription (packageId, username, subscription_date) VALUES ('$packageId', '$username', NOW())";

if ($conn->query($sql) === TRUE) {
    header("Location: ../login/login.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>