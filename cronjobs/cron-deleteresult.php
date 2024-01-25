<?php
// Include your database connection file
$servername = "localhost";
$username = "u562619669_kolkataff";
$password = "Bishnu@2024";
$dbname = "u562619669_kolkataff_live";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update all records in game_table, set single_result and patti_result to NULL
$query = "UPDATE game_table SET single_result = NULL, patti_result = NULL";
$result = $conn->query($query);

if (!$result) {
    // If the query fails, output the error message
    die("Query failed: " . $conn->error);
} else {
    // Output a success message or any other relevant information
    echo "Data deleted successfully.";
}

// Close the database connection
$conn->close();
?>
