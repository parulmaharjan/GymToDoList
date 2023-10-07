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

   //if user exist
    $query = "SELECT * FROM registereduser WHERE username = ?";

    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();

       
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {             
            $row = $result->fetch_assoc();
            $stored_password = $row["password"];

            if (password_verify($password, $stored_password)) {
                $_SESSION["username"] = $username;
                echo '<script>
                alert("Welcome, ' . $username .' we hope you will enjoy your fitness journey "  );
                setTimeout(function() {
                    window.location.href = "../mainPage/main.php";
                }, 1000);
            </script>';
            exit();
            } else {
                echo'<script>';
                echo 'alert("password incorrect.")';
                echo'</script>'; 
                      
            }            
          
            $stmt->close();
        } else {
            echo'<script>';
            echo 'alert("User not found. Please register.")';
            echo'</script>';  
        }
    }     
    else {
        echo "Error: " . $conn->error;
    }  
    $conn->close();
}
?>
