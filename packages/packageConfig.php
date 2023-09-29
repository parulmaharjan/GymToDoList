//for table package

<!-- <?php
//database credentials
require_once("../database/config.php");


//for connection
$conn = new mysqli(host, user, password, db);

// Checking if connection sucess or not
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//   inserting value to package table 
$packageIds = [101, 102, 103, 104];
$packageNames = ["Cardio", "WeightLoss", "MusclesBuilding", "General"];

$sql = "INSERT INTO package (packageId, packageName) VALUES (?, ?)";
$stmt = $conn->prepare($sql);

for ($i = 0; $i < count($packageIds); $i++) {
    $stmt->bind_param("is", $packageIds[$i], $packageNames[$i]);
    
    if ($stmt->execute()) {
        echo "Data inserted for packageId {$packageIds[$i]} successfully.<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }
}

// closing the connection
//arrow operation used to call methods ->
$stmt->close();
$conn->close();
?> -->
