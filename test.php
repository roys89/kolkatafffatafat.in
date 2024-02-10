<?php
include 'database.php';

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT * FROM master_bet";
$result = $conn->query($sql);

// Check if there is any result
if ($result->num_rows > 0) {
    echo '<table border="1">';
    echo '<tr><th>ID</th><th>Name</th><th>Result Status</th></tr>';

    // Loop through each row of data
    while ($row = $result->fetch_assoc()) {
        // Check if the result_status is "success"
        $rowColor = ($row['result_status'] == 'Win') ? 'style="background-color: green;"' : '';

        // Display the data in a table row
        
        echo "<tr $rowColor>";
        echo "<td>" . $row['bid_timestamp'] . "</td>";
        echo "<td>" . $row['phone'] . "</td>";
        echo "<td>" . $row['result_status'] . "</td>";
        echo "</tr>";
    }

    echo '</table>';
} else {
    echo 'No results found';
}

// Close the database connection
$conn->close();
?>
