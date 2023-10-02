<?php

$jsonFiles = ['cardio.json', 'weightLoss.json', 'muscleGain.json', 'general.json'];


require_once("../database/config.php");


$mysqli = new mysqli(host, user, password, db);


if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

//  mapping of package names to package IDs
$packageMapping = [
    'cardio' => 'A101',
    'weightLoss' => 'A102',
    'muscleGain' => 'A103',
    'general' => 'A104'
];

//looping
foreach ($jsonFiles as $jsonFile) {
    //json read
    $jsonData = file_get_contents($jsonFile);

    // json decoded
    $data = json_decode($jsonData, true);

    //getting package name form file

    $packageName = pathinfo($jsonFile, PATHINFO_FILENAME);

    // getting the corresponding package ID from the mapping
    $packageId = $packageMapping[$packageName];


    foreach ($data[$packageName] as $day => $dayData) {
        foreach ($dayData['Exercise1'] as $exercise) {
            //data insertion
            $insert_query = "INSERT INTO exerciseDetails (packageID, packageName, day, exercise) VALUES (?, ?, ?, ?)";
            $stmt = $mysqli->prepare($insert_query);
            $stmt->bind_param("ssss", $packageId, $packageName, $day, $exercise);
            if ($stmt->execute()) {
                echo "Data inserted successfully.<br>";
            } else {
                echo "Error: " . $stmt->error . "<br>";
            }
            $stmt->close();
        }
    }
}
$mysqli->close();

