<?php
// Include your database connection file
include 'database.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch data for each unique user_id with game_type as "single"
$query = "SELECT
            user_id,
            phone,
            SUM(amount) AS total_amount,
            GROUP_CONCAT(bet_number ORDER BY bet_number ASC) AS bet_numbers
          FROM bet_table
          WHERE game_type = 'single'
          GROUP BY user_id";

$result = $conn->query($query);  

if ($result->num_rows > 0) {
    echo '<table border="1">
            <tr>
                <th>Phone Number</th>
                <th>Total Amount</th>
                <th>Bet Numbers</th>
            </tr>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . $row['phone'] . '</td>
                <td>' . $row['total_amount'] . '</td>
                <td>' . $row['bet_numbers'] . '</td>
              </tr>';
    }

    echo '</table>';
} else {
    echo "No data found";
}

// Close the database connection
$conn->close();
?>
