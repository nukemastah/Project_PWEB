<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_pweb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['search'])) {
    $search = $conn->real_escape_string($_POST['search']);
    $sql = "SELECT * FROM item WHERE kodeitem LIKE '%$search%' OR nama LIKE '%$search%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $item = $result->fetch_assoc();
        echo json_encode($item);
    } else {
        echo json_encode(null);
    }
}

$conn->close();
?>
