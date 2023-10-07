<?php
session_start();
session_destroy();
header("Location: ../login/login.html"); // Redirecting to the login page
exit();
?>
