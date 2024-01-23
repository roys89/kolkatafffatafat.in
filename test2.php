<?php
// Include your database connection file
include 'database.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


                               
                                // Fetch data from bet_no and bet_placed tables
                                $query = "SELECT
                                pl.bet_number,
                                SUM(bt.amount) AS total_amount,
                                COUNT(bt.user_id) AS total_bets
                                FROM
                                    patti_list pl
                                LEFT JOIN
                                    bet_table bt ON pl.bet_number = bt.bet_number
                                GROUP BY
                                    pl.bet_number;";

                                $result = $conn->query($query);

                                // Display data in a table
                                echo '<table border="1">
                                    <thead>
                                        <tr>
                                            <th>Bet Number</th>
                                            <th>Total Amount</th>
                                            <th>Total Bets</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

                                // Process query results and display in the table
                                while ($row = $result->fetch_assoc()) {
                                    $bet_number = $row['bet_number'];
                                    $total_amount = $row['total_amount'];
                                    $total_bets = $row['total_bets'];

                                    echo '<tr>
                                            <td>' . $bet_number . '</td>
                                            <td>' . $total_amount . '</td>
                                            <td>' . $total_bets . '</td>
                                        </tr>';
                                }

                                echo '</tbody></table>';

                

// Close the database connection
$conn->close();

?>
