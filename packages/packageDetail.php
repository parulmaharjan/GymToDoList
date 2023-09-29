<?php
require_once("../database/config.php");

// Create a MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to insert data from JSON
function insertDataFromJson($conn, $jsonFile, $packageName)
{
    // Check if the JSON file exists and can be read
    if (file_exists($jsonFile)) {
        $jsonData = file_get_contents($jsonFile);
        $data = json_decode($jsonData, true);

        if ($data && isset($data[$packageName])) {
            // Loop through the days and exercises in the JSON data
            foreach ($data[$packageName] as $day => $exercises) {
                $day = $conn->real_escape_string($day);
                $exercises = $conn->real_escape_string(json_encode($exercises));

                // Get the packageId based on the package name
                $packageId = getPackageId($conn, $packageName);

                if ($packageId !== false) {
                    // Insert data into the database
                    $stmt = $conn->prepare("INSERT INTO packageDetail (packageId, day, Exercise1) VALUES (?, ?, ?)");
                    $stmt->bind_param("iss", $packageId, $day, $exercises);

                    if ($stmt->execute()) {
                        echo "Data inserted successfully for $packageName, day: $day.<br>";
                    } else {
                        echo "Error: " . $conn->error;
                    }
                } else {
                    echo "Package not found: $packageName";
                }
            }
        } else {
            echo "Error parsing JSON file: $jsonFile";
        }
    } else {
        echo "JSON file not found: $jsonFile";
    }
}

// Function to get the packageId based on the package name
function getPackageId($conn, $packageName)
{
    $stmt = $conn->prepare("SELECT packageId FROM package WHERE packageName = ?");
    $stmt->bind_param("s", $packageName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        return $row["packageId"];
    } else {
        return false;
    }
}

// Call the function for each JSON file and package name
insertDataFromJson($conn, "../exercise/cardio.json", "Cardio");
insertDataFromJson($conn, "../exercise/weightloss.json", "WeightLoss");
insertDataFromJson($conn, "../exercise/muscleGain.json", "Muscular");
insertDataFromJson($conn, "../exercise/general.json", "General");

// Close the database connection
$conn->close();
?>
