<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION["username"]; ?></h2>
    <p>This is the protected content for registered users.</p>
    <p><a href="../logout/logout.php">Logout</a></p>
</body>
</html>
