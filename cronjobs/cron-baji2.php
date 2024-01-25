<?php
// Include your database connection file
include '../database.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update records in game_table where closing_time is less than or equal to the current server time
$query = "UPDATE game_table SET baji_status = 'close' WHERE baji = 2";
$result = $conn->query($query);

if (!$result) {
    // If the query fails, output the error message
    die("Query failed: " . $conn->error);
} else {
    // Output a success message or any other relevant information
    echo "Records updated successfully.";
}

// Close the database connection
$conn->close();
?>
