<?php
// Assuming you've already started a session
session_start();
require_once("../database/config.php");

// Retrieve the username from the session
$username = $_SESSION['username'];

// Retrieve the selected package ID from the form submission
$selectedPackageID = $_POST['packageId']; // Make sure this matches the data attribute in your JavaScript code

// Perform database connection (you should configure this)
$mysqli = new mysqli(host, user, password, db);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Insert the user's subscription into the usersubscription table
$query = "INSERT INTO usersubscriptions (username, package_Id) VALUES (?, ?)"; // Assuming your table name is usersub

$stmt = $mysqli->prepare($query);

if ($stmt) {
    $stmt->bind_param("si", $username, $selectedPackageID);
    $stmt->execute();
    $stmt->close();
    
    // Subscription successfully recorded
    echo "Subscription successful!";
} else {
    // Error handling for the database query
    echo "Error: " . $mysqli->error;
}

// Close the database connection
$mysqli->close();
?>
