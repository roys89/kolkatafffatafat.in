<?php
include 'database.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming $bet_number is a PHP variable containing the bet number from the URL
$decoded_bet_number = urldecode($bet_number);

// Fetch data from the bet_table
$query = "SELECT
            user_id,
            SUM(amount) AS total_amount,
            phone
          FROM bet_table
          WHERE bet_number = '$decoded_bet_number' AND baji = 1
          GROUP BY user_id";

$result = $conn->query($query);

// Display data in a table
echo '<table border="1">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Total Amount</th>
                <th>Phone Number</th>
            </tr>
        </thead>
        <tbody>';

// Process query results and display in the table
while ($row = $result->fetch_assoc()) {
    $user_id = $row['user_id'];
    $total_amount = $row['total_amount'];
    $phone_number = $row['phone'];

    echo '<tr>
            <td>' . $user_id . '</td>
            <td>' . $total_amount . '</td>
            <td>' . $phone_number . '</td>
          </tr>';
}

echo '</tbody></table>';

// Close the database connection
$conn->close();
?>
