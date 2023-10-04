<?php
session_start();
require_once("../database/config.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

  
    $conn = new mysqli(host, user, password, db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query if the user exists
    $query = "SELECT * FROM registereduser WHERE username = ?";

    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();

        // Geting result
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            // User exists, fetching the stored password
            $row = $result->fetch_assoc();
            $stored_password = $row["password"];

            if (password_verify($password, $stored_password)) {
                // Password is correct, user is authenticated
                $_SESSION["username"] = $username;
                echo '<script>
                        setTimeout(function() {
                            window.location.href = "../mainPage/test.php";
                        }, 2000); // 
                      </script>';
                exit();
            } else {
                echo  "Invalid password. Please try again.";
                      
            }
            
          
            $stmt->close();
        } else {
            echo "User not found. Please register.";  
        }
    } 
    
    else {
        echo "Error: " . $conn->error;
    }

  
    $conn->close();
}
?>
