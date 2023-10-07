<?php
    session_start();

require_once("../database/config.php");


$mysqli = new mysqli(host, user, password, db);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstName"];
    $middleName = $_POST["middleName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phoneNumber"];
    $username = $_POST["username"];
    $password = $_POST["password"];
 


    // Server-side validation
    $errors = [];

    // Validate first name (only letters allowed)
    if (!preg_match("/^[a-zA-Z]*$/", $firstName)) {
        $errors[] = "First name should contain only letters.";
    }

    // Validate middle name (only letters allowed)
    if (!empty($middleName) && !preg_match("/^[a-zA-Z]*$/", $middleName)) {
        $errors[] = "Middle name should contain only letters.";
    }

    // Validate last name (only letters allowed)
    if (!preg_match("/^[a-zA-Z]*$/", $lastName)) {
        $errors[] = "Last name should contain only letters.";
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate phone number (must be exactly 10 digits)
    if (!preg_match("/^\d{10}$/", $phoneNumber)) {
        $errors[] = "Phone number should be 10 digits.";
    }

    // Password length should be at least 6 characters
    if (strlen($password) < 6) {
        $errors[] = "Password should be at least 6 characters long.";
    }

    // Check if username already exists in the database
    $check_query = "SELECT * FROM registereduser  WHERE username = ?";
    $check_stmt = $mysqli->prepare($check_query);
    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    
    if ($result->num_rows > 0) {
        $errors[] = "Username already exists. Please choose a different username.";
    }

    $check_stmt->close(); 
     
    // Check if email already exists in the database
$check_query = "SELECT 1 FROM registereduser WHERE email = ?";
$check_stmt = $mysqli->prepare($check_query);
$check_stmt->bind_param("s", $email);
$check_stmt->execute();
$check_stmt->store_result();

if ($check_stmt->num_rows > 0) {
    $errors[] = "Email already exists. Please use a different email address.";
}

$check_stmt->close();

// Check if phone number already exists in the database
$check_query = "SELECT 1 FROM registereduser WHERE phone_Number = ?";
$check_stmt = $mysqli->prepare($check_query);
$check_stmt->bind_param("s", $phoneNumber);
$check_stmt->execute();
$check_stmt->store_result();

if ($check_stmt->num_rows > 0) {
    $errors[] = "Phone number already exists. Please use a different phone number.";
}

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    } else {
        // Hashing the password before storing  
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        // Insert data into the database
        $insert_query = "INSERT INTO registereduser (first_Name, middle_Name, last_Name, email, phone_Number, username, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($insert_query);
        $stmt->bind_param("sssssss", $firstName, $middleName, $lastName, $email, $phoneNumber, $username, $passwordHash);
        $_SESSION['username'] = $username;

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    echo "Username is: " . $username;
} else {
    echo "Username is not set in the session.";
}


        if ($stmt->execute()) { 
            header("Location: ../subscription/subscribed.html");
            exit();  
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$mysqli->close();
?>
