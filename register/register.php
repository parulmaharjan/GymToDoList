<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user registration data
    $firstName = $_POST["firstName"];
    $middleName = $_POST["middleName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phoneNumber"];
    $userName = $_POST["userName"];
    $password = $_POST["password"];

    // Replace these with your database credentials
    require_once("../database/config.php");

    // Create a MySQLi database connection
    $conn = new mysqli(host, user, password, db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Use prepared statements to prevent SQL injection
    $sql = "INSERT INTO registereduser (first_name, middle_name, last_name, email, phone_number, username, password)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters and execute the query
        $stmt->bind_param("sssssss", $firstName, $middleName, $lastName, $email, $phoneNumber, $userName, $hashedPassword);

        if ($stmt->execute()) {
            // Registration successful
            $_SESSION["username"] = $userName;
            header("Location: ../subscription/subscribed.html"); // Redirect to the subscription page
            exit();
        } else {
            // Registration failed
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        // Statement preparation failed
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
