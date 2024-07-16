<?php
// Include your database connection file
include 'db_connection.php'; // Make sure this file sets up the $conn variable

// Query to select rekening data
$query = "SELECT koderekening AS kode, namarekening AS nama FROM rekening";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    echo json_encode(['error' => mysqli_error($conn)]);
    exit();
}

// Fetch data and encode it as JSON
$rekeningList = [];
while ($row = mysqli_fetch_assoc($result)) {
    $rekeningList[] = $row;
}

// Return the rekening data as JSON
echo json_encode($rekeningList);
?>
