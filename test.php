<?php
                                    // Assuming you have a database connection
                                    include 'database.php';

                                    // Check if the form is submitted
                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                        // Get the selected baji value
                                        $selectedBaji = $_POST['baji'];

                                        // Query to fetch data for each unique user_id with the selected game_type (baji)
                                        $query = "SELECT
                pl.bet_number,
                SUM(bt.amount) AS total_amount,
                COUNT(bt.user_id) AS total_bets
            FROM
            patti_list pl
            LEFT JOIN
                bet_table bt ON pl.bet_number = bt.bet_number
            WHERE
                bt.baji = ?  -- Assuming 'game_type' is the column that represents the baji
            GROUP BY
                pl.bet_number
            HAVING total_bets > 0";

                                        // Using a prepared statement to avoid SQL injection
                                        $stmt = $conn->prepare($query);
                                        $stmt->bind_param("s", $selectedBaji);
                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        if ($result->num_rows > 0) {
                                            echo '<table class="w-full whitespace-nowrap">
                <thead class="ltr:text-left rtl:text-right bg-slate-100 text-slate-500 dark:text-zink-200 dark:bg-zink-600">
                    <tr>
                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Number</th>
                        <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Total Amount</th>
                    </tr>
                </thead>';

                                            while ($row = $result->fetch_assoc()) {
                                                $bet_number = $row['bet_number'];
                                                $total_amount = $row['total_amount'];
                                                $total_bets = $row['total_bets'];
                                                $url = 'single-overview.php?bet_number=' . urlencode($bet_number);

                                                echo '<tbody>
                    <tr>
                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500"><a href="' . $url . '">' . $bet_number . '</a></td>
                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">' . $total_amount . '</td>
                    </tr>
                </tbody>';
                                            }

                                            echo '</table>';
                                        } else {
                                            echo "No data found";
                                        }

                                        $stmt->close();
                                        $conn->close();
                                    }
                                    ?>