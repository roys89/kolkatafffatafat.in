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

// Check if today is Sunday (day of the week is 0)
if (date('w') != 0) {
    // Update records in game_table where closing_time is less than or equal to the current server time
    $query = "UPDATE game_table SET baji_status = 'close', btn = 'buy-tips-btng' WHERE baji = 7";
    $result = $conn->query($query);

    if (!$result) {
        // If the query fails, output the error message
        die("Query failed: " . $conn->error);
    } else {
        // Output a success message or any other relevant information
        echo "Records updated successfully.";
    }
} else {
    // Output a message indicating that the query won't run on Sundays
    echo "The query won't run on Sundays.";
}

// Open the database connection
$conn->close();
?>
