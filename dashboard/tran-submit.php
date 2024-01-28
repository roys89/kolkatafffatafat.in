<?php

// Retrieve parameters from the URL
$tran_id = $_GET['tran_id'] ?? null;
$user_id = $_GET['user_id'] ?? null;
$transaction_request = $_GET['transaction_request'] ?? null;
$status = $_GET['status'] ?? null;

// Check if status is 'approved'
if ($status === 'approved' && $tran_id && $user_id && $transaction_request !== null) {
    // Include your database connection file
    include 'database.php';

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
    header("Location: success.php");
    exit();
} else {
    // Invalid parameters or status, handle accordingly
    header("Location: error.php");
    exit();
}
