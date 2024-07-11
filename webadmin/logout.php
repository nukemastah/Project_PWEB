<?php
// Start the session
session_start();

// Destroy the session
session_unset();
session_destroy();

// Clear the serialized cookie
setcookie('user_login', '', time() - 3600, "/");

// Redirect to login page
header("Location: login.php");
exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
</head>
<body>
    <p>You have been logged out.</p>
    <a href="login.php">Login again</a>
</body>
</html>
