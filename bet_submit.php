

<?php
// Include your database connection file
include '../database.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get additional data from the FormData
$slotId = $_POST['slot_id'];
$baji = $_POST['baji'];
$gameType = $_POST['game_type'];
$userId = $_POST['user_id'];
$phone = $_POST['phone'];

// Get array data from FormData
$betNumbers = $_POST['bet_number'];
$amounts = $_POST['amount'];

// Initialize a variable to check if all queries are successful
$success = true;

// Start a transaction
$conn->begin_transaction();

// Loop through each form entry and insert into the database
for ($i = 0; $i < count($betNumbers); $i++) {
    $betNumber = $betNumbers[$i];
    $amount = $amounts[$i];

    if ($gameStatusResult && $gameStatusResult->num_rows > 0) {
        $row = $gameStatusResult->fetch_assoc();
        $gameStatus = $row['baji_status'];

        // Check if baji_status is 1
        if ($gameStatus === 'open') {
            // Check if wallet balance is sufficient
            $checkBalanceQuery = "SELECT wallet_bal FROM user_data WHERE user_id = '$userId'";
            $balanceResult = $conn->query($checkBalanceQuery);

            if ($balanceResult && $balanceResult->num_rows > 0) {
                $row = $balanceResult->fetch_assoc();
                $walletBal = $row['wallet_bal'];

                // Check if wallet balance is sufficient
                if ($walletBal >= $amount) {
                    $sql = "INSERT INTO bet_table (amount, bet_number, slot_id, baji, game_type, user_id, phone, result_status) VALUES ('$amount', '$bet_number', '$slotId', '$baji', '$gameType', '$userId', '$phone', '$resultStatus')";
                    $sql2 = "UPDATE user_data SET wallet_bal = wallet_bal - $amount  WHERE user_id = '$userId'";
                    $sql3 = "INSERT INTO master_bet (amount, crdr, bet_number, slot_id, baji, game_type, user_id, phone, result_status) VALUES ('$amount', '$amountStatus', '$bet_number', '$slotId', '$baji', '$gameType', '$userId', '$phone', '$resultStatus')";

                    if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE && $conn->query($sql3) === TRUE) {
                        echo json_encode(['success' => true, 'message' => 'Data inserted successfully']);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => 'Insufficient funds']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Error checking wallet balance: ' . $conn->error]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Game is not active for the provided baji']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error checking game status: ' . $conn->error]);
    }

    $conn->close();
}

// Commit the transaction if all queries are successful, otherwise, rollback
if ($success) {
    $conn->commit();
    echo json_encode(['status' => 'success', 'message' => 'Data inserted successfully.']);
} else {
    $conn->rollback();
    echo json_encode(['status' => 'error', 'message' => 'Error inserting data.']);
}

// Close the database connection
$conn->close();
?>
