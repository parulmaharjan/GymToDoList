
<?php
session_start();
require_once("../database/config.php");

// Create a database connection
$mysqli = new mysqli(host, user, password, db);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Get user input from the subscription form
$selectedPackageId = $_POST["package"]; // Updated to get packageId

// Get the username from the session (assuming the user is logged in)
$username = $_SESSION["username"];

// Check if the user is registered (their data exists in the user table)
$query = "SELECT * FROM registereduser WHERE username = ?";

$stmt = $mysqli->prepare($query);

if ($stmt) {
    // Bind parameter and execute the query
    $stmt->bind_param("s", $username);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // User is registered, proceed with subscription

        // Retrieve the packageId based on the selected package
        $packageQuery = "SELECT packageId FROM package WHERE packageId = ?"; // Assuming the package table has a packageId column

        $packageStmt = $mysqli->prepare($packageQuery);

        if ($packageStmt) {
            // Bind parameter and execute the query
            $packageStmt->bind_param("i", $selectedPackageId);
            $packageStmt->execute();

            // Get the result
            $packageResult = $packageStmt->get_result();

            if ($packageResult->num_rows === 1) {
                // Package exists, insert the subscription data into the database
                $subscriptionQuery = "INSERT INTO userSubscriptions (username, package_id) VALUES (?, ?)";

                $subscriptionStmt = $mysqli->prepare($subscriptionQuery);

                if ($subscriptionStmt) {
                    // Bind parameters and execute the query
                    $subscriptionStmt->bind_param("si", $username, $selectedPackageId);

                    if ($subscriptionStmt->execute()) {
                        echo "Subscription successful!";
                    } else {
                        echo "Error: " . $subscriptionStmt->error;
                    }

                    // Close the subscription statement
                    $subscriptionStmt->close();
                } else {
                    echo "Error: " . $mysqli->error;
                }
            } else {
                echo "Selected package not found.";
            }

            // Close the package statement
            $packageStmt->close();
        } else {
            echo "Error: " . $mysqli->error;
        }
    } else {
        echo "User is not registered. Please register.";
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Error: " . $mysqli->error;
}

// Close the database connection
$mysqli->close();
?>
