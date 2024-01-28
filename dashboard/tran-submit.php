<?php
// Include your database connection file
include '../database.php';

// Function to update wallet balance in user_data table
function updateWalletBalance($user_id, $amount) {
    global $conn;
    // Assuming 'wallet_bal' is the column name in user_data table
    $query = "UPDATE user_data SET wallet_bal = wallet_bal + $amount WHERE user_id = $user_id";
    $result = $conn->query($query);
    return $result;
}

// Function to update transaction status in transaction_table
function updateTransactionStatus($tran_id, $status) {
    global $conn;
    // Assuming 'transection_status' is the column name in transaction_table
    $query = "UPDATE transaction_table SET transection_status = '$status' WHERE tran_id = $tran_id";
    $result = $conn->query($query);
    return $result;
}

// Check if the required parameters are set in the URL
if (isset($_GET['tran_id'], $_GET['user_id'], $_GET['transection_request'], $_GET['status'])) {
    // Get values from the URL
    $tran_id = $_GET['tran_id'];
    $user_id = $_GET['user_id'];
    $transection_request = $_GET['transection_request'];
    $status = $_GET['status'];

    // Check if the status is "approved"
    if ($status === 'approved') {
        // Update wallet balance
        $walletUpdateResult = updateWalletBalance($user_id, $transection_request);

        // Update transaction status
        $statusUpdateResult = updateTransactionStatus($tran_id, $status);

        // Check if both updates were successful
        if ($walletUpdateResult && $statusUpdateResult) {
            echo "Transaction approved successfully!";
        } else {
            echo "Error updating transaction.";
        }
    } else {
        echo "Invalid status.";
    }
} else {
    echo "Missing parameters.";
}

// Close the database connection
$conn->close();
?>
