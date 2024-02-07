<?php
// Handle the form submission and database storage
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = $_POST['amount'];
    $bet_number = $_POST['bet_number'];
    $gameType = $_POST['game_type'];

    // Additional condition to check if the amount does not exceed 5000
    if ($amount > 5000) {
        echo json_encode(['success' => false, 'message' => 'Amount cannot exceed 5000']);
        exit; // Stop execution if the amount is too high
    }

    // Extract URL parameters
    $slotId = $_POST['slot_id'];
    $baji = $_POST['baji']; 
    $userId = $_POST['user_id']; 
    $phone = $_POST['phone']; 
    $amountStatus = 'debit';

    include "database.php";

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if baji_status is 1 for the provided $baji
    $checkGameStatusQuery = "SELECT baji_status FROM game_table WHERE baji = '$baji'";
    $gameStatusResult = $conn->query($checkGameStatusQuery);

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
                    // Debugging: Output values for inspection
                    echo "Amount: $amount, Bet Number: $bet_number, Slot ID: $slotId, Baji: $baji, Game Type: $gameType, User ID: $userId, Phone: $phone";

                    $sql = "INSERT INTO bet_table (amount, bet_number, slot_id, baji, game_type, user_id, phone) VALUES ('$amount', '$bet_number', '$slotId', '$baji', '$gameType', '$userId', '$phone')";
                    $sql2 = "UPDATE user_data SET wallet_bal = wallet_bal - $amount  WHERE user_id = '$userId'";
                    $sql3 = "INSERT INTO master_bet (amount, crdr, bet_number, slot_id, baji, game_type, user_id, phone) VALUES ('$amount', '$amountStatus', '$bet_number', '$slotId', '$baji', '$gameType', '$userId', '$phone')";

                    // Debugging: Output SQL queries for inspection
                    echo "SQL 1: $sql<br>";
                    echo "SQL 2: $sql2<br>";
                    echo "SQL 3: $sql3<br>";

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
?>
