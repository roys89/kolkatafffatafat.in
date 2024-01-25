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

    // Additional condition to check if the game type is single and bet number is between 1 and 10
    if ($gameType === 'single' && ($bet_number >= 0 && $bet_number < 10))    {
        echo json_encode(['success' => false, 'message' => 'Invalid bet number (Should to 1 - 9)']);
        exit; // Stop execution if the bet number is invalid for single game type
    }

    // Extract URL parameters
    $slotId = $_POST['slot_id'];
    $baji = $_POST['baji']; 
    $userId = $_POST['user_id']; 
    $phone = $_POST['phone']; 

    include "database.php";

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if wallet balance is sufficient
    $checkBalanceQuery = "SELECT wallet_bal FROM user_data WHERE user_id = '$userId'";
    $balanceResult = $conn->query($checkBalanceQuery);

    if ($balanceResult && $balanceResult->num_rows > 0) {
        $row = $balanceResult->fetch_assoc();
        $walletBal = $row['wallet_bal'];

        // Check if wallet balance is sufficient
        if ($walletBal >= $amount) {
            $sql = "INSERT INTO bet_table (amount, bet_number, slot_id, baji, game_type, user_id, phone) VALUES ('$amount', '$bet_number', '$slotId', '$baji', '$gameType', '$userId', '$phone')";
            $sql2 = "UPDATE user_data SET wallet_bal = wallet_bal - $amount  WHERE user_id = '$userId'";

            if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE) {
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

    $conn->close();
}
?>
