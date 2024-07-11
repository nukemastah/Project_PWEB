<?php
// Start the session
session_start();

// Check if the user is logged in via session
if (!isset($_SESSION['user_id'])) {
    // Check if the serialized cookie is set
    if (isset($_COOKIE['user_login'])) {
        $cookie_data = unserialize($_COOKIE['user_login']);
        $_SESSION['user_id'] = $cookie_data['user_id'];
        $_SESSION['user_email'] = $cookie_data['user_email'];
    } else {
        // Redirect to login page if not logged in
        header("Location: login.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['user_email']; ?>!</h1>
    <p>This is a protected page.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
