<?php
// Establish a database connection (you should have database credentials here)
require_once("../database/config.php");

$conn = new mysqli(host, user, password, db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the "packages" table
$sql = "SELECT  packageName FROM packages";
$result = $conn->query($sql);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT packageID FROM packages";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<li><label><input type="checkbox" name="packages[]" value="' . $row["packageID"] . '">' . $row["packageID"] . '</label></li>';
    }
}

$conn->close();