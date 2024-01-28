<?php

// Retrieve and sanitize parameters from the URL
$tran_id = filter_input(INPUT_GET, 'tran_id', FILTER_SANITIZE_STRING);
$user_id = filter_input(INPUT_GET, 'user_id', FILTER_SANITIZE_STRING);
$transaction_request = filter_input(INPUT_GET, 'transaction_request', FILTER_SANITIZE_NUMBER_FLOAT);
$status = filter_input(INPUT_GET, 'status', FILTER_SANITIZE_STRING);

// Check if status is 'approved'
if ($status === 'approved' && $tran_id && $user_id && $transaction_request !== null) {
    // Include your database connection file
    include '../database.php';

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update wallet_bal in user_data table
    $updateWalletQuery = "UPDATE user_data SET wallet_bal = wallet_bal + $transaction_request WHERE user_id = $user_id";
    $conn->query($updateWalletQuery);

    // Update transaction_status in transaction_table
    $updateStatusQuery = "UPDATE transaction_table SET transaction_status = 'approved' WHERE tran_id = $tran_id";
    $conn->query($updateStatusQuery);

    // Close the database connection
    $conn->close();

    // Redirect to a success page or perform other actions
    echo '<script>alert("Update Successful!"); window.location.href = document.referrer;</script>';
    exit();
} else {
    // Invalid parameters or status, handle accordingly
    echo '<script>alert("Update failed!"); window.location.href = document.referrer;</script>';
    exit();
}

?>
