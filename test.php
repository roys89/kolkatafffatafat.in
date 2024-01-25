<?php
include 'database.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming $bet_number is a PHP variable containing the bet number from the URL
$decoded_bet_number = urldecode($bet_number);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bet Data</title>
    <!-- Add any additional styles or scripts here -->
</head>
<body>

    <h1>Bet Data</h1>
    <h1><?php echo "$decoded_bet_number"; ?></h1>

    <?php
    // Include your database connection file
    

    // Fetch data from the bet_table using a prepared statement
    $query = "SELECT
                user_id,
                SUM(amount) AS total_amount,
                phone
              FROM bet_table
              WHERE bet_number = ? AND baji = 1
              GROUP BY user_id";

    // Prepare the statement
    $stmt = $conn->prepare($query);

    // Bind parameters
    $stmt->bind_param("s", $decoded_bet_number);

    // Execute the statement
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

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

    // Close the statement
    $stmt->close();

    // Close the database connection
    $conn->close();
    ?>

    <!-- Add any additional content or scripts here -->

</body>
</html>
