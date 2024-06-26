<?php
// Include your database connection file
include '../database.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Get user input from the form
$userChoice = $_POST['baji'];
$column1 = $_POST['patti_result'];
$column2 = $_POST['single_result'];

// Validate and sanitize user input here (consider using prepared statements)

// Initialize a variable to check if all queries are successful
$success = true;

// Start a transaction
$conn->begin_transaction();

// Update game_table
$sqlGameTable = "UPDATE game_table
                 SET patti_result = '$column1',
                 single_result = '$column2' 
                 WHERE baji = '$userChoice'";

if (!$conn->query($sqlGameTable)) {
    $success = false;
}

// Update user_table
$sqlUserTable = "UPDATE user_data
                 SET wallet_bal = wallet_bal + (120 * (
                     SELECT SUM(amount)
                     FROM bet_table
                     WHERE bet_number = '$column1' AND baji = '$userChoice'
                 )),
                 credit = credit + (120 * (
                     SELECT SUM(amount)
                     FROM bet_table
                     WHERE bet_number = '$column1' AND baji = '$userChoice'
                 ))
                 WHERE user_id IN (
                     SELECT user_id
                     FROM bet_table
                     WHERE bet_number = '$column1' AND baji = '$userChoice'
                 )";


$sqlUserTable2 = "UPDATE user_data
                SET wallet_bal = wallet_bal + (9.6 * (
                    SELECT SUM(amount)
                    FROM bet_table
                    WHERE bet_number = '$column2' AND baji = '$userChoice'
                )),
                credit = credit + (9.6 * (
                     SELECT SUM(amount)
                     FROM bet_table
                     WHERE bet_number = '$column2' AND baji = '$userChoice'
                 ))
                WHERE user_id IN (
                    SELECT user_id
                    FROM bet_table
                    WHERE bet_number = '$column2' AND baji = '$userChoice'
                )";

if (!$conn->query($sqlUserTable)) {
    $success = false;
}
if (!$conn->query($sqlUserTable2)) {
    $success = false;
}

// Update bet_table and master_bet to set result_status to 'Win'
$sqlUpdateBetTable = "UPDATE bet_table
                      SET result_status = 'Win'
                      WHERE bet_number IN ('$column1', '$column2') AND baji = '$userChoice'";

$sqlUpdateMasterBet = "UPDATE master_bet
                      SET result_status = 'Win', 
                          crdr = 'credit',
                          win_amount = CASE 
                                         WHEN baji = '$userChoice' AND game_type = 'single' THEN amount * 9.6
                                         WHEN baji = '$userChoice' AND game_type = 'patti' THEN amount * 120
                                         ELSE win_amount
                                      END
                      WHERE bet_number IN ('$column1', '$column2') 
                          AND baji = '$userChoice'
                          AND DATE(bid_timestamp) = CURDATE()";




if (!$conn->query($sqlUpdateBetTable)) {
    $success = false;
}

if (!$conn->query($sqlUpdateMasterBet)) {
    $success = false;
}

// Commit the transaction if all queries are successful, otherwise, rollback
if ($success) {
    $conn->commit();
    echo '<script>alert("Update Successful!"); window.location.href = document.referrer;</script>';
} else {
    $conn->rollback();
    echo "Error: " . $sqlGameTable . "<br>" . $conn->error;
    echo "Error: " . $sqlUserTable . "<br>" . $conn->error;
    echo "Error updating bet_table or master_bet: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
