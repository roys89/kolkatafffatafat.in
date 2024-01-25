<?php
// Include your database connection file
include '../database.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update records in game_table where closing_time is less than or equal to the current server time
$query = "UPDATE game_table SET baji_status = 'close' WHERE baji = 1";
$result = $conn->query($query);

// Close the database connection
$conn->close();
?>

domains/kolkatafffatafat.in/public_html/cornjobs/corn-baji1.php