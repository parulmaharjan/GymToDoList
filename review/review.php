<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
     
    $username = $_POST["userName"];
    $reviewText = $_POST["reviewText"];

     
    $filename = "user_reviews.csv";

    // Open the file in append mode
    $file = fopen($filename, 'a');

    // Format the data as a table with semicolons as separators
    $data = $username . '  ||  ' . $reviewText . PHP_EOL;

    // Write the formatted data to the file
    fwrite($file, $data);

    // Close the file handle
    fclose($file);
    echo "Review submitted successfully.";
    echo '<script> 
             setTimeout(function() {
                window.location.href = "../login/login.html"; // Replace with the actual login page URL
            }, 1000); // 2000 milliseconds = 2 seconds
          </script>';
}
?>
